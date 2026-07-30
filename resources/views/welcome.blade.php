
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
@include('components.navbar')

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
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-600 text-xs font-black tracking-widest uppercase mb-6 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    Selamat Datang di
                </div>
                
                <h1 class="text-5xl sm:text-6xl lg:text-[5rem] font-black text-gray-900 leading-[1] mb-4 tracking-tighter">
                    Bagian Organisasi
                </h1>
                
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-medium text-gray-400 tracking-wide mb-8 flex items-center gap-4">
                    <div class="h-px bg-gray-300 w-10 hidden sm:block"></div>
                    Setda Kota Padang
                </h2>
                
                {{-- Tagline --}}
                <p class="text-gray-500 text-lg lg:text-xl font-medium leading-relaxed max-w-xl mb-10 border-l-4 border-brand-500 pl-6 py-1">
                    Mewujudkan tata kelola organisasi yang efektif, efisien, transparan, dan berorientasi pada pelayanan publik untuk <strong class="text-gray-900 font-black">Kota Padang yang lebih baik</strong>.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="#profil" class="h-[48px] px-8 inline-flex items-center justify-center gap-2 bg-brand-500 text-white font-bold text-[15px] rounded-xl hover:bg-brand-600 transition-colors shadow-lg shadow-brand-500/25">
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
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-500 flex items-center justify-center">
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

        {{-- Category Filters (Visual only for now) --}}
        <div class="flex flex-wrap gap-2 mb-10">
            <button class="px-5 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-full hover:bg-brand-500 hover:text-white transition-colors shadow-md">Semua Berita</button>
            <button class="px-5 py-2.5 bg-gray-50 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-100 hover:text-gray-900 transition-colors border border-gray-200">Pemerintahan</button>
            <button class="px-5 py-2.5 bg-gray-50 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-100 hover:text-gray-900 transition-colors border border-gray-200">Inovasi</button>
            <button class="px-5 py-2.5 bg-gray-50 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-100 hover:text-gray-900 transition-colors border border-gray-200">Regulasi</button>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-stretch">
            
            {{-- Featured Post (Left) --}}
            <article class="lg:col-span-7 group cursor-pointer relative rounded-[2.5rem] overflow-hidden shadow-lg border border-gray-100 flex flex-col h-full min-h-[400px]">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=80" alt="Featured News" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                {{-- Date Badge --}}
                <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-md rounded-2xl p-3 text-center shadow-2xl border border-white/50 min-w-[4rem]">
                    <span class="block text-2xl font-black text-gray-900 leading-none">26</span>
                    <span class="block text-xs font-bold text-brand-500 mt-1 uppercase tracking-wider">JUN</span>
                </div>

                <div class="relative z-10 flex flex-col justify-end h-full p-8 lg:p-10 mt-auto">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 px-3 py-1.5 rounded-lg shadow-sm">Pemerintahan</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-sm text-gray-300 font-medium flex items-center gap-1.5"><i class="ph-bold ph-clock"></i> 5 min read</span>
                    </div>
                    <h3 class="text-3xl lg:text-4xl font-extrabold text-white mb-4 leading-tight group-hover:text-brand-300 transition-colors">
                        Rapat Koordinasi Sekretariat Daerah Bahas Penguatan Kinerja dan Evaluasi
                    </h3>
                    <p class="text-gray-300 text-sm lg:text-base font-medium line-clamp-2 leading-relaxed mb-6 max-w-2xl">
                        Pemerintah Kota Padang terus mendorong transformasi pelayanan publik melalui digitalisasi proses bisnis dan penguatan SDM aparatur secara berkesinambungan demi mewujudkan kota pintar.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 font-bold text-white text-sm hover:text-brand-400 transition-colors w-max group/link">
                        Baca Selengkapnya <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>

            {{-- Side Posts List (Right) --}}
            <div class="lg:col-span-5 flex flex-col gap-5">
                
                {{-- Side Item 1 --}}
                <article class="group cursor-pointer flex flex-col sm:flex-row gap-5 bg-white p-4 rounded-3xl border border-gray-100 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="w-full sm:w-32 lg:w-36 aspect-[4/3] rounded-2xl overflow-hidden shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=600&q=80" alt="News" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="flex flex-col flex-1 py-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-2 py-1 rounded-md">Prestasi</span>
                            <span class="text-xs text-gray-400 font-medium ml-auto">24 Jun</span>
                        </div>
                        <h4 class="text-lg font-extrabold text-gray-900 leading-snug group-hover:text-brand-500 transition-colors line-clamp-2 mb-2">
                            Pemkot Padang Raih Penghargaan SAKIP Predikat A Tingkat Nasional
                        </h4>
                        <a href="#" class="mt-auto text-xs font-bold text-gray-500 group-hover:text-brand-500 inline-flex items-center gap-1 w-max">
                            Baca <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>

                {{-- Side Item 2 --}}
                <article class="group cursor-pointer flex flex-col sm:flex-row gap-5 bg-white p-4 rounded-3xl border border-gray-100 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="w-full sm:w-32 lg:w-36 aspect-[4/3] rounded-2xl overflow-hidden shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&q=80" alt="News" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="flex flex-col flex-1 py-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-purple-600 uppercase tracking-wider bg-purple-50 px-2 py-1 rounded-md">Inovasi</span>
                            <span class="text-xs text-gray-400 font-medium ml-auto">22 Jun</span>
                        </div>
                        <h4 class="text-lg font-extrabold text-gray-900 leading-snug group-hover:text-brand-500 transition-colors line-clamp-2 mb-2">
                            Inovasi Layanan Publik Berbasis Digital Resmi Diluncurkan
                        </h4>
                        <a href="#" class="mt-auto text-xs font-bold text-gray-500 group-hover:text-brand-500 inline-flex items-center gap-1 w-max">
                            Baca <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>

                {{-- Side Item 3 --}}
                <article class="group cursor-pointer flex flex-col sm:flex-row gap-5 bg-white p-4 rounded-3xl border border-gray-100 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-500/5 transition-all duration-300">
                    <div class="w-full sm:w-32 lg:w-36 aspect-[4/3] rounded-2xl overflow-hidden shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=80" alt="News" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="flex flex-col flex-1 py-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-1 rounded-md">Regulasi</span>
                            <span class="text-xs text-gray-400 font-medium ml-auto">20 Jun</span>
                        </div>
                        <h4 class="text-lg font-extrabold text-gray-900 leading-snug group-hover:text-brand-500 transition-colors line-clamp-2 mb-2">
                            Sosialisasi Pemetaan Nomenklatur Perangkat Daerah 2026
                        </h4>
                        <a href="#" class="mt-auto text-xs font-bold text-gray-500 group-hover:text-brand-500 inline-flex items-center gap-1 w-max">
                            Baca <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </div>
</section>

{{-- ═══ PENGUMUMAN ═══ --}}
<section class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="bg-gray-50 rounded-[2.5rem] p-8 lg:p-12 border border-gray-100 flex flex-col lg:flex-row gap-12 items-center">
            
            {{-- Left side: Header --}}
            <div class="shrink-0 lg:w-1/3 text-center lg:text-left">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-brand-50 text-brand-500 mb-6 shadow-sm border border-brand-100">
                    <i class="ph-fill ph-megaphone text-4xl group-hover:scale-110 transition-transform"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-black text-gray-900 mb-4 tracking-tight">Papan <br class="hidden lg:block"><span class="text-brand-500">Pengumuman</span></h2>
                <p class="text-gray-500 font-medium leading-relaxed mb-8 max-w-sm mx-auto lg:mx-0">
                    Pantau terus informasi terbaru, jadwal kegiatan, dan pengumuman penting lainnya dari Bagian Organisasi.
                </p>
                <a href="#" class="inline-flex items-center gap-2 font-bold text-brand-500 hover:text-brand-600 transition-colors bg-white px-7 py-3.5 rounded-full shadow-sm hover:shadow-md border border-gray-200 hover:border-brand-200">
                    Lihat Semua <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            {{-- Right side: List --}}
            <div class="flex-1 w-full flex flex-col gap-4">
                {{-- Item 1 --}}
                <a href="#" class="group bg-white p-5 lg:p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 hover:border-brand-200 transition-all duration-300 flex items-center gap-4 lg:gap-6">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-file-pdf text-2xl lg:text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold bg-brand-50 text-brand-600 uppercase tracking-wider">Terbaru</span>
                            <span class="text-[11px] lg:text-xs text-gray-400 font-bold uppercase tracking-wider">28 Jun 2026</span>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-sm lg:text-base group-hover:text-brand-500 transition-colors line-clamp-2 leading-snug">Hasil Seleksi Administrasi Penerimaan Tenaga Non-ASN Bagian Organisasi Tahun 2026</h3>
                    </div>
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                        <i class="ph-bold ph-download-simple text-sm lg:text-base"></i>
                    </div>
                </a>

                {{-- Item 2 --}}
                <a href="#" class="group bg-white p-5 lg:p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 hover:border-brand-200 transition-all duration-300 flex items-center gap-4 lg:gap-6">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-info text-2xl lg:text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="text-[11px] lg:text-xs text-gray-400 font-bold uppercase tracking-wider">15 Jun 2026</span>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-sm lg:text-base group-hover:text-brand-500 transition-colors line-clamp-2 leading-snug">Jadwal Pelaksanaan Survei Kepuasan Masyarakat (SKM) Periode Semester I Tahun 2026</h3>
                    </div>
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                        <i class="ph-bold ph-arrow-right text-sm lg:text-base"></i>
                    </div>
                </a>
                
                {{-- Item 3 --}}
                <a href="#" class="group bg-white p-5 lg:p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 hover:border-brand-200 transition-all duration-300 flex items-center gap-4 lg:gap-6">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-calendar-check text-2xl lg:text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="text-[11px] lg:text-xs text-gray-400 font-bold uppercase tracking-wider">10 Jun 2026</span>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-sm lg:text-base group-hover:text-brand-500 transition-colors line-clamp-2 leading-snug">Pemberitahuan Penyesuaian Jam Layanan Publik Selama Bulan Suci Ramadhan</h3>
                    </div>
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                        <i class="ph-bold ph-arrow-right text-sm lg:text-base"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ AGENDA & AKTIVITAS (TIMELINE) ═══ --}}
<section class="py-20 bg-[#0a0f1c] text-white relative overflow-hidden">
    {{-- Glow effects --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-5xl h-full pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-brand-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-black mb-3 tracking-tight flex items-center justify-center gap-3">
                Agenda 
                <span class="text-brand-500 font-script font-normal text-5xl lg:text-6xl -mt-2">&</span> 
                Aktivitas
            </h2>
            <p class="text-gray-400 font-medium max-w-xl mx-auto text-sm lg:text-base leading-relaxed">Rekam jejak kegiatan dan agenda harian Bagian Organisasi Setda Kota Padang.</p>
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

            <div class="space-y-10 sm:space-y-12">
                @foreach($activities as $index => $act)
                <div class="relative flex items-center justify-between md:justify-normal w-full group {{ $act['pos'] == 'left' ? 'md:flex-row-reverse' : '' }}">
                    
                    {{-- Timeline Dot --}}
                    <div class="absolute left-6 md:left-1/2 w-5 h-5 bg-[#0a0f1c] border-[3px] border-brand-500 rounded-full md:-translate-x-1/2 shadow-[0_0_15px_rgba(245,158,11,0.5)] group-hover:scale-125 group-hover:bg-brand-500 transition-all duration-500 z-20 hidden sm:block"></div>
                
                    {{-- The Date (Opposite side of the card on Desktop) --}}
                    <div class="hidden md:block w-5/12 {{ $act['pos'] == 'left' ? 'text-left pl-12' : 'text-right pr-12' }}">
                        <div class="inline-flex flex-col opacity-60 group-hover:opacity-100 transition-opacity">
                            <span class="text-4xl font-black text-white leading-none mb-0.5">{{ $act['d'] }}</span>
                            <span class="text-xs font-bold text-brand-500 uppercase tracking-[0.2em]">{{ $act['m'] }} 2026</span>
                        </div>
                    </div>
                
                    {{-- The Content Card --}}
                    <div class="w-full sm:w-[calc(100%-4rem)] sm:ml-16 md:ml-0 md:w-5/12 {{ $act['pos'] == 'left' ? 'md:pr-12' : 'md:pl-12' }}">
                        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-5 lg:p-6 rounded-[2rem] hover:bg-white/10 transition-all duration-500 hover:shadow-xl hover:shadow-brand-500/10 hover:-translate-y-1 relative group/card">
                            
                            {{-- Mobile Date (Hidden on Desktop) --}}
                            <div class="md:hidden flex items-center gap-2 mb-4">
                                <span class="text-brand-500 font-bold bg-brand-500/10 px-2.5 py-1 rounded-md text-[11px]">{{ $act['d'] }} {{ $act['m'] }} 2026</span>
                            </div>
                
                            <h3 class="text-lg lg:text-xl font-bold text-white mb-2.5 leading-snug group-hover/card:text-brand-400 transition-colors">{{ $act['t'] }}</h3>
                            
                            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400 font-medium mb-4">
                                <span class="flex items-center gap-1.5"><i class="ph-fill ph-map-pin text-brand-500"></i> {{ $act['l'] }}</span>
                                <span class="flex items-center gap-1.5"><i class="ph-fill ph-clock text-blue-500"></i> 09:00 WIB</span>
                            </div>
                
                            {{-- Image Thumbnail --}}
                            <div class="rounded-xl overflow-hidden aspect-[21/9] relative">
                                <img src="https://images.unsplash.com/{{ $act['img'] }}?w=600&q=80" alt="Aktivitas" class="w-full h-full object-cover opacity-70 group-hover/card:opacity-100 group-hover/card:scale-105 transition-all duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f1c]/80 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16 relative z-10">
                <a href="#" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 text-sm text-white font-bold transition-all hover:scale-105 hover:shadow-[0_0_40px_rgba(255,255,255,0.1)]">
                    Jelajahi Seluruh Agenda <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ MAPS & KOTAK SARAN ═══ --}}
<section id="kontak" class="relative w-full min-h-[800px] flex items-center bg-gray-900 overflow-hidden">
    {{-- Smooth Gradient Transition from Agenda Section --}}
    <div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-[#0a0f1c] to-transparent z-20 pointer-events-none"></div>
    
    {{-- Massive Edge-to-Edge Map Background --}}
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2683976643275!2d100.35692807531795!3d-0.9512986353524716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b948c7c72e11%3A0x6771787fa612c99f!2sSekretariat%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1785310213215!5m2!1sid!2sid" class="absolute inset-0 w-full h-full object-cover grayscale opacity-40 mix-blend-luminosity pointer-events-none" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    
    {{-- Overlay Gradients for Depth --}}
    <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    <div class="absolute inset-0 bg-brand-500/10 mix-blend-color-burn"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-5 lg:px-8 py-20 flex flex-col lg:flex-row items-center justify-between gap-12">
        
        {{-- Frontal Left Typography (Gen Z Style) --}}
        <div class="flex-1 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/30 text-xs font-black tracking-widest uppercase mb-8 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-ping"></span> We Are Here
            </div>
            <h2 class="text-6xl lg:text-[7rem] font-black text-white leading-[0.9] tracking-tighter mb-6">
                HIT&nbsp;&nbsp;US!
            </h2>
            <p class="text-xl text-gray-400 font-medium max-w-md mx-auto lg:mx-0 leading-relaxed mb-8">
                Punya ide gila, saran pedas, atau sekedar mau nyapa? Kirim pesan frontal-mu sekarang.
            </p>
            
            {{-- Small Rounded Map Embed --}}
            <div class="w-full max-w-md mx-auto lg:mx-0 h-[220px] bg-gray-800 rounded-[2rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.4)] border border-white/10 group relative mt-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2683976643275!2d100.35692807531795!3d-0.9512986353524716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b948c7c72e11%3A0x6771787fa612c99f!2sSekretariat%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1785310213215!5m2!1sid!2sid" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <div class="absolute inset-0 ring-1 ring-inset ring-white/10 rounded-[2rem] pointer-events-none"></div>
                <a href="https://www.google.com/maps/search/Sekretariat+Daerah+Kota+Padang" target="_blank" class="absolute bottom-4 left-4 right-4 bg-gray-900/90 backdrop-blur-md border border-white/10 text-white px-5 py-3 rounded-xl text-xs font-bold hover:bg-brand-500 transition-colors flex items-center justify-between group/btn">
                    <span>Lihat di Google Maps</span>
                    <i class="ph-bold ph-arrow-up-right group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform"></i>
                </a>
            </div>
        </div>

        {{-- Floating Glass Form --}}
        <div class="w-full lg:w-[500px] shrink-0">
            <div class="bg-white/10 backdrop-blur-2xl p-8 lg:p-10 rounded-[2.5rem] shadow-2xl border border-white/20 relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-brand-500 rounded-full blur-3xl opacity-50"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-white mb-2 tracking-tight">Kirim Masukan</h3>
                    <p class="text-gray-300 text-sm mb-8 font-medium">Bantu kami jadi lebih baik dari hari kemarin.</p>

                    <form class="space-y-4">
                        <div>
                            <input type="text" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm focus:bg-white/10 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all font-bold text-white placeholder-gray-400" placeholder="Siapa namamu?">
                        </div>
                        <div>
                            <input type="text" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm focus:bg-white/10 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all font-bold text-white placeholder-gray-400" placeholder="Nomor WA / Email">
                        </div>
                        <div>
                            <textarea rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm focus:bg-white/10 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none transition-all resize-none font-bold text-white placeholder-gray-400" placeholder="Ketik apa aja saran/masukanmu disini..."></textarea>
                        </div>
                        <button type="button" class="w-full bg-brand-500 hover:bg-brand-400 text-white font-black py-4 rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-xl shadow-brand-500/30 hover:scale-[1.02]">
                            KIRIM SEKARANG <i class="ph-bold ph-paper-plane-tilt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ═══ STATISTIK PENGUNJUNG ═══ --}}
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-gray-900 mb-2">Statistik Kunjungan Portal</h2>
            <p class="text-gray-500 font-medium text-sm lg:text-base">Transparansi data lalu lintas pengunjung website secara real-time.</p>
        </div>
        
        <div class="grid lg:grid-cols-12 gap-8 items-stretch">
            {{-- Left Side: Stats Cards --}}
            <div class="lg:col-span-5 grid grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-white rounded-[2rem] p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 mx-auto bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="ph-bold ph-users text-xl"></i>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-1">1,248</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Hari Ini</p>
                </div>
                <div class="bg-white rounded-[2rem] p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 mx-auto bg-brand-50 text-brand-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="ph-bold ph-calendar text-xl"></i>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-1">34.5K</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bulan Ini</p>
                </div>
                <div class="bg-white rounded-[2rem] p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 mx-auto bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="ph-bold ph-chart-bar text-xl"></i>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-1">450K</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tahun Ini</p>
                </div>
                <div class="bg-white rounded-[2rem] p-6 text-center shadow-[0_0_30px_rgba(0,0,0,0.02)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 mx-auto bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="ph-bold ph-globe text-xl"></i>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-1">523K</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Visitor</p>
                </div>
            </div>

            {{-- Right Side: Line Chart --}}
            <div class="lg:col-span-7 bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-[0_0_40px_rgba(0,0,0,0.03)] border border-gray-100 h-full flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h4 class="text-lg lg:text-xl font-bold text-gray-900">Grafik Kunjungan Harian</h4>
                        <p class="text-sm text-gray-500 font-medium">Tren Kunjungan Bulan Ini (Juli 2026)</p>
                    </div>
                    <div class="px-4 py-1.5 bg-brand-50 text-brand-600 rounded-lg text-xs font-bold uppercase tracking-wider hidden sm:block">Bulan Ini</div>
                </div>
                <div class="flex-1 relative min-h-[250px] w-full">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ MEGA FOOTER ═══ --}}
@include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('visitorChart').getContext('2d');
            
            // Create gradient
            let gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(71, 85, 105, 0.4)'); // brand-500 (Slate) with opacity
            gradient.addColorStop(1, 'rgba(71, 85, 105, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['1', '3', '6', '9', '12', '15', '18', '21', '24', '27', '30'],
                    datasets: [{
                        label: 'Total Visitor',
                        data: [1200, 1500, 1100, 1800, 1750, 2200, 2100, 2600, 2400, 3100, 3400],
                        borderColor: '#475569', // brand-500 (Slate)
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#475569',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            titleFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Plus Jakarta Sans', sans-serif" },
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toLocaleString('id-ID') + ' Visitors';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 }, color: '#9ca3af' }
                        },
                        y: {
                            grid: { borderDash: [4, 4], color: '#f3f4f6', drawBorder: false },
                            ticks: { 
                                font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 }, 
                                color: '#9ca3af',
                                callback: function(value) { return value / 1000 + 'k'; }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
</body>
</html>
