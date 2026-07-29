
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal resmi Bagian Organisasi Sekretariat Daerah Kota Padang. Informasi kelembagaan, pelayanan publik, tata laksana, dan reformasi birokrasi.">
    <title>Bagian Organisasi — Sekretariat Daerah Kota Padang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: { extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        script: ['"Caveat"', 'cursive'],
                    },
                    colors: {
                        brand: { 50: '#fffbf0', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f', 950: '#451a03' },
                    },
                }}
            }
        </script>
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
        ::selection { background: #f59e0b; color: #fff; }
        .hero-pattern { background-image: radial-gradient(#fde68a 1px, transparent 1px); background-size: 32px 32px; }
        
        /* Floating animations */
        @keyframes float-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        .animate-float-slow { animation: float-slow 6s ease-in-out infinite; }
        
        /* Stats bar responsive */
        @media (min-width: 1024px) {
            .stats-bar > div { flex: 1 1 0 !important; }
        }
    </style>
</head>

<body class="bg-[#fafafa] text-gray-900 antialiased overflow-x-hidden min-h-screen"
      x-data="{ scrolled: false, mobileOpen: false }"
      @scroll.window="scrolled = (window.pageYOffset > 30)">

{{-- ═══ NAVBAR ═══ --}}
<header :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm' : 'bg-transparent'"
        class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
        :class="scrolled ? 'border-gray-100' : ''">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 h-20 flex items-center justify-between">

        {{-- Logo --}}
        <a href="#" class="flex items-center gap-3 group">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="h-10 w-auto">
            <div class="leading-tight">
                <span class="block text-[11px] font-bold text-gray-900 tracking-widest uppercase">Pemerintah Kota Padang</span>
                <span class="block text-sm font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden xl:flex items-center gap-5">
            <a href="#beranda" class="text-[13px] font-bold text-brand-500 border-b-2 border-brand-500 pb-1 uppercase tracking-wide">Beranda</a>
            <a href="#profil" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Profil</a>
            <a href="#pelayanan" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Pelayanan</a>
            <a href="#tatalaksana" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Tata Laksana</a>
            <a href="#kelembagaan" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Kelembagaan</a>
            <a href="#regulasi" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Regulasi</a>
            <a href="#berita" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Berita</a>
            <a href="#download" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Download</a>
            <a href="#kontak" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Kontak</a>
        </nav>

        {{-- Right side (Search & Button) --}}
        <div class="hidden lg:flex items-center gap-4">
            <button class="text-gray-400 hover:text-gray-700 transition-colors">
                <i class="ph ph-magnifying-glass text-xl"></i>
            </button>
            <a href="#" class="h-9 px-4 inline-flex items-center gap-2 bg-[#fff8e1] text-[#f5a500] font-bold text-xs uppercase tracking-wide rounded-full hover:bg-yellow-100 transition-colors">
                Portal Padang <i class="ph ph-arrow-up-right"></i>
            </a>
        </div>

        {{-- Mobile Toggle --}}
        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-700 text-2xl">
            <i class="ph" :class="mobileOpen ? 'ph-x' : 'ph-list'"></i>
        </button>
    </div>
</header>

{{-- ═══ HERO ═══ --}}
<section id="beranda" class="relative overflow-hidden bg-white min-h-screen flex flex-col justify-center pt-24 lg:pt-20">
    
    {{-- Dot Pattern Background --}}
    <div class="absolute inset-0 z-0 opacity-50" style="background-image: radial-gradient(#fcd34d 1.5px, transparent 1.5px); background-size: 36px 36px;"></div>

    {{-- Absolute Huge Image (Anchored to the absolute right of the screen) --}}
    <div class="hidden lg:block absolute top-1/2 -translate-y-[45%] right-0 w-[1100px] xl:w-[1300px] pointer-events-none z-0">
        <img src="{{ asset('assets/img/hero.png') }}" 
             alt="Bagian Organisasi Sekretariat Daerah Kota Padang" 
             class="w-full h-auto object-contain object-right mix-blend-multiply" 
             style="-webkit-mask-image: linear-gradient(to right, transparent 0%, black 15%); mask-image: linear-gradient(to right, transparent 0%, black 15%);"
             onerror="this.src='https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=900&q=80'">
    </div>

    {{-- Main Hero Content --}}
    <div class="flex-1 flex items-center">
        <div class="w-full max-w-[90rem] mx-auto px-5 lg:px-12 relative z-10">
            <div class="w-full lg:w-[55%] relative z-20">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-[#f5a500] text-white text-[12px] font-bold tracking-wide mb-6">
                    Selamat Datang di
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-[4rem] font-extrabold text-gray-900 leading-[1.1] mb-5 tracking-tight">
                    Bagian Organisasi <br>
                    <span class="text-brand-500">Setda Kota Padang</span>
                </h1>
                
                <p class="text-gray-500 text-[15px] lg:text-[17px] mb-10 max-w-[90%] leading-relaxed font-medium">
                    Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik untuk Kota Padang yang lebih baik.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="#profil" class="h-[48px] px-8 inline-flex items-center justify-center gap-2 bg-[#f5a500] text-white font-bold text-[15px] rounded-xl hover:bg-yellow-600 transition-colors shadow-lg shadow-yellow-500/25">
                        Profil Organisasi <i class="ph ph-arrow-right"></i>
                    </a>
                    <a href="#pelayanan" class="h-[48px] px-8 inline-flex items-center justify-center gap-2 bg-white text-gray-800 font-bold text-[15px] rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                        Lihat Layanan <i class="ph ph-arrow-right text-gray-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics Bar (pinned to bottom of hero) --}}
    <div class="relative z-20 w-full mt-auto">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 pb-8">
            <div class="flex flex-wrap lg:flex-nowrap gap-4">
                <div class="w-full sm:w-[calc(50%-0.5rem)] lg:flex-1 bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center">
                            <i class="ph-duotone ph-buildings text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">47</p>
                            <p class="text-[11px] text-gray-500 font-semibold mt-1">Perangkat Daerah</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-[calc(50%-0.5rem)] lg:flex-1 bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                            <i class="ph-duotone ph-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">1.482</p>
                            <p class="text-[11px] text-gray-500 font-semibold mt-1">ASN</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-[calc(50%-0.5rem)] lg:flex-1 bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center">
                            <i class="ph-duotone ph-clipboard-text text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">228</p>
                            <p class="text-[11px] text-gray-500 font-semibold mt-1">SOP</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-[calc(50%-0.5rem)] lg:flex-1 bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                            <i class="ph-duotone ph-check-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">86</p>
                            <p class="text-[11px] text-gray-500 font-semibold mt-1">Standar Pelayanan</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-full lg:flex-1 rounded-2xl p-5 shadow-lg bg-brand-500">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white bg-opacity-20 text-white flex items-center justify-center">
                            <i class="ph-duotone ph-chart-line-up text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-white leading-none">81,25</p>
                            <p class="text-[11px] text-brand-100 font-semibold mt-1">Indeks RB 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ LAYANAN UNGGULAN (BENTO GRID) ═══ --}}
<section class="py-24 bg-gray-50 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-200/40 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 -left-20 w-72 h-72 bg-blue-200/30 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-600 text-xs font-bold tracking-wide mb-3">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span> Fokus Kami
                </div>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight">Layanan Unggulan & <br><span class="text-brand-500">Program Kerja</span></h2>
            </div>
            <a href="#" class="hidden sm:inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-900 font-bold text-sm rounded-xl hover:bg-gray-50 hover:shadow-md transition-all border border-gray-100 group">
                Jelajahi Semua <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>        {{-- Bento Grid Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- 1. Reformasi Birokrasi (Large Card) --}}
            <div class="group md:col-span-2 lg:col-span-2 md:row-span-2 bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-slate-800 rounded-[2.5rem] p-8 lg:p-10 text-white relative overflow-hidden shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4 group-hover:scale-125 group-hover:-translate-y-4 group-hover:-rotate-12 transition-all duration-700 pointer-events-none">
                    <i class="ph-duotone ph-chart-line-up text-[16rem]"></i>
                </div>
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-auto border border-white/10 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500 shadow-xl">
                        <i class="ph-bold ph-trend-up text-3xl text-white"></i>
                    </div>
                    <div class="mt-24">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs font-bold uppercase tracking-widest mb-4 border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span> Fokus Utama
                        </div>
                        <h3 class="text-3xl lg:text-4xl font-black mb-4 leading-tight">Reformasi Birokrasi</h3>
                        <p class="text-gray-300 font-medium leading-relaxed max-w-md mb-8 text-sm lg:text-base opacity-90 group-hover:opacity-100 transition-opacity">Mewujudkan pemerintahan yang bersih, akuntabel, dan kapabel melalui pengawasan tata kelola yang efektif dan efisien.</p>
                        <a href="#" class="inline-flex items-center gap-3 font-bold text-sm bg-brand-500 text-white px-8 py-4 rounded-2xl hover:bg-brand-600 hover:shadow-xl hover:scale-105 transition-all group/btn w-max shadow-brand-500/30">
                            Lihat Indeks RB <i class="ph-bold ph-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. SOP (Medium Card) --}}
            <div class="group bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-5 group-hover:scale-125 group-hover:-rotate-12 transition-all duration-500 pointer-events-none transform translate-x-4 -translate-y-4">
                    <i class="ph-fill ph-file-text text-8xl text-blue-500"></i>
                </div>
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 relative z-10 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                    <i class="ph-bold ph-files text-2xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3 relative z-10 group-hover:text-blue-600 transition-colors">Standar Operasional Prosedur</h3>
                <p class="text-sm text-gray-500 font-medium mb-6 flex-1 relative z-10 leading-relaxed">Pedoman baku pelaksanaan tugas dan fungsi aparatur secara sistematis.</p>
                <a href="#" class="inline-flex items-center text-sm font-bold text-blue-500 group-hover:text-blue-600 w-max mt-auto relative z-10">Selengkapnya <i class="ph-bold ph-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i></a>
            </div>

            {{-- 3. Anjab & ABK (Medium Card) --}}
            <div class="group bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-5 group-hover:scale-125 group-hover:-rotate-12 transition-all duration-500 pointer-events-none transform translate-x-4 -translate-y-4">
                    <i class="ph-fill ph-users-three text-8xl text-purple-500"></i>
                </div>
                <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-6 relative z-10 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                    <i class="ph-bold ph-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3 relative z-10 group-hover:text-purple-600 transition-colors">Anjab & ABK</h3>
                <p class="text-sm text-gray-500 font-medium mb-6 flex-1 relative z-10 leading-relaxed">Analisis Jabatan dan Beban Kerja untuk pemetaan formasi pegawai.</p>
                <a href="#" class="inline-flex items-center text-sm font-bold text-purple-500 group-hover:text-purple-600 w-max mt-auto relative z-10">Selengkapnya <i class="ph-bold ph-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i></a>
            </div>

            {{-- 4. Pengaduan (Wide Card) --}}
            <div class="group md:col-span-2 lg:col-span-2 bg-[#1e293b] rounded-[2.5rem] p-8 lg:p-10 text-white border border-gray-800 shadow-xl hover:-translate-y-2 transition-all duration-500 flex flex-col sm:flex-row sm:items-center justify-between gap-6 overflow-hidden relative">
                <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-white/5 to-transparent pointer-events-none group-hover:w-1/2 transition-all duration-700"></div>
                
                {{-- Decorative background icon --}}
                <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:opacity-20 group-hover:scale-110 group-hover:-translate-y-4 group-hover:-rotate-12 transition-all duration-700 pointer-events-none">
                    <i class="ph-fill ph-megaphone text-[12rem] text-white"></i>
                </div>

                <div class="relative z-10 flex-1">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500">
                            <i class="ph-bold ph-speaker-hifi text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-white">Layanan Pengaduan</h3>
                    </div>
                    <p class="text-gray-400 text-sm font-medium leading-relaxed max-w-sm">Sampaikan aspirasi dan laporan Anda untuk perbaikan layanan publik secara cepat dan responsif.</p>
                </div>
                <a href="#" class="relative z-10 shrink-0 inline-flex items-center justify-center gap-2 px-6 py-4 bg-white text-gray-900 font-bold rounded-2xl hover:scale-105 hover:bg-gray-100 transition-all shadow-xl group/btn">
                    Buat Laporan <i class="ph-bold ph-arrow-up-right text-lg group-hover/btn:rotate-45 transition-transform"></i>
                </a>
            </div>

            {{-- 5. Penataan Kelembagaan (Wide Card) --}}
            <div class="group md:col-span-2 lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col sm:flex-row sm:items-center gap-6 lg:gap-8">
                <div class="absolute right-0 top-0 bottom-0 p-6 opacity-0 group-hover:opacity-5 group-hover:scale-125 transition-all duration-700 pointer-events-none flex items-center transform translate-x-12">
                    <i class="ph-fill ph-tree-structure text-9xl text-emerald-500"></i>
                </div>
                <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0 relative z-10 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                    <i class="ph-bold ph-tree-structure text-3xl"></i>
                </div>
                <div class="relative z-10 flex-1">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">Penataan Kelembagaan</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Evaluasi dan penyesuaian nomenklatur Perangkat Daerah sesuai dengan kebutuhan dan regulasi.</p>
                </div>
                <div class="relative z-10 shrink-0 sm:ml-auto">
                    <a href="#" class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- 6. Standar Pelayanan (Wide Card) --}}
            <div class="group md:col-span-2 lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col sm:flex-row sm:items-center gap-6 lg:gap-8">
                <div class="absolute right-0 top-0 bottom-0 p-6 opacity-0 group-hover:opacity-5 group-hover:scale-125 group-hover:rotate-12 transition-all duration-700 pointer-events-none flex items-center transform translate-x-12">
                    <i class="ph-fill ph-star text-9xl text-rose-500"></i>
                </div>
                <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center shrink-0 relative z-10 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-500">
                    <i class="ph-bold ph-star text-3xl"></i>
                </div>
                <div class="relative z-10 flex-1">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-rose-600 transition-colors">Standar Pelayanan</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Tolak ukur kualitas pelayanan publik sebagai jaminan kepastian layanan prima kepada masyarakat.</p>
                </div>
                <div class="relative z-10 shrink-0 sm:ml-auto">
                    <a href="#" class="w-12 h-12 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-colors">
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ BERITA TERKINI ═══ --}}
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Kabar <span class="text-brand-500">Terkini</span></h2>
                <p class="text-gray-500 font-medium max-w-xl leading-relaxed">Informasi terbaru seputar kegiatan, regulasi, dan capaian Bagian Organisasi Sekretariat Daerah Kota Padang.</p>
            </div>
            <a href="#" class="hidden sm:inline-flex items-center gap-2 text-gray-900 font-bold hover:text-brand-500 transition-colors group pb-2 border-b-2 border-gray-200 hover:border-brand-500 shrink-0">
                Lihat Semua Berita <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @for($i=1; $i<=3; $i++)
            <article class="group cursor-pointer flex flex-col h-full">
                <div class="relative rounded-[2rem] overflow-hidden aspect-[4/3] mb-6 shadow-md border border-gray-100/50">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80" alt="Berita" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    {{-- Date Badge --}}
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md rounded-2xl p-2 text-center shadow-lg border border-white/50 min-w-[3.5rem]">
                        <span class="block text-xl font-black text-gray-900 leading-none">26</span>
                        <span class="block text-[10px] font-bold text-brand-500 mt-1 uppercase tracking-wider">JUN</span>
                    </div>
                </div>
                
                <div class="px-2 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[11px] font-bold text-brand-500 uppercase tracking-wider bg-brand-50 px-2.5 py-1 rounded-md">Pemerintahan</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-xs text-gray-400 font-medium flex items-center gap-1"><i class="ph-fill ph-clock"></i> 3 min read</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3 leading-snug group-hover:text-brand-500 transition-colors line-clamp-2">
                        {{ $i == 1 ? 'Rapat Koordinasi Sekretariat Daerah Bahas Penguatan Kinerja' : ($i == 2 ? 'Pemkot Padang Raih Penghargaan SAKIP Predikat A' : 'Inovasi Layanan Publik Berbasis Digital Resmi Diluncurkan') }}
                    </h3>
                    <p class="text-gray-500 text-sm font-medium line-clamp-2 leading-relaxed mt-auto">
                        Pemerintah Kota Padang terus mendorong transformasi pelayanan publik melalui digitalisasi proses bisnis dan penguatan SDM aparatur secara berkesinambungan.
                    </p>
                </div>
            </article>
            @endfor
        </div>
    </div>
</section>

{{-- ═══ PENGUMUMAN ═══ --}}
<section class="py-16 bg-brand-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10 flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
        <div class="shrink-0 text-center lg:text-left">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-md mb-4 text-white shadow-inner">
                <i class="ph-bold ph-megaphone text-3xl"></i>
            </div>
            <h2 class="text-3xl font-black text-white mb-1">Pengumuman</h2>
            <p class="text-brand-100 font-medium text-sm">Informasi Penting & Terbaru</p>
        </div>
        
        <div class="flex-1 w-full bg-white/10 backdrop-blur-xl rounded-[2rem] p-6 border border-white/20 shadow-2xl">
            <div class="space-y-4">
                {{-- Item 1 --}}
                <a href="#" class="group flex flex-col sm:flex-row sm:items-center gap-4 bg-white/5 hover:bg-white p-4 lg:p-5 rounded-2xl transition-all duration-300 border border-white/10 hover:border-white hover:shadow-xl">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-brand-50 rounded-xl flex items-center justify-center shrink-0 transition-colors hidden sm:flex">
                        <i class="ph-bold ph-push-pin text-white group-hover:text-brand-500 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-white/20 group-hover:bg-brand-100 text-white group-hover:text-brand-600 uppercase tracking-wider transition-colors">Terbaru</span>
                            <span class="text-xs text-brand-100 group-hover:text-gray-400 font-medium transition-colors">28 Juni 2026</span>
                        </div>
                        <h3 class="text-white group-hover:text-gray-900 font-bold text-sm lg:text-base leading-snug transition-colors line-clamp-2">Hasil Seleksi Administrasi Penerimaan Tenaga Non-ASN Bagian Organisasi Tahun 2026</h3>
                    </div>
                    <div class="shrink-0 hidden sm:flex w-10 h-10 rounded-full bg-white/10 group-hover:bg-brand-500 items-center justify-center transition-colors">
                        <i class="ph-bold ph-arrow-right text-white text-sm"></i>
                    </div>
                </a>

                {{-- Item 2 --}}
                <a href="#" class="group flex flex-col sm:flex-row sm:items-center gap-4 bg-white/5 hover:bg-white p-4 lg:p-5 rounded-2xl transition-all duration-300 border border-white/10 hover:border-white hover:shadow-xl">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-brand-50 rounded-xl flex items-center justify-center shrink-0 transition-colors hidden sm:flex">
                        <i class="ph-bold ph-file-pdf text-white group-hover:text-brand-500 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-xs text-brand-100 group-hover:text-gray-400 font-medium transition-colors">15 Juni 2026</span>
                        </div>
                        <h3 class="text-white group-hover:text-gray-900 font-bold text-sm lg:text-base leading-snug transition-colors line-clamp-2">Jadwal Pelaksanaan Survei Kepuasan Masyarakat (SKM) Periode Semester I Tahun 2026</h3>
                    </div>
                    <div class="shrink-0 hidden sm:flex w-10 h-10 rounded-full bg-white/10 group-hover:bg-brand-500 items-center justify-center transition-colors">
                        <i class="ph-bold ph-arrow-right text-white text-sm"></i>
                    </div>
                </a>
            </div>
            <div class="mt-6 text-center sm:text-right">
                <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-white hover:text-brand-100 transition-colors py-2 px-4 rounded-full bg-white/5 hover:bg-white/10 border border-white/10">
                    Lihat Semua Pengumuman <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ AGENDA & AKTIVITAS (TIMELINE) ═══ --}}
<section class="py-32 bg-[#0a0f1c] text-white relative overflow-hidden">
    {{-- Glow effects --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-5xl h-full pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-brand-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        <div class="text-center mb-24">
            <h2 class="text-4xl lg:text-6xl font-black mb-4 tracking-tight flex items-center justify-center gap-4">
                Agenda 
                <span class="text-brand-500 font-script font-normal text-6xl lg:text-7xl -mt-4">&</span> 
                Aktivitas
            </h2>
            <p class="text-gray-400 font-medium max-w-xl mx-auto text-lg leading-relaxed">Rekam jejak kegiatan dan agenda harian Bagian Organisasi Setda Kota Padang.</p>
        </div>

        <div class="relative max-w-5xl mx-auto">
            {{-- Vertical Line --}}
            <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-brand-500/0 via-brand-500/50 to-brand-500/0 md:-translate-x-1/2 hidden sm:block"></div>

            @php
                $activities = [
                    ['d'=>'01', 'm'=>'JUL', 't'=>'Kunjungan Kerja ke Kec. Bungus', 'l'=>'Kec. Bungus', 'img'=>'photo-1552664730-d307ca884978', 'pos'=>'left'],
                    ['d'=>'30', 'm'=>'JUN', 't'=>'Rapat Koordinasi Prioritas Daerah', 'l'=>'Ruang Rapat Sekda', 'img'=>'photo-1542744173-8e7e53415bb0', 'pos'=>'right'],
                    ['d'=>'29', 'm'=>'JUN', 't'=>'Penandatanganan Komitmen', 'l'=>'Aula Wako', 'img'=>'photo-1557804506-669a67965ba0', 'pos'=>'left'],
                ];
            @endphp

            <div class="space-y-16 sm:space-y-24">
                @foreach($activities as $index => $act)
                <div class="relative flex flex-col md:flex-row items-center gap-8 group">
                    {{-- Timeline Dot --}}
                    <div class="absolute left-6 md:left-1/2 w-5 h-5 bg-[#0a0f1c] border-4 border-brand-500 rounded-full md:-translate-x-1/2 shadow-[0_0_20px_rgba(245,158,11,0.6)] group-hover:scale-150 group-hover:bg-brand-500 transition-all duration-500 hidden sm:block z-20"></div>
                    
                    {{-- Content (Left or Right) --}}
                    <div class="w-full md:w-1/2 {{ $act['pos'] == 'left' ? 'md:pr-16 md:text-right' : 'md:pl-16 md:order-last' }}">
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-2 lg:p-3 rounded-[2.5rem] hover:bg-white/10 transition-colors duration-500 hover:shadow-2xl hover:shadow-brand-500/5">
                            <div class="relative rounded-[2rem] overflow-hidden aspect-[16/10]">
                                <img src="https://images.unsplash.com/{{ $act['img'] }}?w=800&q=80" alt="Aktivitas" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent pointer-events-none"></div>
                                
                                {{-- Date Floating inside image --}}
                                <div class="absolute bottom-5 {{ $act['pos'] == 'left' ? 'right-5' : 'left-5' }} bg-brand-500 text-white rounded-2xl px-5 py-3 text-center backdrop-blur-md shadow-2xl flex items-center gap-3">
                                    <span class="text-3xl font-black">{{ $act['d'] }}</span>
                                    <span class="text-sm font-bold uppercase tracking-widest text-brand-100">{{ $act['m'] }}</span>
                                </div>
                            </div>
                            <div class="p-6 lg:p-8">
                                <h3 class="text-2xl font-bold text-white mb-3 leading-snug group-hover:text-brand-400 transition-colors">{{ $act['t'] }}</h3>
                                <p class="text-sm text-gray-400 font-medium flex items-center gap-2 {{ $act['pos'] == 'left' ? 'md:justify-end' : '' }}">
                                    <i class="ph-fill ph-map-pin text-brand-500"></i> {{ $act['l'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-24 relative z-10">
                <a href="#" class="inline-flex items-center gap-3 px-10 py-5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 text-white font-bold transition-all hover:scale-105 hover:shadow-[0_0_40px_rgba(255,255,255,0.1)]">
                    Jelajahi Seluruh Agenda <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ MAPS & KOTAK SARAN ═══ --}}
<section class="py-20 bg-white relative overflow-hidden" id="kontak">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-black text-gray-900 mb-4 tracking-tight">Lokasi & <span class="text-brand-500">Kotak Saran</span></h2>
            <p class="text-gray-500 font-medium max-w-xl mx-auto text-sm lg:text-base">Kunjungi kantor kami atau sampaikan saran dan masukan Anda untuk pelayanan yang lebih baik.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">
            {{-- Maps --}}
            <div class="bg-gray-100 rounded-[2.5rem] overflow-hidden border border-gray-200 shadow-inner h-[400px] lg:h-auto relative group">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2683976643275!2d100.35692807531795!3d-0.9512986353524716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b948c7c72e11%3A0x6771787fa612c99f!2sSekretariat%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1785310213215!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="absolute inset-0 w-full h-full grayscale group-hover:grayscale-0 transition-all duration-700"></iframe>
                <div class="absolute bottom-5 left-5 right-5 bg-white/95 backdrop-blur-md p-5 rounded-3xl shadow-xl border border-white/50 flex items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brand-50 text-brand-500 rounded-2xl flex items-center justify-center shrink-0">
                            <i class="ph-fill ph-map-pin text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-gray-900 text-sm lg:text-base mb-0.5">Komplek Perkantoran Balaikota</h4>
                            <p class="text-xs text-gray-500 font-medium">Aie Pacah, Kec. Koto Tangah, Padang</p>
                        </div>
                    </div>
                    <a href="https://maps.app.goo.gl/..." target="_blank" class="shrink-0 w-10 h-10 bg-brand-500 hover:bg-brand-600 text-white rounded-full flex items-center justify-center transition-colors shadow-lg shadow-brand-500/30">
                        <i class="ph-bold ph-navigation-arrow text-lg"></i>
                    </a>
                </div>
            </div>

            {{-- Kotak Saran --}}
            <div class="bg-white rounded-[2.5rem] p-8 lg:p-12 border border-gray-100 shadow-[0_0_50px_rgba(0,0,0,0.03)] relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-5 pointer-events-none transform translate-x-1/4 -translate-y-1/4">
                    <i class="ph-fill ph-envelope-simple text-[12rem]"></i>
                </div>
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 mb-8 border border-orange-100">
                        <i class="ph-bold ph-chat-teardrop-text text-3xl"></i>
                    </div>
                    <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Punya Saran atau Masukan?</h3>
                    <p class="text-gray-500 text-sm mb-10 font-medium leading-relaxed max-w-sm">Tinggalkan pesan Anda di bawah ini, setiap masukan sangat berarti bagi kami untuk terus berkembang.</p>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                                <input type="text" class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-gray-900" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email / No. HP</label>
                                <input type="text" class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-gray-900" placeholder="0812...">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Pesan & Saran</label>
                            <textarea rows="4" class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all resize-none font-medium text-gray-900" placeholder="Tuliskan saran Anda di sini..."></textarea>
                        </div>
                        <button type="button" class="w-full bg-gray-900 hover:bg-brand-500 text-white font-bold py-4 rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-xl shadow-gray-900/10 hover:shadow-brand-500/30 group">
                            Kirim Pesan <i class="ph-bold ph-paper-plane-tilt group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ STATISTIK PENGUNJUNG ═══ --}}
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-10">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Statistik Pengunjung Portal</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white rounded-3xl p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mx-auto bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-5">
                    <i class="ph-bold ph-users text-2xl"></i>
                </div>
                <h4 class="text-3xl lg:text-4xl font-black text-gray-900 mb-1">1,248</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Hari Ini</p>
            </div>
            <div class="bg-white rounded-3xl p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mx-auto bg-brand-50 text-brand-500 rounded-2xl flex items-center justify-center mb-5">
                    <i class="ph-bold ph-calendar text-2xl"></i>
                </div>
                <h4 class="text-3xl lg:text-4xl font-black text-gray-900 mb-1">34.5K</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bulan Ini</p>
            </div>
            <div class="bg-white rounded-3xl p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mx-auto bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-5">
                    <i class="ph-bold ph-chart-bar text-2xl"></i>
                </div>
                <h4 class="text-3xl lg:text-4xl font-black text-gray-900 mb-1">450K</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tahun Ini</p>
            </div>
            <div class="bg-white rounded-3xl p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mx-auto bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-5">
                    <i class="ph-bold ph-globe text-2xl"></i>
                </div>
                <h4 class="text-3xl lg:text-4xl font-black text-gray-900 mb-1">523K</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Visitor</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ MEGA FOOTER ═══ --}}
<footer class="bg-[#0f172a] text-white pt-20 pb-10 relative overflow-hidden">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-1/2 h-full opacity-5 pointer-events-none z-0">
        <img src="{{ asset('assets/img/logo.png') }}" class="w-full h-full object-contain object-right-top mix-blend-luminosity" alt="">
    </div>

    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        
        {{-- Footer Main Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shrink-0">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-full h-auto">
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-brand-400 tracking-widest uppercase">Pemerintah Kota Padang</span>
                        <span class="block text-base font-extrabold text-white leading-tight">BAGIAN ORGANISASI</span>
                    </div>
                </div>
                <p class="text-sm text-gray-400 font-medium leading-relaxed mb-6">
                    Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i class="ph-fill ph-instagram-logo text-lg"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i class="ph-fill ph-facebook-logo text-lg"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i class="ph-fill ph-youtube-logo text-lg"></i></a>
                </div>
            </div>

            {{-- Links Column --}}
            <div>
                <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i class="ph-fill ph-link text-brand-500"></i> Tautan Cepat</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i class="ph-bold ph-caret-right text-[10px]"></i> Profil Organisasi</a></li>
                    <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i class="ph-bold ph-caret-right text-[10px]"></i> Layanan Kelembagaan</a></li>
                    <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i class="ph-bold ph-caret-right text-[10px]"></i> Regulasi & Aturan</a></li>
                    <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i class="ph-bold ph-caret-right text-[10px]"></i> PPID</a></li>
                </ul>
            </div>

            {{-- Contact Column --}}
            <div class="lg:col-span-2">
                <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i class="ph-fill ph-map-pin text-brand-500"></i> Hubungi Kami</h4>
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:p-8 backdrop-blur-sm">
                    <div class="grid sm:grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-map-pin text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Alamat Kantor</p>
                                    <p class="text-xs text-gray-400 leading-relaxed">Jl. Jenderal Sudirman No. 1, Padang, Sumatera Barat 25129</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-clock text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Jam Layanan</p>
                                    <p class="text-xs text-gray-400">Senin - Jumat<br>08:00 - 16:00 WIB</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-phone text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Telepon</p>
                                    <p class="text-xs text-gray-400">(0751) 123456</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-envelope-simple text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Email Resmi</p>
                                    <p class="text-xs text-gray-400">bag.organisasi<br>@padang.go.id</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-500 font-medium">
                &copy; {{ date('Y') }} Bagian Organisasi Sekretariat Daerah Kota Padang. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-xs text-gray-500 font-medium hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="text-xs text-gray-500 font-medium hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
