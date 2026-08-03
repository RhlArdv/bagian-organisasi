{{-- Widget Aksesibilitas untuk Penyandang Disabilitas (Ramah Inklusi) --}}
<script>
    window.accessibilityWidget = function() {
        return {
            open: false,
            textSize: 100, // percentage: 100%, 115%, 130%, 145%
            highContrast: false,
            darkContrast: false,
            grayscale: false,
            highlightLinks: false,
            readableText: false,
            speechActive: false,

            init() {
                // Load saved settings from localStorage if available
                const saved = localStorage.getItem('padang_accessibility');
                if (saved) {
                    try {
                        const config = JSON.parse(saved);
                        this.textSize = config.textSize || 100;
                        this.highContrast = !!config.highContrast;
                        this.darkContrast = !!config.darkContrast;
                        this.grayscale = !!config.grayscale;
                        this.highlightLinks = !!config.highlightLinks;
                        this.readableText = !!config.readableText;
                    } catch(e) {}
                }
                this.applySettings();

                // Setup Text-to-Speech listener for visually impaired citizens
                document.addEventListener('mouseup', () => {
                    if (!this.speechActive) return;
                    const selectedText = window.getSelection().toString().trim();
                    if (selectedText.length > 0) {
                        this.speak(selectedText);
                    }
                });
            },

            saveSettings() {
                const config = {
                    textSize: this.textSize,
                    highContrast: this.highContrast,
                    darkContrast: this.darkContrast,
                    grayscale: this.grayscale,
                    highlightLinks: this.highlightLinks,
                    readableText: this.readableText
                };
                localStorage.setItem('padang_accessibility', JSON.stringify(config));
            },

            applySettings() {
                const html = document.documentElement;
                const body = document.body;

                // 1. Text Size (Zoom/Scaling)
                html.style.fontSize = this.textSize === 100 ? '' : `${this.textSize}%`;

                // 2. High Contrast
                if (this.highContrast) {
                    body.classList.add('access-high-contrast');
                } else {
                    body.classList.remove('access-high-contrast');
                }

                // 3. Dark Inverted Contrast
                if (this.darkContrast) {
                    body.classList.add('access-dark-contrast');
                } else {
                    body.classList.remove('access-dark-contrast');
                }

                // 4. Grayscale
                if (this.grayscale) {
                    body.classList.add('access-grayscale');
                } else {
                    body.classList.remove('access-grayscale');
                }

                // 5. Highlight Links
                if (this.highlightLinks) {
                    body.classList.add('access-highlight-links');
                } else {
                    body.classList.remove('access-highlight-links');
                }

                // 6. Readable Text & Spacing
                if (this.readableText) {
                    body.classList.add('access-readable-text');
                } else {
                    body.classList.remove('access-readable-text');
                }

                this.saveSettings();
            },

            increaseText() {
                if (this.textSize < 145) {
                    this.textSize += 15;
                    this.applySettings();
                }
            },

            decreaseText() {
                if (this.textSize > 85) {
                    this.textSize -= 15;
                    this.applySettings();
                }
            },

            toggleHighContrast() {
                this.highContrast = !this.highContrast;
                if (this.highContrast) this.darkContrast = false;
                this.applySettings();
            },

            toggleDarkContrast() {
                this.darkContrast = !this.darkContrast;
                if (this.darkContrast) this.highContrast = false;
                this.applySettings();
            },

            toggleGrayscale() {
                this.grayscale = !this.grayscale;
                this.applySettings();
            },

            toggleHighlightLinks() {
                this.highlightLinks = !this.highlightLinks;
                this.applySettings();
            },

            toggleReadableText() {
                this.readableText = !this.readableText;
                this.applySettings();
            },

            toggleSpeech() {
                this.speechActive = !this.speechActive;
                if (this.speechActive) {
                    this.speak("Mode Pembaca Suara Aktif. Silakan sorot atau seleksi teks apa saja di layar untuk dibacakan secara otomatis.");
                } else {
                    window.speechSynthesis && window.speechSynthesis.cancel();
                }
            },

            speak(text) {
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel(); // stop previous speech
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'id-ID'; // Bahasa Indonesia
                    utterance.rate = 0.95;    // Kecepatan natural
                    window.speechSynthesis.speak(utterance);
                } else {
                    alert("Browser Anda tidak mendukung fitur Web Speech Text-to-Speech.");
                }
            },

            resetAll() {
                this.textSize = 100;
                this.highContrast = false;
                this.darkContrast = false;
                this.grayscale = false;
                this.highlightLinks = false;
                this.readableText = false;
                this.speechActive = false;
                window.speechSynthesis && window.speechSynthesis.cancel();
                localStorage.removeItem('padang_accessibility');
                this.applySettings();
            }
        };
    };
</script>

<style>
    /* CSS Khusus Fitur Aksesibilitas Disabilitas */
    body.access-grayscale > *:not(#padang-accessibility-widget):not(#padang-live-chat) {
        filter: grayscale(100%) !important;
    }
    body.access-high-contrast {
        background-color: #000000 !important;
        color: #ffffff !important;
    }
    body.access-high-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) * {
        background-color: #000000 !important;
        color: #ffffff !important;
        border-color: #ffff00 !important;
    }
    body.access-high-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) a,
    body.access-high-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) button {
        color: #ffff00 !important;
        text-decoration: underline !important;
    }
    body.access-dark-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) {
        filter: invert(100%) hue-rotate(180deg) !important;
    }
    body.access-dark-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) img,
    body.access-dark-contrast > *:not(#padang-accessibility-widget):not(#padang-live-chat) video {
        filter: invert(100%) hue-rotate(180deg) !important;
    }
    body.access-highlight-links > *:not(#padang-accessibility-widget):not(#padang-live-chat) a,
    body.access-highlight-links > *:not(#padang-accessibility-widget):not(#padang-live-chat) button {
        background-color: #fef08a !important;
        color: #000000 !important;
        font-weight: 800 !important;
        outline: 2px solid #ca8a04 !important;
        text-decoration: underline !important;
    }
    body.access-readable-text > *:not(#padang-accessibility-widget):not(#padang-live-chat),
    body.access-readable-text > *:not(#padang-accessibility-widget):not(#padang-live-chat) * {
        letter-spacing: 0.05em !important;
        line-height: 1.8 !important;
        word-spacing: 0.15em !important;
        font-family: Arial, Verdana, sans-serif !important;
    }
</style>

<div id="padang-accessibility-widget" x-data="accessibilityWidget()" x-init="init()" @click.outside="open = false" class="fixed left-4 bottom-6 md:left-6 md:bottom-6" style="position: fixed; bottom: 24px; left: 20px; z-index: 999998;">
    {{-- Tombol Trigger Floating di Kiri Bawah --}}
    <button type="button" @click="open = !open"
        class="flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-2xl transition-all duration-300 hover:scale-110 border-2 border-white/30 focus:outline-none"
        style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4); border: 2px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; cursor: pointer;"
        title="Menu Aksesibilitas Disabilitas (Ramah Inklusi)">
        <i class="ph-bold" :class="open ? 'ph-x text-2xl' : 'ph-wheelchair text-3xl'" style="font-size: 26px;"></i>
    </button>

    {{-- Panel Aksesibilitas Modal --}}
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-left"
        x-transition:enter-start="scale-90 opacity-0 translate-y-4"
        x-transition:enter-end="scale-100 opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-left"
        x-transition:leave-start="scale-100 opacity-100 translate-y-0"
        x-transition:leave-end="scale-90 opacity-0 translate-y-4"
        class="fixed left-4 bottom-20 md:left-6 md:bottom-24 w-[320px] sm:w-[360px] bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col"
        style="display: none; position: fixed; left: 20px; bottom: 85px; width: 340px; max-width: calc(100vw - 40px); max-height: calc(100vh - 110px); background: #ffffff; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.35); border: 1px solid #e5e7eb; z-index: 999998; overflow-y: auto;">
        
        {{-- Header Panel --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-900 p-4 sm:p-5 text-white flex items-center justify-between shrink-0"
            style="background: linear-gradient(to right, #1d4ed8, #1e3a8a); padding: 16px 20px; color: white; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.15);">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 font-bold text-2xl"
                    style="width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; color: #fde68a;">
                    <i class="ph-fill ph-universal-access"></i>
                </div>
                <div>
                    <h4 class="font-black text-sm md:text-base leading-tight m-0 text-white" style="font-weight: 900; font-size: 15px; margin: 0; color: white;">Aksesibilitas Web</h4>
                    <span class="text-[10px] sm:text-xs font-semibold text-blue-200 block" style="font-size: 11px; color: #bfdbfe; margin-top: 2px;">Layanan Ramah Disabilitas</span>
                </div>
            </div>
            <button type="button" @click="open = false" class="text-white hover:text-gray-200 p-1 rounded-lg bg-white/10"
                style="width: 32px; height: 32px; border-radius: 50%; background: rgba(255,255,255,0.15); border: none; color: #f3f4f6; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="ph-bold ph-x text-sm" style="font-size: 16px;"></i>
            </button>
        </div>

        {{-- Content Controls --}}
        <div class="p-4 sm:p-5 space-y-3 bg-gray-50 text-gray-800 text-xs" style="padding: 16px; background: #f8fafc; display: flex; flex-direction: column; gap: 12px;">
            <p class="text-[11px] text-gray-500 font-medium leading-relaxed m-0" style="font-size: 12px; color: #64748b; margin: 0;">
                Sesuaikan kenyamanan visual dan pembaca layar agar penjelajahan portal lebih mudah diakses.
            </p>

            {{-- 1. Pengaturan Ukuran Teks --}}
            <div class="bg-white p-3 rounded-2xl border border-gray-200 shadow-sm" style="background: white; padding: 12px; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div class="flex items-center justify-between font-extrabold text-xs mb-2.5 text-gray-800" style="display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 13px; margin-bottom: 8px;">
                    <span class="flex items-center gap-2"><i class="ph-bold ph-text-aa text-blue-600" style="color: #2563eb; font-size: 16px;"></i> Ukuran Teks (<span x-text="textSize + '%'"></span>)</span>
                </div>
                <div class="grid grid-cols-3 gap-2" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                    <button type="button" @click="decreaseText()" class="py-2 px-3 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 font-bold rounded-xl text-center transition-colors flex items-center justify-center gap-1 border border-gray-200"
                        style="padding: 8px; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; font-weight: 700; color: #334155; cursor: pointer;">
                        <i class="ph-bold ph-minus"></i> Kecilkan
                    </button>
                    <button type="button" @click="textSize = 100; applySettings();" class="py-2 px-3 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 font-bold rounded-xl text-center transition-colors border border-gray-200"
                        style="padding: 8px; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; font-weight: 700; color: #334155; cursor: pointer;">
                        Normal
                    </button>
                    <button type="button" @click="increaseText()" class="py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-center shadow-sm transition-all flex items-center justify-center gap-1 border border-blue-600"
                        style="padding: 8px; background: #2563eb; border: 1px solid #1d4ed8; border-radius: 10px; font-weight: 700; color: white; cursor: pointer;">
                        <i class="ph-bold ph-plus"></i> Besarkan
                    </button>
                </div>
            </div>

            {{-- 2. Grid Tombol Mode Aksesibilitas --}}
            <div class="grid grid-cols-2 gap-2 sm:gap-2.5" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                
                {{-- Pembaca Teks Suara (TTS) --}}
                <button type="button" @click="toggleSpeech()" 
                    :class="speechActive ? 'bg-amber-500 text-white border-amber-600 shadow-md ring-2 ring-amber-400' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="speechActive ? 'background: #d97706; color: white; border-color: #b45309;' : 'background: white; color: #334155;'">
                    <i class="ph-bold ph-speaker-high text-xl" :class="speechActive ? 'animate-pulse text-white' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Pembaca Suara</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="speechActive ? 'Aktif (Sorot Teks)' : 'Klik Aktifkan'"></span>
                </button>

                {{-- Sorot Tautan --}}
                <button type="button" @click="toggleHighlightLinks()" 
                    :class="highlightLinks ? 'bg-blue-600 text-white border-blue-700 shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="highlightLinks ? 'background: #2563eb; color: white; border-color: #1d4ed8;' : 'background: white; color: #334155;'">
                    <i class="ph-bold ph-link text-xl" :class="highlightLinks ? 'text-white' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Sorot Tautan</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="highlightLinks ? 'Aktif' : 'Normal'"></span>
                </button>

                {{-- Kontras Tinggi --}}
                <button type="button" @click="toggleHighContrast()" 
                    :class="highContrast ? 'bg-[#0a0f1c] text-yellow-400 border-yellow-400 font-extrabold shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="highContrast ? 'background: #000000; color: #ffff00; border: 2px solid #ffff00;' : 'background: white; color: #334155;'">
                    <i class="ph-fill ph-circle-half text-xl" :class="highContrast ? 'text-yellow-400' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Kontras Tinggi</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="highContrast ? 'Aktif' : 'Normal'"></span>
                </button>

                {{-- Mode Monokrom (Grayscale) --}}
                <button type="button" @click="toggleGrayscale()" 
                    :class="grayscale ? 'bg-gray-700 text-white border-gray-800 shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="grayscale ? 'background: #475569; color: white; border-color: #334155;' : 'background: white; color: #334155;'">
                    <i class="ph-bold ph-eye text-xl" :class="grayscale ? 'text-white' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Monokrom</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="grayscale ? 'Aktif' : 'Normal'"></span>
                </button>

                {{-- Kontras Gelap (Dark Inverted) --}}
                <button type="button" @click="toggleDarkContrast()" 
                    :class="darkContrast ? 'bg-[#1e1e24] text-amber-300 border-amber-400 shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="darkContrast ? 'background: #1e1e24; color: #fcd34d; border-color: #f59e0b;' : 'background: white; color: #334155;'">
                    <i class="ph-fill ph-moon text-xl" :class="darkContrast ? 'text-amber-300' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Mode Gelap</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="darkContrast ? 'Aktif' : 'Normal'"></span>
                </button>

                {{-- Spasi & Jarak Teks yang Mudah Dibaca (Dyslexia Friendly) --}}
                <button type="button" @click="toggleReadableText()" 
                    :class="readableText ? 'bg-teal-600 text-white border-teal-700 shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-700'"
                    class="p-3 rounded-2xl border flex flex-col items-center justify-center text-center gap-1.5 transition-all font-bold text-xs"
                    style="padding: 12px; border-radius: 16px; border: 1px solid #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-center; gap: 6px; cursor: pointer; min-height: 80px;"
                    :style="readableText ? 'background: #0d9488; color: white; border-color: #0f766e;' : 'background: white; color: #334155;'">
                    <i class="ph-bold ph-text-columns text-xl" :class="readableText ? 'text-white' : 'text-blue-600'" style="font-size: 22px;"></i>
                    <span>Spasi Ramah</span>
                    <span class="text-[9px] font-medium opacity-80" x-text="readableText ? 'Aktif' : 'Normal'"></span>
                </button>
            </div>

            {{-- 3. Tombol Reset Pengaturan --}}
            <div class="pt-2 border-t border-gray-200 mt-2" style="padding-top: 8px; border-top: 1px solid #e2e8f0; margin-top: 4px;">
                <button type="button" @click="resetAll()"
                    class="w-full py-2.5 px-4 bg-red-50 hover:bg-red-100 text-red-600 font-extrabold rounded-xl transition-colors flex items-center justify-center gap-2 text-xs border border-red-200"
                    style="width: 100%; padding: 10px 16px; background: #fef2f2; border: 1px solid #fca5a5; color: #dc2626; font-weight: 800; border-radius: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
                    <i class="ph-bold ph-arrow-counter-clockwise text-sm"></i> Reset Semua Pengaturan
                </button>
            </div>
        </div>
    </div>
</div>
