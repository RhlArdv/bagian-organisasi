<script>
    window.liveChatWidget = function() {
        return {
            open: false,
            messages: [],
            unreadCount: 0,
            newMessage: '',
            sending: false,
            ipAddress: '',
            pollInterval: 30000,
            intervalTimer: null,

            initWidget() {
                this.loadChat(false);
                this.startPolling();

                this.$watch('open', value => {
                    if (value) {
                        this.pollInterval = 5000; // 5 detik saat terbuka
                        this.loadChat(true);
                        this.$nextTick(() => this.scrollToBottom());
                    } else {
                        this.pollInterval = 30000; // 30 detik saat tertutup
                    }
                    this.startPolling();
                });
            },

            startPolling() {
                if (this.intervalTimer) clearInterval(this.intervalTimer);
                this.intervalTimer = setInterval(() => {
                    this.loadChat(this.open);
                }, this.pollInterval);
            },

            toggleChat() {
                this.open = !this.open;
            },

            async loadChat(markRead = false) {
                try {
                    const res = await fetch(`/live-chat/load?mark_read=${markRead ? '1' : '0'}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        const previousCount = this.messages.length;
                        this.messages = data.messages;
                        this.unreadCount = data.unread_count || 0;
                        this.ipAddress = data.ip_address || '';

                        if (this.open && this.messages.length > previousCount) {
                            this.$nextTick(() => this.scrollToBottom());
                        }
                    }
                } catch (e) {
                    console.error("Gagal memuat live chat:", e);
                }
            },

            async sendMessage() {
                if (window._isSendingChat || !this.newMessage.trim() || this.sending) return;
                window._isSendingChat = true;
                
                const messageText = this.newMessage;
                this.newMessage = '';
                this.sending = true;

                // Optimistically add to UI immediately
                this.messages.push({
                    id: 'temp-' + Date.now(),
                    sender_type: 'visitor',
                    message: messageText,
                    time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                });
                this.$nextTick(() => this.scrollToBottom());

                try {
                    const res = await fetch(`/live-chat/send`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ message: messageText })
                    });
                    const data = await res.json();
                    if (data.status === 'success') {
                        this.messages = data.messages;
                        this.unreadCount = data.unread_count || 0;
                        this.$nextTick(() => this.scrollToBottom());
                    }
                } catch (e) {
                    alert("Pesan gagal terkirim. Mohon cek koneksi atau karakter yang digunakan.");
                } finally {
                    this.sending = false;
                    setTimeout(() => { window._isSendingChat = false; }, 600);
                }
            },

            scrollToBottom() {
                const container = document.getElementById('chat-messages-container');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            }
        };
    };
</script>

<div id="padang-live-chat" x-data="liveChatWidget()" x-init="initWidget()" class="fixed right-6 bottom-6" style="position: fixed; bottom: 24px; right: 24px; z-index: 999999;">
    {{-- Tombol Trigger Floating (Minimalist) --}}
    <button type="button" @click="toggleChat()" 
        class="relative flex items-center justify-center w-14 h-14 bg-white text-gray-800 rounded-full shadow-[0_10px_40px_rgba(0,0,0,0.15)] hover:shadow-[0_10px_40px_rgba(0,0,0,0.25)] hover:scale-110 transition-all duration-300 group border border-gray-100"
        style="width: 60px; height: 60px; border-radius: 50%; background: #ffffff; color: #1e293b; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.15); cursor: pointer; border: 1px solid #f1f5f9;">
        
        <i class="ph-fill transition-transform duration-300" :class="open ? 'ph-x rotate-90 text-gray-400' : 'ph-chat-circle-dots text-amber-500 group-hover:-rotate-12'" style="font-size: 32px;"></i>
        
        {{-- Badge Notifikasi Belum Dibaca --}}
        <span x-show="unreadCount > 0" x-text="unreadCount" 
            class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-sm animate-bounce"
            style="position: absolute; top: -2px; right: -2px; width: 22px; height: 22px; background-color: #ef4444; color: white; font-size: 11px; font-weight: 900; border-radius: 50%; border: 2px solid white; display: none; align-items: center; justify-content: center;">
        </span>
    </button>

    {{-- Jendela Chat Modal --}}
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="scale-90 opacity-0 translate-y-4"
        x-transition:enter-end="scale-100 opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="scale-100 opacity-100 translate-y-0"
        x-transition:leave-end="scale-90 opacity-0 translate-y-4"
        class="fixed right-6 bottom-24 w-[350px] sm:w-[390px] bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-200 flex flex-col"
        style="display: none; position: fixed; right: 24px; bottom: 85px; width: 360px; max-width: calc(100vw - 40px); height: 520px; max-height: calc(100vh - 120px); background: #ffffff; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.4); border: 1px solid #e5e7eb; z-index: 999999; flex-direction: column; overflow: hidden;">
        
        {{-- Header Chat --}}
        <div class="bg-gradient-to-r from-[#0a0f1c] via-[#111827] to-amber-900 p-5 text-white flex items-center justify-between border-b border-white/10 shrink-0"
            style="background: linear-gradient(to right, #0a0f1c, #1a202c, #78350f); padding: 16px 20px; color: white; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="flex items-center gap-3" style="display: flex; align-items: center; gap: 12px;">
                <div class="relative" style="position: relative;">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-amber-400 font-black text-xl shadow-inner"
                        style="width: 44px; height: 44px; border-radius: 14px; background: rgba(245,158,11,0.2); border: 1px solid rgba(251,191,36,0.3); display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 22px;">
                        <i class="ph-fill ph-headset font-normal"></i>
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-[#0a0f1c] animate-pulse"
                        style="position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; background: #4ade80; border-radius: 50%; border: 2px solid #0a0f1c;"></span>
                </div>
                <div>
                    <h4 class="font-black text-sm tracking-tight" style="font-weight: 900; font-size: 15px; margin: 0; color: white;">Bagian Organisasi</h4>
                    <div class="flex items-center gap-1.5 mt-0.5" style="display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-wider" style="font-size: 10px; font-weight: 700; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.05em;">Admin Online • IP Locked</span>
                    </div>
                </div>
            </div>
            <button type="button" @click="open = false" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-gray-300 flex items-center justify-center transition-colors"
                style="width: 32px; height: 32px; border-radius: 50%; background: rgba(255,255,255,0.15); border: none; color: #f3f4f6; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="ph-bold ph-x text-sm" style="font-size: 16px;"></i>
            </button>
        </div>

        {{-- Isi Pesan --}}
        <div id="chat-messages-container" class="flex-1 overflow-y-auto p-4 space-y-3.5 bg-gray-50 text-xs"
            style="flex: 1; overflow-y: auto; padding: 16px; background: #f8fafc; font-size: 13px; display: flex; flex-direction: column; gap: 14px;">
            
            {{-- Pesan Sapaan Otomatis --}}
            <div class="flex items-start gap-2.5 max-w-[88%]" style="display: flex; align-items: flex-start; gap: 10px; max-width: 88%;">
                <div class="w-7 h-7 rounded-full bg-[#0a0f1c] text-white flex items-center justify-center shrink-0 text-[10px] font-bold mt-1 shadow-sm"
                    style="width: 28px; height: 28px; border-radius: 50%; background: #0a0f1c; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0; margin-top: 4px;">
                    <i class="ph-fill ph-robot"></i>
                </div>
                <div>
                    <div class="p-3.5 bg-white text-gray-800 rounded-2xl rounded-tl-sm shadow-sm border border-gray-100/80 leading-relaxed font-medium"
                        style="padding: 14px; background: white; color: #1e293b; border-radius: 16px; border-top-left-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; line-height: 1.5; font-weight: 500;">
                        Halo! 👋 Selamat datang di Portal Resmi Bagian Organisasi Setda Kota Padang. Anda terhubung melalui proteksi IP Address (<span x-text="ipAddress || 'Checking...'" style="font-family: monospace; font-weight: 800; color: #d97706;"></span>). Ada yang bisa kami bantu hari ini?
                    </div>
                    <span class="text-[9px] font-bold text-gray-400 ml-1 mt-1 block" style="font-size: 10px; font-weight: 700; color: #94a3b8; margin-left: 4px; margin-top: 4px; display: block;">System • Just now</span>
                </div>
            </div>

            {{-- Pesan dari Database --}}
            <template x-for="msg in messages" :key="msg.id">
                <div :style="msg.sender_type === 'visitor' ? 'display: flex; flex-direction: column; align-items: flex-end; align-self: flex-end; margin-left: auto; max-width: 85%;' : 'display: flex; align-items: flex-start; gap: 10px; max-width: 85%;'">
                    <template x-if="msg.sender_type === 'admin'">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #d97706; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0; margin-top: 4px;">
                            <i class="ph-fill ph-user"></i>
                        </div>
                    </template>
                    
                    <div :style="msg.sender_type === 'visitor' ? 'width: 100%;' : 'flex: 1;'">
                        <div :style="msg.sender_type === 'visitor' ? 'padding: 14px; background: #d97706; color: white; border-radius: 16px; border-top-right-radius: 4px; box-shadow: 0 2px 6px rgba(217,119,6,0.25); line-height: 1.5; font-weight: 500;' : 'padding: 14px; background: white; color: #1e293b; border-radius: 16px; border-top-left-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; line-height: 1.5; font-weight: 500;'" x-text="msg.message"></div>
                        <div style="display: flex; align-items: center; gap: 5px; margin-top: 4px;" :style="msg.sender_type === 'visitor' ? 'justify-content: flex-end; margin-right: 4px;' : 'margin-left: 4px;'">
                            <span x-text="msg.sender_type === 'visitor' ? 'Anda' : (msg.sender_name || 'Admin')" style="font-size: 10px; font-weight: 800;" :style="msg.sender_type === 'visitor' ? 'color: #64748b;' : 'color: #d97706;'"></span>
                            <span style="font-size: 10px; color: #cbd5e1;">•</span>
                            <span x-text="msg.time" style="font-size: 10px; color: #94a3b8; font-weight: 500;"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Input Pesan --}}
        <div class="p-3.5 bg-white border-t border-gray-100 shrink-0" style="padding: 14px; background: white; border-top: 1px solid #e2e8f0; flex-shrink: 0;">
            <form @submit.prevent="sendMessage()" style="display: flex; align-items: center; gap: 8px; margin: 0;">
                <input type="text" x-model="newMessage" :disabled="sending" 
                    placeholder="Tulis pesan obrolan..." 
                    style="flex: 1; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 10px 14px; font-size: 13px; color: #0f172a; font-weight: 500; outline: none; transition: border 0.2s;">
                <button type="submit" :disabled="sending || !newMessage.trim()" 
                    style="width: 42px; height: 42px; border-radius: 12px; background: #d97706; color: white; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; box-shadow: 0 4px 12px rgba(217,119,6,0.3); transition: background 0.2s;">
                    <i class="ph-bold ph-paper-plane-right" style="font-size: 18px;" :class="sending ? 'animate-spin ph-spinner' : ''"></i>
                </button>
            </form>
            <div style="font-size: 10px; color: #94a3b8; font-weight: 600; text-align: center; margin-top: 8px; display: flex; align-items: center; justify-content: center; gap: 4px;">
                <i class="ph-fill ph-lock-key" style="color: #d97706;"></i>
                <span>Sesi diamankan dengan pencatatan IP Address per perangkat.</span>
            </div>
        </div>
    </div>
</div>
