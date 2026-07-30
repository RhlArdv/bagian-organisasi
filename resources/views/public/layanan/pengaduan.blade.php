<x-public-layout :title="'Layanan Pengaduan'" :metaDescription="'Sampaikan aspirasi, keluhan, dan pengaduan Anda untuk perbaikan layanan publik Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Layanan Pengaduan</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Layanan Pengaduan</span>
        </nav>
    </section>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <section class="mb-8">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 flex items-start gap-4" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-check-circle text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-base font-bold text-emerald-800 mb-1">Pengaduan Berhasil Dikirim!</h4>
                        <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                        <p class="text-xs text-emerald-600 font-medium mt-2">Simpan nomor tiket Anda untuk tracking status pengaduan.</p>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                        <i class="ph-bold ph-x text-lg"></i>
                    </button>
                </div>
            </div>
        </section>
    @endif

    {{-- HERO + INFO --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-[#1e293b] rounded-[2.5rem] p-10 lg:p-14 text-white overflow-hidden">
                {{-- Decorative --}}
                <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none">
                    <i class="ph-fill ph-megaphone text-[14rem] text-white"></i>
                </div>
                <div class="absolute top-0 left-0 w-80 h-80 bg-brand-500/10 rounded-full blur-[80px] pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-start gap-8">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span> Suaramu Penting
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black mb-4 leading-tight tracking-tight">Sampaikan Pengaduan<br>Secara Langsung</h2>
                        <p class="text-gray-300 font-medium leading-relaxed max-w-lg">
                            Kami membuka ruang bagi seluruh masyarakat untuk menyampaikan aspirasi, keluhan, dan laporan untuk perbaikan layanan publik di Kota Padang.
                        </p>
                    </div>

                    {{-- Quick Info Cards --}}
                    <div class="w-full lg:w-auto grid grid-cols-2 gap-3 shrink-0">
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 text-center">
                            <i class="ph-fill ph-clock text-2xl text-amber-400 mb-2"></i>
                            <p class="text-xs text-gray-300 font-bold uppercase tracking-wider">Respon</p>
                            <p class="text-lg font-black text-white mt-1">3x24 Jam</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 text-center">
                            <i class="ph-fill ph-shield-check text-2xl text-emerald-400 mb-2"></i>
                            <p class="text-xs text-gray-300 font-bold uppercase tracking-wider">Data</p>
                            <p class="text-lg font-black text-white mt-1">Terjaga</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 text-center">
                            <i class="ph-fill ph-ticket text-2xl text-blue-400 mb-2"></i>
                            <p class="text-xs text-gray-300 font-bold uppercase tracking-wider">Tracking</p>
                            <p class="text-lg font-black text-white mt-1">No. Tiket</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 text-center">
                            <i class="ph-fill ph-eye text-2xl text-purple-400 mb-2"></i>
                            <p class="text-xs text-gray-300 font-bold uppercase tracking-wider">Proses</p>
                            <p class="text-lg font-black text-white mt-1">Transparan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FORM + PROSEDUR --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-8">

                {{-- FORM (3 cols) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-[2.5rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                        <h3 class="text-xl font-black text-[#1a202c] mb-2 tracking-tight">Formulir Pengaduan</h3>
                        <p class="text-sm text-gray-500 font-medium mb-8">Isi data di bawah dengan lengkap. Kami akan merespon pengaduan Anda secepatnya.</p>

                        <form action="{{ route('public.pengaduan.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div>
                                <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all"
                                       placeholder="Masukkan nama lengkap Anda">
                                @error('name')<p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all"
                                           placeholder="contoh@email.com">
                                    @error('email')<p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="phone" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">No. Telepon / WhatsApp</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all"
                                           placeholder="08xxxxxxxxxx">
                                    @error('phone')<p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Subjek Pengaduan <span class="text-red-500">*</span></label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all"
                                       placeholder="Perihal pengaduan Anda">
                                @error('subject')<p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="message" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Isi Pengaduan <span class="text-red-500">*</span></label>
                                <textarea name="message" id="message" rows="5" required
                                          class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all resize-none"
                                          placeholder="Jelaskan pengaduan Anda secara rinci...">{{ old('message') }}</textarea>
                                @error('message')<p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit"
                                    class="w-full bg-[#1e293b] hover:bg-[#0f172a] text-white font-black py-4 rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-xl shadow-gray-900/10 hover:scale-[1.01]">
                                KIRIM PENGADUAN <i class="ph-bold ph-paper-plane-tilt"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- PROSEDUR SIDEBAR (2 cols) --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Alur Pengaduan --}}
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                        <h4 class="text-lg font-black text-[#1a202c] mb-6 flex items-center gap-2">
                            <i class="ph-fill ph-flow-arrow text-brand-400"></i> Alur Pengaduan
                        </h4>
                        <div class="space-y-5">
                            @php
                                $steps = [
                                    ['icon' => 'ph-pencil-simple', 'color' => 'blue', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data dan jelaskan pengaduan Anda'],
                                    ['icon' => 'ph-ticket', 'color' => 'purple', 'title' => 'Terima No. Tiket', 'desc' => 'Simpan nomor tiket untuk tracking'],
                                    ['icon' => 'ph-magnifying-glass', 'color' => 'amber', 'title' => 'Verifikasi & Tindak Lanjut', 'desc' => 'Tim kami akan memverifikasi dan menindaklanjuti'],
                                    ['icon' => 'ph-check-circle', 'color' => 'emerald', 'title' => 'Respon & Penyelesaian', 'desc' => 'Anda akan menerima respon dalam 3x24 jam'],
                                ];
                            @endphp
                            @foreach($steps as $index => $step)
                                <div class="flex items-start gap-4">
                                    <div class="relative flex flex-col items-center">
                                        <div class="w-10 h-10 bg-{{ $step['color'] }}-50 text-{{ $step['color'] }}-500 rounded-xl flex items-center justify-center shrink-0">
                                            <i class="ph-bold {{ $step['icon'] }} text-lg"></i>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="w-px h-6 bg-gray-200 mt-2"></div>
                                        @endif
                                    </div>
                                    <div class="pt-1.5">
                                        <h5 class="text-sm font-bold text-[#1a202c]">{{ $step['title'] }}</h5>
                                        <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Kontak Langsung --}}
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-[2rem] p-8 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                        <h4 class="text-lg font-black text-[#1a202c] mb-4 flex items-center gap-2">
                            <i class="ph-fill ph-phone text-brand-400"></i> Kontak Langsung
                        </h4>
                        <p class="text-xs text-gray-500 font-medium mb-5">Untuk pengaduan mendesak, hubungi kami langsung:</p>
                        <div class="space-y-4">
                            <a href="tel:07514640800" class="flex items-center gap-3 text-sm font-bold text-[#1a202c] hover:text-brand-400 transition-colors">
                                <div class="w-9 h-9 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center">
                                    <i class="ph-fill ph-phone"></i>
                                </div>
                                (0751) 4640800
                            </a>
                            <a href="mailto:bag.organisasi@padang.go.id" class="flex items-center gap-3 text-sm font-bold text-[#1a202c] hover:text-brand-400 transition-colors">
                                <div class="w-9 h-9 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="ph-fill ph-envelope-simple"></i>
                                </div>
                                bag.organisasi@padang.go.id
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-public-layout>
