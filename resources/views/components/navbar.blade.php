<header :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm' : 'bg-transparent'"
    class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
    :class="scrolled ? 'border-gray-100' : ''">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-8 h-20 lg:h-24 flex items-center justify-between">

        {{-- Logo Area --}}
        <a href="/" class="flex items-center gap-3 lg:gap-4 group shrink-0">
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
                        <a href="#"
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

            {{-- Dropdown Download --}}
            <div class="relative group py-2">
                <button
                    class="text-[12px] xl:text-[13px] font-bold text-gray-500 group-hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Download <i
                        class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-56 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col">
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Formulir</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">SOP</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Standar
                            Pelayanan</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Pedoman</a>
                        <a href="#"
                            class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Template</a>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Right side --}}
        <div class="flex items-center justify-end gap-4 shrink-0">
            {{-- Language Switcher --}}
            <div class="hidden lg:block relative group py-2">
                <button
                    class="flex items-center gap-1.5 text-gray-500 group-hover:text-brand-500 transition-colors px-3 py-1.5 rounded-xl group-hover:bg-gray-50 text-sm font-bold">
                    <i class="ph-bold ph-globe-hemisphere-west text-xl"></i>
                    <span>ID</span>
                    <i
                        class="ph-bold ph-caret-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div
                    class="absolute top-full right-0 pt-2 w-36 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    <div
                        class="bg-white border border-gray-100 shadow-xl shadow-gray-900/5 rounded-2xl py-2 flex flex-col">
                        <a href="#"
                            class="px-4 py-2.5 text-[13px] font-bold text-brand-500 bg-brand-50 flex items-center justify-between">
                            Indonesia <i class="ph-bold ph-check"></i>
                        </a>
                        <a href="#"
                            class="px-4 py-2.5 text-[13px] font-bold text-gray-500 hover:text-brand-500 hover:bg-brand-50 transition-colors">
                            English
                        </a>
                    </div>
                </div>
            </div>
            {{-- Mobile Toggle --}}
            <button @click="mobileOpen = !mobileOpen"
                class="lg:hidden text-gray-900 text-2xl w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors">
                <i class="ph" :class="mobileOpen ? 'ph-x' : 'ph-list'"></i>
            </button>
        </div>
    </div>
</header>