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
            {{-- Dropdown Profil --}}
            <div class="relative group py-2">
                <a href="/profil"
                    class="text-[12px] xl:text-[13px] font-bold {{ request()->is('profil*') ? 'text-brand-500 border-b-2 border-brand-500 pb-1' : 'text-gray-500 group-hover:text-brand-500 transition-colors' }} uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Profil <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ url('/profil') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Profil Organisasi</a>
                        <a href="{{ url('/profil/visi-misi') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Visi & Misi</a>
                        <a href="{{ url('/profil/tugas-fungsi') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Tugas Pokok & Fungsi</a>
                        <a href="{{ url('/profil/maklumat-pelayanan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Maklumat Pelayanan</a>
                        <a href="{{ url('/profil/struktur-organisasi') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Struktur & Pegawai</a>
                    </div>
                </div>
            </div>

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
                        <a href="{{ route('public.nomenklatur-opd') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Nomenklatur
                            OPD</a>
                        <a href="{{ route('public.peta-jabatan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Peta
                            Jabatan</a>
                        <a href="{{ route('public.produk-hukum') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Produk
                            Hukum</a>
                    </div>
                </div>
            </div>

            {{-- Dropdown Anjab & ABK --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-purple-600 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Anjab & ABK <i
                        class="ph-bold ph-caret-down text-purple-600 transition-transform duration-300 group-hover:rotate-180" style="color: #9333ea;"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-purple-100 shadow-xl shadow-purple-500/10 rounded-2xl py-3 flex flex-col" style="border: 1px solid #e9d5ff;">
                        <a href="{{ route('public.anjab-abk', ['tab' => 'informasi-anjab']) }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-purple-600 hover:bg-purple-50 hover:pl-6 transition-all">Informasi
                            Anjab</a>
                        <a href="{{ route('public.anjab-abk', ['tab' => 'informasi-abk']) }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-purple-600 hover:bg-purple-50 hover:pl-6 transition-all">Informasi
                            ABK</a>
                        <a href="{{ route('public.anjab-abk', ['tab' => 'pedoman-anjab-abk']) }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-purple-600 hover:bg-purple-50 hover:pl-6 transition-all">Pedoman
                            Anjab & ABK</a>
                        <a href="{{ route('public.anjab-abk', ['tab' => 'formulir-permohonan']) }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-purple-600 hover:bg-purple-50 hover:pl-6 transition-all">Formulir
                            Permohonan</a>
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
                        <a href="{{ route('public.maklumat-pelayanan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Maklumat
                            Pelayanan</a>
                        <a href="{{ route('public.skm') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Survei
                            Kepuasan Masyarakat</a>
                        <a href="{{ route('public.forum-konsultasi-publik') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Forum
                            Konsultasi Publik</a>
                        <a href="{{ route('public.pengelolaan-pengaduan') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Pengelolaan
                            Pengaduan</a>
                        <a href="{{ route('public.dokumen-pelayanan-publik') }}"
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
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:pl-6 transition-all">SOP
                            Pelayanan</a>
                        <a href="{{ route('public.peta-proses-bisnis') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:pl-6 transition-all">Peta
                            Proses Bisnis</a>
                        <a href="{{ route('public.tata-naskah-dinas') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:pl-6 transition-all">Tata
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
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 hover:pl-6 transition-all">Indeks RB</a>
                        <a href="{{ route('public.sakip') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-amber-600 hover:bg-amber-50 hover:pl-6 transition-all">SAKIP</a>
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
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-auto min-w-[250px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="{{ route('public.regulasi.sub', 'undang-undang') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Undang-Undang</a>
                        <a href="{{ route('public.regulasi.sub', 'peraturan-pemerintah') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Peraturan Pemerintah</a>
                        <a href="{{ route('public.regulasi.sub', 'permenpanrb') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Peraturan Menteri PANRB</a>
                        <a href="{{ route('public.regulasi.sub', 'perda') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Peraturan Daerah</a>
                        <a href="{{ route('public.regulasi.sub', 'perwako') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Peraturan Wali Kota</a>
                        <a href="{{ route('public.regulasi.sub', 'surat-edaran') }}"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all whitespace-nowrap">Surat Edaran</a>
                    </div>
                </div>
            </div>

            {{-- Survei Kepuasan Masyarakat --}}
            <div class="py-2">
                <a href="https://surveidigital.spbe.go.id/survey/eyJzdXJ2ZXlfaWQiOjIsInNlcnZpY2VfaWQiOjkxNiwiaG9zdCI6Imh0dHBzOi8vYmFnb3JnYW5pc2FzaS5wYWRhbmcuZ28uaWQiLCJrZXkiOiJyWTc3Z1VOciJ9" target="_blank" rel="noopener"
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
            {{-- Profil Mobile --}}
            <div x-data="{ openProfil: false }" class="border-b border-gray-100 pb-2">
                <button @click="openProfil = !openProfil" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-brand-500">
                    <span>Profil Bagian</span>
                    <i class="ph-bold transition-transform" :class="openProfil ? 'ph-caret-up text-brand-500' : 'ph-caret-down'"></i>
                </button>
                <div x-show="openProfil" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ url('/profil') }}" @click="mobileOpen = false" class="hover:text-brand-500">Profil Organisasi</a>
                    <a href="{{ url('/profil/visi-misi') }}" @click="mobileOpen = false" class="hover:text-brand-500">Visi & Misi</a>
                    <a href="{{ url('/profil/tugas-fungsi') }}" @click="mobileOpen = false" class="hover:text-brand-500">Tugas Pokok & Fungsi</a>
                    <a href="{{ url('/profil/maklumat-pelayanan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Maklumat Pelayanan</a>
                    <a href="{{ url('/profil/struktur-organisasi') }}" @click="mobileOpen = false" class="hover:text-brand-500">Struktur & Pegawai</a>
                </div>
            </div>

            {{-- Kelembagaan Mobile --}}
            <div x-data="{ openKelembagaan: false }" class="border-b border-gray-100 pb-2">
                <button @click="openKelembagaan = !openKelembagaan" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-brand-500">
                    <span>Kelembagaan</span>
                    <i class="ph-bold transition-transform" :class="openKelembagaan ? 'ph-caret-up text-brand-500' : 'ph-caret-down'"></i>
                </button>
                <div x-show="openKelembagaan" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.kelembagaan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Penataan Kelembagaan</a>
                    <a href="{{ route('public.evaluasi-kelembagaan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Evaluasi Kelembagaan</a>
                    <a href="{{ route('public.nomenklatur-opd') }}" @click="mobileOpen = false" class="hover:text-brand-500">Nomenklatur OPD</a>
                    <a href="{{ route('public.peta-jabatan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Peta Jabatan</a>
                    <a href="{{ route('public.produk-hukum') }}" @click="mobileOpen = false" class="hover:text-brand-500">Produk Hukum</a>
                </div>
            </div>

            {{-- Anjab & ABK Mobile --}}
            <div x-data="{ openAnjab: false }" class="border-b border-gray-100 pb-2">
                <button @click="openAnjab = !openAnjab" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-purple-600">
                    <span>Anjab & ABK</span>
                    <i class="ph-bold transition-transform" :class="openAnjab ? 'ph-caret-up text-purple-600' : 'ph-caret-down'" style="color: #9333ea;"></i>
                </button>
                <div x-show="openAnjab" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.anjab-abk', ['tab' => 'informasi-anjab']) }}" @click="mobileOpen = false" class="hover:text-purple-600">Informasi Anjab</a>
                    <a href="{{ route('public.anjab-abk', ['tab' => 'informasi-abk']) }}" @click="mobileOpen = false" class="hover:text-purple-600">Informasi ABK</a>
                    <a href="{{ route('public.anjab-abk', ['tab' => 'pedoman-anjab-abk']) }}" @click="mobileOpen = false" class="hover:text-purple-600">Pedoman Anjab & ABK</a>
                    <a href="{{ route('public.anjab-abk', ['tab' => 'formulir-permohonan']) }}" @click="mobileOpen = false" class="hover:text-purple-600">Formulir Permohonan</a>
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
                    <a href="{{ route('public.maklumat-pelayanan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Maklumat Pelayanan</a>
                    <a href="{{ route('public.skm') }}" @click="mobileOpen = false" class="hover:text-brand-500">Survei Kepuasan Masyarakat (SKM)</a>
                    <a href="{{ route('public.forum-konsultasi-publik') }}" @click="mobileOpen = false" class="hover:text-brand-500">Forum Konsultasi Publik</a>
                    <a href="{{ route('public.pengelolaan-pengaduan') }}" @click="mobileOpen = false" class="hover:text-brand-500">Pengelolaan Pengaduan</a>
                    <a href="{{ route('public.dokumen-pelayanan-publik') }}" @click="mobileOpen = false" class="hover:text-brand-500">Dokumen Pelayanan Publik</a>
                </div>
            </div>

            {{-- Tata Laksana Mobile --}}
            <div x-data="{ openTataLaksana: false }" class="border-b border-gray-100 pb-2">
                <button @click="openTataLaksana = !openTataLaksana" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-blue-600">
                    <span>Tata Laksana</span>
                    <i class="ph-bold transition-transform" :class="openTataLaksana ? 'ph-caret-up text-blue-600' : 'ph-caret-down'" style="color: #2563eb;"></i>
                </button>
                <div x-show="openTataLaksana" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.sop') }}" @click="mobileOpen = false" class="hover:text-blue-600">SOP Pelayanan</a>
                    <a href="{{ route('public.peta-proses-bisnis') }}" @click="mobileOpen = false" class="hover:text-blue-600">Peta Proses Bisnis</a>
                    <a href="{{ route('public.tata-naskah-dinas') }}" @click="mobileOpen = false" class="hover:text-blue-600">Tata Naskah Dinas</a>
                </div>
            </div>

            {{-- Reformasi Birokrasi Mobile --}}
            <div x-data="{ openRb: false }" class="border-b border-gray-100 pb-2">
                <button @click="openRb = !openRb" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-indigo-600">
                    <span>Reformasi Birokrasi</span>
                    <i class="ph-bold transition-transform" :class="openRb ? 'ph-caret-up text-indigo-600' : 'ph-caret-down'" style="color: #4f46e5;"></i>
                </button>
                <div x-show="openRb" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.reformasi-birokrasi') }}" @click="mobileOpen = false" class="hover:text-indigo-600">Indeks RB</a>
                    <a href="{{ route('public.sakip') }}" @click="mobileOpen = false" class="hover:text-amber-600">SAKIP</a>
                </div>
            </div>

            {{-- Regulasi Mobile --}}
            <div x-data="{ openRegulasi: false }" class="border-b border-gray-100 pb-2">
                <button @click="openRegulasi = !openRegulasi" class="w-full flex items-center justify-between py-2 text-sm font-extrabold text-gray-800 hover:text-red-600">
                    <span>Regulasi</span>
                    <i class="ph-bold transition-transform" :class="openRegulasi ? 'ph-caret-up text-red-600' : 'ph-caret-down'" style="color: #dc2626;"></i>
                </button>
                <div x-show="openRegulasi" class="pl-4 pt-2 flex flex-col space-y-2.5 text-xs font-bold text-gray-600" style="display: none;">
                    <a href="{{ route('public.regulasi.sub', 'undang-undang') }}" @click="mobileOpen = false" class="hover:text-red-600">Undang-Undang</a>
                    <a href="{{ route('public.regulasi.sub', 'peraturan-pemerintah') }}" @click="mobileOpen = false" class="hover:text-red-600">Peraturan Pemerintah</a>
                    <a href="{{ route('public.regulasi.sub', 'permenpanrb') }}" @click="mobileOpen = false" class="hover:text-red-600">Peraturan Menteri PANRB</a>
                    <a href="{{ route('public.regulasi.sub', 'perda') }}" @click="mobileOpen = false" class="hover:text-red-600">Peraturan Daerah</a>
                    <a href="{{ route('public.regulasi.sub', 'perwako') }}" @click="mobileOpen = false" class="hover:text-red-600">Peraturan Wali Kota</a>
                    <a href="{{ route('public.regulasi.sub', 'surat-edaran') }}" @click="mobileOpen = false" class="hover:text-red-600">Surat Edaran</a>
                </div>
            </div>
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