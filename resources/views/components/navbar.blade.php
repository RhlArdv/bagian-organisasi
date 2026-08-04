<header :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm' : 'bg-transparent'"
    class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
    :class="scrolled ? 'border-gray-100' : ''">
    <div class="max-w-[1400px] w-full mx-auto px-4 sm:px-5 lg:px-8 h-20 lg:h-24 flex items-center justify-between">

        {{-- Logo Area (min-w to balance the right side) --}}
        <a href="/" class="flex items-center gap-2.5 sm:gap-3 lg:gap-4 group shrink-0 min-w-0 lg:min-w-[240px]">
            <div
                class="relative w-10 h-12 lg:w-12 lg:h-14 shrink-0 transition-transform duration-500 group-hover:scale-105">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang"
                    class="w-full h-full object-contain relative z-10">
                <div
                    class="absolute inset-0 bg-brand-500/20 blur-xl rounded-full scale-150 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
            </div>
            <div class="flex flex-col">
                <span
                    class="block text-[10px] lg:text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-0.5">Pemerintah
                    Kota Padang</span>
                <span class="block text-sm font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden lg:flex flex-1 items-center justify-center gap-4 lg:gap-5 xl:gap-6 px-4">
            <a href="/#beranda"
                class="text-[12px] xl:text-[13px] font-bold {{ request()->is('/') ? 'text-brand-500 border-b-2 border-brand-500 pb-1' : 'text-gray-500 hover:text-brand-500 transition-colors' }} uppercase tracking-wide whitespace-nowrap">Beranda</a>
            <a href="/profil"
                class="text-[12px] xl:text-[13px] font-bold {{ request()->is('profil') ? 'text-brand-500 border-b-2 border-brand-500 pb-1' : 'text-gray-500 hover:text-brand-500 transition-colors' }} uppercase tracking-wide whitespace-nowrap">Profil</a>

            {{-- Dropdown Kelembagaan --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Kelembagaan <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.kelembagaan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Penataan
                            Kelembagaan</a>
                        <a href="{{ route('public.evaluasi-kelembagaan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Evaluasi
                            Kelembagaan</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Nomenklatur
                            OPD</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Peta
                            Jabatan</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Produk
                            Hukum</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Anjab & ABK --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Anjab & ABK <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.anjab-abk') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Informasi
                            Anjab</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Informasi
                            ABK</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Pedoman</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Pelayanan Publik --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Pelayanan Publik <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-64 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.standar-pelayanan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Standar
                            Pelayanan</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Survei
                            Kepuasan Masyarakat</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Forum
                            Konsultasi Publik</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Dokumen
                            Pelayanan Publik</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Tata Laksana --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Tata Laksana <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.sop') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">SOP
                            Pelayanan</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Peta
                            Proses Bisnis</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Tata
                            Naskah Dinas</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Reformasi Birokrasi --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Reformasi Birokrasi <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-48 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.reformasi-birokrasi') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Indeks
                            RB</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">SAKIP</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Regulasi --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Regulasi <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-48 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">UU</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">PP</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">PermenPANRB</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Perda</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Perwako</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Surat
                            Edaran</a>
                    </div>
                </div>
            </div>

            {{-- Survei Kepuasan Masyarakat --}}
            <div class="py-2">
                <a href="https://surveidigital.spbe.go.id/embed/survey/eyJzdXJ2ZXlfaWQiOjIsInNlcnZpY2VfaWQiOjkxNiwiaG9zdCI6Imh0dHBzOi8vYmFnb3JnYW5pc2FzaS5wYWRhbmcuZ28uaWQiLCJrZXkiOiJyWTc3Z1VOciJ9/embed/view/?jenis_layanan=Website" target="_blank" rel="noopener noreferrer"
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center whitespace-nowrap">
                    SKM
                </a>
            </div>
        </nav>

        {{-- Tombol Hamburger untuk HP --}}
        <div class="flex items-center lg:hidden gap-2">
            <button type="button" @click="mobileOpen = !mobileOpen" 
                class="p-2.5 text-gray-700 hover:text-brand-500 hover:bg-brand-50 rounded-xl transition-colors focus:outline-none"
                aria-label="Toggle Menu">
                <i class="ph-bold" :class="mobileOpen ? 'ph-x text-2xl' : 'ph-list text-2xl'"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div x-show="mobileOpen" 
        x-transition:enter="transition ease-out duration-300 transform origin-top"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform origin-top"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
        class="lg:hidden bg-white border-b border-gray-200 shadow-2xl overflow-y-auto max-h-[85vh] px-5 py-6"
        style="display: none;">
        
        <div class="flex flex-col space-y-4">
            <a href="/#beranda" @click="mobileOpen = false" class="text-sm font-extrabold text-gray-800 hover:text-brand-500 py-2 border-b border-gray-100 flex items-center justify-between">
                <span>Beranda</span>
                <i class="ph-bold ph-arrow-right text-brand-500"></i>
            </a>
            <a href="/profil" @click="mobileOpen = false" class="text-sm font-extrabold text-gray-800 hover:text-brand-500 py-2 border-b border-gray-100 flex items-center justify-between">
                <span>Profil Bagian</span>
                <i class="ph-bold ph-arrow-right text-brand-500"></i>
            </a>

            {{-- Kelembagaan Mobile --}}
            <div x-data="{ openKelembagaan: false }" class="border-b border-gray-100 pb-2">
                <button @click="openKelembagaan = !openKelembagaan" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-brand-500">
                    <span>Kelembagaan</span>
                    <i class="ph-bold transition-transform" :class="openKelembagaan ? 'ph-caret-up text-brand-500' : 'ph-caret-down'"></i>
                </button>
                <div x-show="openKelembagaan" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.kelembagaan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Penataan Kelembagaan</a>
                    <a href="{{ route('public.evaluasi-kelembagaan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Evaluasi Kelembagaan</a>
                    <a href="#" @click="mobileOpen = false" class="hover:text-brand-500">Nomenklatur OPD</a>
                    <a href="#" @click="mobileOpen = false" class="hover:text-brand-500">Peta Jabatan & Produk Hukum</a>
                </div>
            </div>

            {{-- Anjab & ABK Mobile --}}
            <div x-data="{ openAnjab: false }" class="border-b border-gray-100 pb-2">
                <button @click="openAnjab = !openAnjab" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-brand-500">
                    <span>Anjab & ABK</span>
                    <i class="ph-bold transition-transform" :class="openAnjab ? 'ph-caret-up text-brand-500' : 'ph-caret-down'"></i>
                </button>
                <div x-show="openAnjab" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.anjab-abk') }}" @click="mobileOpen = false" class="hover:text-brand-500">Informasi Anjab & ABK</a>
                    <a href="#" @click="mobileOpen = false" class="hover:text-brand-500">Pedoman Analisis</a>
                </div>
            </div>

            {{-- Pelayanan Publik Mobile --}}
            <div x-data="{ openPelayanan: false }" class="border-b border-gray-100 pb-2">
                <button @click="openPelayanan = !openPelayanan" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-brand-500">
                    <span>Pelayanan Publik</span>
                    <i class="ph-bold transition-transform" :class="openPelayanan ? 'ph-caret-up text-brand-500' : 'ph-caret-down'"></i>
                </button>
                <div x-show="openPelayanan" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.standar-pelayanan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Standar Pelayanan</a>
                    <a href="#" @click="mobileOpen = false" class="hover:text-brand-500">Survei Kepuasan Masyarakat (SKM)</a>
                    <a href="#" @click="mobileOpen = false" class="hover:text-brand-500">Forum Konsultasi Publik</a>
                </div>
            </div>

            {{-- Reformasi Birokrasi & Berita Mobile --}}
            <a href="{{ route('public.reformasi-birokrasi') }}" @click="mobileOpen = false" class="text-sm font-extrabold text-gray-800 hover:text-brand-500 py-2 border-b border-gray-100 flex items-center justify-between">
                <span>Reformasi Birokrasi & SAKIP</span>
                <i class="ph-bold ph-arrow-right text-brand-500"></i>
            </a>
            <a href="{{ route('public.berita.index') }}" @click="mobileOpen = false" class="text-sm font-extrabold text-gray-800 hover:text-brand-500 py-2 border-b border-gray-100 flex items-center justify-between">
                <span>Berita & Pengumuman</span>
                <i class="ph-bold ph-arrow-right text-brand-500"></i>
            </a>
            <a href="{{ route('public.pengaduan') }}" @click="mobileOpen = false" class="text-sm font-extrabold text-brand-500 hover:text-brand-600 py-3 bg-brand-50 rounded-xl px-4 flex items-center justify-between mt-3 shadow-sm">
                <span class="flex items-center gap-2"><i class="ph-fill ph-chat-circle-dots text-lg"></i> Kritik, Saran & Pengaduan</span>
                <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>
    </div>
</header>