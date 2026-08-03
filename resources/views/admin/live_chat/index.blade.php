<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl text-gray-900 tracking-tight">Live Chat Pengguna</h2>
                <p class="text-xs text-gray-400 font-medium mt-0.5">Pantau dan balas pesan secara real-time. Setiap pengguna dikunci dan diidentifikasi berdasarkan IP Address.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 border border-green-200 text-green-700 text-xs font-bold rounded-full">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Sistem Aktif (Real-Time)
                </span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-bold text-sm flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- Panel Kiri: Daftar Sesi Obrolan --}}
            <div class="lg:col-span-4 bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] overflow-hidden flex flex-col h-[380px] lg:h-[680px]">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between gap-2">
                    <h3 class="font-extrabold text-gray-900 text-base flex items-center gap-2">
                        <i class="ph-bold ph-chats text-brand-500 text-xl"></i> Daftar Pengguna
                    </h3>
                    <form action="{{ route('admin.live-chat.index') }}" method="GET" class="text-xs">
                        <select name="status" onchange="this.form.submit()" class="bg-white border border-gray-200 rounded-xl px-2.5 py-1.5 text-xs font-bold text-gray-700 focus:ring-2 focus:ring-brand-500/20">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="open" {{ request('status', 'open') == 'open' ? 'selected' : '' }}>Aktif (Open)</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </form>
                </div>

                <div class="flex-1 overflow-y-auto divide-y divide-gray-50">
                    @forelse($sessions as $sess)
                        @php
                            $isSelected = $activeSession && $activeSession->id === $sess->id;
                        @endphp
                        <a href="{{ route('admin.live-chat.index', ['active' => $sess->id, 'status' => request('status')]) }}" 
                            class="block p-4 transition-all duration-150 relative {{ $isSelected ? 'bg-brand-50/70 border-l-4 border-brand-500' : 'hover:bg-gray-50' }}">
                            
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $sess->status === 'open' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span class="font-extrabold text-gray-900 text-xs">{{ $sess->visitor_name }}</span>
                                </div>
                                @if($sess->last_message_at)
                                    <span class="text-[10px] font-semibold text-gray-400">{{ $sess->last_message_at->format('H:i') }} WIB</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between gap-2 mt-1">
                                <span class="inline-flex items-center gap-1 text-[10px] font-mono font-extrabold px-2 py-0.5 bg-gray-100 text-gray-600 rounded-lg border border-gray-200/60">
                                    <i class="ph-bold ph-lock-simple-open text-brand-500"></i> IP: {{ $sess->ip_address }}
                                </span>
                                @if($sess->unread_admin > 0)
                                    <span class="px-2 py-0.5 bg-red-500 text-white font-black text-[10px] rounded-full shadow-sm">
                                        {{ $sess->unread_admin }} Baru
                                    </span>
                                @endif
                            </div>

                            @if($sess->latestMessage)
                                <p class="text-xs text-gray-500 mt-2 line-clamp-1 font-medium italic">
                                    {{ $sess->latestMessage->sender_type === 'admin' ? 'Anda: ' : '' }}{{ $sess->latestMessage->message }}
                                </p>
                            @else
                                <p class="text-xs text-gray-400 mt-2 italic font-medium">Belum ada pesan</p>
                            @endif
                        </a>
                    @empty
                        <div class="py-20 text-center px-6">
                            <i class="ph-bold ph-chat-slash text-gray-300 text-5xl mb-3 block mx-auto"></i>
                            <p class="font-bold text-gray-600 text-sm">Belum ada obrolan</p>
                            <p class="text-xs text-gray-400 mt-1">Saat pengguna mengirim pesan dari widget di Landing Page, daftar percakapan akan tampil di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Panel Kanan: Jendela Percakapan Aktif --}}
            <div class="lg:col-span-8 bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] overflow-hidden flex flex-col h-[550px] lg:h-[680px]">
                @if($activeSession)
                    {{-- Header Ruang Obrolan --}}
                    <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-[#0a0f1c] to-[#1e293b] text-white flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-brand-400 text-xl font-bold">
                                <i class="ph-fill ph-desktop"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-black text-base">{{ $activeSession->visitor_name }}</h3>
                                    <span class="px-2 py-0.5 bg-brand-500 text-white font-mono font-extrabold text-xs rounded-lg shadow-sm">
                                        IP: {{ $activeSession->ip_address }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-300 font-medium mt-0.5 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full {{ $activeSession->status === 'open' ? 'bg-green-400 animate-pulse' : 'bg-gray-400' }}"></span>
                                    Status: {{ strtoupper($activeSession->status) }} • Sesi dimulai {{ $activeSession->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($activeSession->status === 'open')
                                <form action="{{ route('admin.live-chat.status', $activeSession) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="closed">
                                    <button type="submit" class="px-3 py-2 bg-amber-500/20 hover:bg-amber-500 border border-amber-400 text-amber-200 hover:text-white font-bold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                                        <i class="ph-bold ph-check-circle"></i> Tutup Obrolan
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.live-chat.status', $activeSession) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="open">
                                    <button type="submit" class="px-3 py-2 bg-green-500/20 hover:bg-green-500 border border-green-400 text-green-200 hover:text-white font-bold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                                        <i class="ph-bold ph-arrow-counter-clockwise"></i> Buka Kembali
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.live-chat.destroy', $activeSession) }}" method="POST" onsubmit="return confirm('Hapus permanen riwayat obrolan dengan IP ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white border border-red-500/30 rounded-xl flex items-center justify-center transition-colors" title="Hapus Obrolan">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Isi Pesan --}}
                    <div x-data="adminLiveChat({{ $activeSession->id }}, @js($activeSession->messages->load('senderAdmin')->map(fn($m) => [
                            'id' => $m->id,
                            'sender_type' => $m->sender_type,
                            'sender_name' => $m->sender_type === 'admin' ? ($m->senderAdmin->name ?? 'Admin') : 'Pengunjung (' . $activeSession->ip_address . ')',
                            'message' => $m->message,
                            'time' => $m->created_at ? $m->created_at->format('H:i') : ''
                        ])))"
                        x-init="initChat()"
                        class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50/80 text-sm flex flex-col justify-between">
                        
                        <div id="admin-messages-box" class="space-y-4 overflow-y-auto flex-1 pr-2">
                            <div class="text-center py-2">
                                <span class="px-3 py-1 bg-gray-200/70 text-gray-500 text-[11px] font-bold rounded-full">
                                    Obrolan dimulai • IP Terkunci: {{ $activeSession->ip_address }}
                                </span>
                            </div>

                            <template x-for="msg in messages" :key="msg.id">
                                <div :class="msg.sender_type === 'admin' ? 'flex flex-col items-end justify-end ml-auto max-w-[80%]' : 'flex items-start gap-3 max-w-[80%]'">
                                    <template x-if="msg.sender_type === 'visitor'">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 border border-blue-200 flex items-center justify-center shrink-0 font-bold text-xs mt-1">
                                            <i class="ph-bold ph-user text-sm"></i>
                                        </div>
                                    </template>

                                    <div :class="msg.sender_type === 'admin' ? 'w-full' : 'flex-1'">
                                        <div :class="msg.sender_type === 'admin' ? 'p-4 bg-[#0a0f1c] text-white rounded-2xl rounded-tr-sm shadow-md font-medium text-sm' : 'p-4 bg-white text-gray-900 rounded-2xl rounded-tl-sm shadow-sm border border-gray-100 font-medium text-sm'" x-text="msg.message"></div>
                                        <div class="flex items-center gap-1.5 mt-1.5" :class="msg.sender_type === 'admin' ? 'justify-end mr-1' : 'ml-1'">
                                            <span x-text="msg.sender_type === 'admin' ? 'Anda (' + msg.sender_name + ')' : 'Pengunjung (' + @js($activeSession->ip_address) + ')'" class="text-[11px] font-extrabold" :class="msg.sender_type === 'admin' ? 'text-brand-500' : 'text-gray-600'"></span>
                                            <span class="text-[11px] text-gray-400">•</span>
                                            <span x-text="msg.time" class="text-[11px] text-gray-400 font-medium"></span>
                                        </div>
                                    </div>

                                    <template x-if="msg.sender_type === 'admin'">
                                        <div class="hidden"></div>
                                    </template>
                                </div>
                            </template>
                        </div>

                        {{-- Input Balasan --}}
                        <div class="mt-4 pt-4 border-t border-gray-200/80 shrink-0">
                            <form @submit.prevent="sendReply()" class="flex items-center gap-3">
                                <input type="text" x-model="replyText" :disabled="sending || @js($activeSession->status === 'closed')" 
                                    placeholder="{{ $activeSession->status === 'closed' ? 'Obrolan telah ditutup oleh admin.' : 'Ketik balasan Anda untuk pengguna ini...' }}"
                                    class="flex-1 bg-white border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-medium text-gray-900 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 disabled:bg-gray-100 disabled:cursor-not-allowed placeholder-gray-400 shadow-sm">
                                <button type="submit" :disabled="sending || !replyText.trim() || @js($activeSession->status === 'closed')"
                                    class="px-6 py-3.5 bg-brand-500 hover:bg-brand-600 disabled:opacity-50 text-white font-bold rounded-2xl flex items-center gap-2 transition-all active:scale-95 shadow-lg shadow-brand-500/25">
                                    <span>Kirim Balasan</span>
                                    <i class="ph-bold ph-paper-plane-right" :class="sending ? 'animate-spin ph-spinner' : ''"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function adminLiveChat(sessionId, initialMessages) {
                            return {
                                sessionId: sessionId,
                                messages: initialMessages,
                                replyText: '',
                                sending: false,

                                initChat() {
                                    this.$nextTick(() => this.scrollToBottom());
                                    
                                    // Polling pesan baru dari pengunjung setiap 3.5 detik (real-time tanpa reload)
                                    setInterval(() => {
                                        this.fetchMessages();
                                    }, 3500);
                                },

                                async fetchMessages() {
                                    try {
                                        const res = await fetch(`/admin/live-chat/${this.sessionId}/messages`, {
                                            headers: { 'Accept': 'application/json' }
                                        });
                                        const data = await res.json();
                                        if (data.status === 'success') {
                                            const prevLength = this.messages.length;
                                            this.messages = data.messages;
                                            if (this.messages.length > prevLength) {
                                                this.$nextTick(() => this.scrollToBottom());
                                            }
                                        }
                                    } catch (e) {
                                        console.error("Gagal sinkronisasi obrolan admin:", e);
                                    }
                                },

                                async sendReply() {
                                    if (window._isSendingAdminReply || !this.replyText.trim() || this.sending) return;
                                    window._isSendingAdminReply = true;
                                    const msg = this.replyText;
                                    this.replyText = '';
                                    this.sending = true;

                                    try {
                                        const res = await fetch(`/admin/live-chat/${this.sessionId}/reply`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'X-Requested-With': 'XMLHttpRequest'
                                            },
                                            body: JSON.stringify({ message: msg })
                                        });
                                        const data = await res.json();
                                        if (data.status === 'success') {
                                            this.messages = data.messages;
                                            this.$nextTick(() => this.scrollToBottom());
                                        }
                                    } catch (e) {
                                        alert("Gagal mengirim balasan. Cek koneksi Anda.");
                                    } finally {
                                        this.sending = false;
                                        setTimeout(() => { window._isSendingAdminReply = false; }, 600);
                                    }
                                },

                                scrollToBottom() {
                                    const box = document.getElementById('admin-messages-box');
                                    if (box) {
                                        box.scrollTop = box.scrollHeight;
                                    }
                                }
                            };
                        }
                    </script>
                @else
                    {{-- Kosong / Belum memilih obrolan --}}
                    <div class="flex-1 flex flex-col items-center justify-center text-center p-12 bg-gray-50/50">
                        <div class="w-24 h-24 rounded-3xl bg-white border border-gray-100 flex items-center justify-center shadow-lg mb-6 text-brand-500">
                            <i class="ph-bold ph-chats-circle text-5xl"></i>
                        </div>
                        <h3 class="font-black text-xl text-gray-900 mb-2">Pilih Obrolan untuk Dibalas</h3>
                        <p class="text-sm font-medium text-gray-500 max-w-sm mb-6">
                            Silakan klik salah satu sesi pengguna di panel samping kiri untuk melihat riwayat percakapan dan membalas pertanyaan secara real-time.
                        </p>
                        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 font-bold text-xs rounded-xl border border-blue-100">
                            <i class="ph-fill ph-lock-key text-blue-500"></i> Sistem IP Lock siap memproteksi setiap percakapan
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
