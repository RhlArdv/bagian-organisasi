{{-- ═══ NAVBAR ═══ --}}
<header :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm' : 'bg-transparent'"
        class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
        :class="scrolled ? 'border-gray-100' : ''">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 h-20 lg:h-24 flex items-center justify-between">
        
        {{-- Logo Area --}}
        <a href="/" class="flex items-center gap-4 group justify-self-start">
            <div class="relative w-10 h-12 lg:w-12 lg:h-14 shrink-0 transition-transform duration-500 group-hover:scale-105">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-full h-full object-contain relative z-10">
                <div class="absolute inset-0 bg-brand-500/20 blur-xl rounded-full scale-150 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
            <div class="flex flex-col">
                <span class="block text-[10px] lg:text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-0.5">Pemerintah Kota Padang</span>
                <span class="block text-sm font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden lg:flex items-center justify-center gap-6 xl:gap-8 flex-1 px-4">
            <a href="/#beranda" class="text-[13px] font-bold {{ request()->is('/') ? 'text-brand-500 border-b-2 border-brand-500 pb-1' : 'text-gray-500 hover:text-brand-500 transition-colors' }} uppercase tracking-wide">Beranda</a>
            <a href="/profil" class="text-[13px] font-bold {{ request()->is('profil') ? 'text-brand-500 border-b-2 border-brand-500 pb-1' : 'text-gray-500 hover:text-brand-500 transition-colors' }} uppercase tracking-wide">Profil</a>
            
            {{-- Dropdown Layanan --}}
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Layanan Utama <i class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition.opacity.duration.300ms class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-56 bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col z-50">
                    <a href="/#pelayanan" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Pelayanan</a>
                    <a href="/#tatalaksana" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Tata Laksana</a>
                    <a href="/#kelembagaan" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Kelembagaan</a>
                </div>
            </div>

            {{-- Dropdown Publikasi --}}
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide flex items-center gap-1 whitespace-nowrap">
                    Informasi <i class="ph-bold ph-caret-down text-brand-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition.opacity.duration.300ms class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-48 bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 flex flex-col z-50">
                    <a href="/#regulasi" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Regulasi</a>
                    <a href="/#berita" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Berita Terkini</a>
                    <a href="/#download" class="px-5 py-2.5 text-[13px] font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 hover:pl-6 transition-all">Download Area</a>
                </div>
            </div>

            <a href="/#kontak" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Kontak</a>
        </nav>

        {{-- Right side --}}
        <div class="flex items-center gap-4 justify-self-end shrink-0">
            {{-- Language Switcher --}}
            <div class="hidden lg:block relative" x-data="{ langOpen: false }" @mouseenter="langOpen = true" @mouseleave="langOpen = false">
                <button class="flex items-center gap-1.5 text-gray-500 hover:text-brand-500 transition-colors px-3 py-1.5 rounded-xl hover:bg-gray-50 text-sm font-bold">
                    <i class="ph-bold ph-globe-hemisphere-west text-xl"></i>
                    <span>ID</span>
                    <i class="ph-bold ph-caret-down text-[10px] transition-transform duration-300" :class="langOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="langOpen" x-transition.opacity.duration.300ms class="absolute top-full right-0 mt-2 w-36 bg-white border border-gray-100 shadow-xl shadow-gray-900/5 rounded-2xl py-2 flex flex-col z-50">
                    <a href="#" class="px-4 py-2.5 text-[13px] font-bold text-brand-500 bg-brand-50 flex items-center justify-between">
                        Indonesia <i class="ph-bold ph-check"></i>
                    </a>
                    <a href="#" class="px-4 py-2.5 text-[13px] font-bold text-gray-500 hover:text-brand-500 hover:bg-brand-50 transition-colors">
                        English
                    </a>
                </div>
            </div>
            {{-- Mobile Toggle --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-900 text-2xl w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors">
                <i class="ph" :class="mobileOpen ? 'ph-x' : 'ph-list'"></i>
            </button>
        </div>
    </div>
</header>
