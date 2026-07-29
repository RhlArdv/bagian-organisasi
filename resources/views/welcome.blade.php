<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal resmi Bagian Organisasi Sekretariat Daerah Kota Padang.">
    <title>Bagian Organisasi — Setda Kota Padang</title>

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
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Lambang_Kota_Padang.png/432px-Lambang_Kota_Padang.png" alt="Logo Padang" class="h-10 w-auto">
            <div class="leading-tight">
                <span class="block text-[11px] font-bold text-gray-900 tracking-widest uppercase">Sekretariat Daerah</span>
                <span class="block text-sm font-extrabold text-gray-900">Kota Padang</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden lg:flex items-center gap-6">
            <a href="#beranda" class="text-sm font-bold text-brand-500 border-b-2 border-brand-500 pb-1">Beranda</a>
            <a href="#profil" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Profil</a>
            <a href="#pelayanan" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Pelayanan</a>
            <a href="#kelembagaan" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Kelembagaan</a>
            <a href="#regulasi" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Regulasi</a>
            <a href="#download" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Download</a>
            <a href="#ppid" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">PPID</a>
            <a href="#kontak" class="text-sm font-semibold text-gray-500 hover:text-brand-500 transition-colors">Kontak</a>
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
<section id="beranda" class="relative overflow-hidden bg-white pt-32 lg:pt-[12rem] pb-16 lg:pb-24">
    
    {{-- Dot Pattern Background --}}
    <div class="absolute inset-0 z-0 opacity-50" style="background-image: radial-gradient(#fcd34d 1.5px, transparent 1.5px); background-size: 36px 36px;"></div>

    {{-- Absolute Huge Image (Anchored to the absolute right of the screen) --}}
    <div class="hidden lg:block absolute top-1/2 -translate-y-[45%] right-0 w-[1100px] xl:w-[1300px] pointer-events-none z-0">
        <img src="{{ asset('assets/img/hero.png') }}" 
             alt="Sekretariat Daerah Kota Padang" 
             class="w-full h-auto object-contain object-right mix-blend-multiply" 
             style="-webkit-mask-image: linear-gradient(to right, transparent 0%, black 15%); mask-image: linear-gradient(to right, transparent 0%, black 15%);"
             onerror="this.src='https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=900&q=80'">
    </div>

    <div class="w-full max-w-[90rem] mx-auto px-5 lg:px-12 relative z-10">
        <div class="w-full lg:w-[55%] relative z-20">
            <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-[#f5a500] text-white text-[12px] font-bold tracking-wide mb-6">
                Selamat Datang di
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-[4rem] font-extrabold text-[#111827] leading-[1.1] mb-5 tracking-tight">
                Sekretariat Daerah <br> Kota Padang
            </h1>
            
            <p class="text-gray-500 text-[15px] lg:text-[16px] mb-8 max-w-[85%] leading-relaxed font-medium">
                Mendukung terwujudnya tata kelola pemerintahan yang profesional, transparan dan berorientasi pada pelayanan publik yang prima.
            </p>
            
            <div class="flex flex-wrap gap-4">
                <a href="#" class="h-[48px] px-8 inline-flex items-center justify-center gap-2 bg-[#f5a500] text-white font-bold text-[15px] rounded-xl hover:bg-yellow-600 transition-colors">
                    Profil Sekda <i class="ph ph-arrow-right"></i>
                </a>
                <a href="#pelayanan" class="h-[48px] px-8 inline-flex items-center justify-center gap-2 bg-white text-gray-800 font-bold text-[15px] rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    Lihat Layanan <i class="ph ph-arrow-right text-gray-400"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ BERITA TERKINI ═══ --}}
<section class="py-20 bg-[#fafafa]">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Berita Terkini</h2>
            <a href="#" class="hidden sm:flex items-center gap-2 text-brand-500 font-bold hover:text-brand-600 transition-colors">
                Lihat Semua Berita <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @for($i=1; $i<=3; $i++)
            <div class="group bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=80" alt="Berita" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-brand-500 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-sm">
                        {{ $i == 1 ? 'Pemerintahan' : ($i == 2 ? 'Kegiatan' : 'Layanan Publik') }}
                    </div>
                </div>
                <div class="flex-1 flex flex-col px-2">
                    <p class="text-xs text-gray-400 font-medium mb-2">26 Juni 2026</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 leading-snug group-hover:text-brand-500 transition-colors">
                        {{ $i == 1 ? 'Rapat Koordinasi Sekretariat Daerah Bahas Penguatan Kinerja' : ($i == 2 ? 'Sekda Kota Padang Hadiri Forum Komunikasi Pimpinan Daerah' : 'Sekretariat Daerah Dorong Inovasi Pelayanan Publik Berbasis Digital') }}
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2 mt-auto">
                        Sekretariat Daerah Kota Padang menggelar rapat koordinasi bersama seluruh perangkat daerah untuk mengevaluasi dan merencanakan program kerja ke depan secara komprehensif.
                    </p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

{{-- ═══ AKTIVITAS SEKDA ═══ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Aktivitas Sekda</h2>
            <a href="#" class="hidden sm:flex items-center gap-2 text-brand-500 font-bold hover:text-brand-600 transition-colors">
                Lihat Semua Aktivitas <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $activities = [
                    ['d'=>'01', 'm'=>'JUL', 't'=>'Kunjungan Kerja ke Kecamatan Bungus Teluk Kabung', 'l'=>'Kecamatan Bungus'],
                    ['d'=>'30', 'm'=>'JUN', 't'=>'Rapat Koordinasi Program Prioritas Daerah', 'l'=>'Ruang Rapat Sekda'],
                    ['d'=>'29', 'm'=>'JUN', 't'=>'Penandatanganan Komitmen Kinerja Perangkat Daerah', 'l'=>'Aula Kantor Wali Kota'],
                    ['d'=>'28', 'm'=>'JUN', 't'=>'Gotong Royong ASN Sekretariat Daerah', 'l'=>'Pantai Padang'],
                ];
            @endphp
            @foreach($activities as $act)
            <div class="group bg-[#f8f9fa] rounded-3xl p-3 hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-4">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80" alt="Aktivitas" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-brand-500 text-white rounded-xl p-2 text-center shadow-md min-w-[3rem]">
                        <span class="block text-lg font-black leading-none">{{ $act['d'] }}</span>
                        <span class="block text-[10px] font-bold mt-1">{{ $act['m'] }}</span>
                    </div>
                </div>
                <div class="px-2 pb-2">
                    <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug group-hover:text-brand-500 transition-colors">
                        {{ $act['t'] }}
                    </h3>
                    <p class="text-xs text-gray-500 font-medium flex items-center gap-1">
                        <i class="ph-fill ph-map-pin text-brand-500"></i> {{ $act['l'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ LAYANAN UNGGULAN ═══ --}}
<section class="py-24 bg-[#fafafa]">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900">Layanan Unggulan</h2>
            <a href="#" class="hidden sm:flex items-center gap-2 text-brand-500 font-bold hover:text-brand-600 transition-colors">
                Lihat Semua Layanan <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-6 gap-4">
            @php
                $services = [
                    ['i'=>'https://assets2.lottiefiles.com/packages/lf20_q5pk6p1k.json', 'icon'=>'ph-file-text', 't'=>'Layanan Persuratan', 'd'=>'Pengajuan surat dan naskah dinas.'],
                    ['i'=>'https://assets9.lottiefiles.com/packages/lf20_h4th9of3.json', 'icon'=>'ph-users-three', 't'=>'Layanan Informasi Publik', 'd'=>'Akses informasi publik transparan.'],
                    ['i'=>'https://assets3.lottiefiles.com/packages/lf20_5n8yxm.json', 'icon'=>'ph-chat-circle-dots', 't'=>'Pengaduan Masyarakat', 'd'=>'Sampaikan aspirasi dan pengaduan.'],
                    ['i'=>'https://assets7.lottiefiles.com/packages/lf20_3rqwsqnj.json', 'icon'=>'ph-desktop', 't'=>'E-Layanan Sekda', 'd'=>'Akses berbagai layanan internal.'],
                    ['i'=>'https://assets2.lottiefiles.com/packages/lf20_syqnfe7c.json', 'icon'=>'ph-clipboard-text', 't'=>'Layanan Kepegawaian', 'd'=>'Informasi layanan kepegawaian.'],
                    ['i'=>'https://assets4.lottiefiles.com/packages/lf20_q5pk6p1k.json', 'icon'=>'ph-images', 't'=>'Dokumentasi Kegiatan', 'd'=>'Galeri dan arsip kegiatan daerah.'],
                ];
            @endphp
            @foreach($services as $srv)
            <div class="group bg-white rounded-3xl p-6 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 flex flex-col items-center">
                <div class="w-20 h-20 mb-3 group-hover:scale-110 transition-transform duration-300">
                    <lottie-player src="{{ $srv['i'] }}" background="transparent" speed="1" style="width: 100%; height: 100%;" hover></lottie-player>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">{{ $srv['t'] }}</h3>
                <p class="text-xs text-gray-500 mb-6 flex-1">{{ $srv['d'] }}</p>
                <div class="w-8 h-8 rounded-full bg-brand-50 flex items-center justify-center text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition-colors mt-auto">
                    <i class="ph-bold ph-arrow-right text-xs"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ INFO & KONTAK ═══ --}}
<section class="py-20 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            
            {{-- Sekda Dalam Angka --}}
            <div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-8">Sekda dalam Angka</h3>
                <div class="space-y-6">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center text-2xl">
                            <i class="ph-duotone ph-buildings"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">32</p>
                            <p class="text-sm text-gray-500 font-medium mt-1">Bagian & Subbagian</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center text-2xl">
                            <i class="ph-duotone ph-users"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">256</p>
                            <p class="text-sm text-gray-500 font-medium mt-1">Aparatur Sipil Negara</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center text-2xl">
                            <i class="ph-duotone ph-check-circle"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">120+</p>
                            <p class="text-sm text-gray-500 font-medium mt-1">Program & Kegiatan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center text-2xl">
                            <i class="ph-duotone ph-chart-line-up"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 leading-none">98%</p>
                            <p class="text-sm text-gray-500 font-medium mt-1">Capaian Kinerja 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lokasi Kantor --}}
            <div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-8">Lokasi Kantor</h3>
                <div class="bg-gray-100 rounded-3xl h-48 mb-6 relative overflow-hidden flex items-center justify-center">
                    {{-- Pseudo Map Image --}}
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cartographer.png')] opacity-20"></div>
                    <div class="relative z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center">
                        <i class="ph-fill ph-map-pin text-brand-500 text-2xl"></i>
                    </div>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">Kantor Wali Kota Padang</h4>
                <p class="text-sm text-gray-500 leading-relaxed mb-4">
                    Jl. Jenderal Sudirman No. 1, Padang,<br>Sumatera Barat 25129
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-brand-500 bg-brand-50 px-4 py-2 rounded-full hover:bg-brand-100 transition-colors">
                    Lihat di Peta <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            {{-- Hubungi Kami --}}
            <div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-8">Hubungi Kami</h3>
                <div class="space-y-5 mb-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
                            <i class="ph-fill ph-phone text-lg"></i>
                        </div>
                        <div class="pt-2">
                            <p class="text-sm font-bold text-gray-900">(0751) 123456</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
                            <i class="ph-fill ph-envelope-simple text-lg"></i>
                        </div>
                        <div class="pt-2">
                            <p class="text-sm font-bold text-gray-900">sekda@padang.go.id</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
                            <i class="ph-fill ph-globe text-lg"></i>
                        </div>
                        <div class="pt-2">
                            <p class="text-sm font-bold text-gray-900">www.padang.go.id/sekda</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
                            <i class="ph-fill ph-clock text-lg"></i>
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-bold text-gray-900">Senin - Jumat</p>
                            <p class="text-sm text-gray-500">08.00 - 16.00 WIB</p>
                        </div>
                    </div>
                </div>
                
                <h4 class="text-sm font-bold text-gray-900 mb-4">Ikuti Kami</h4>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-brand-500 hover:text-white transition-colors">
                        <i class="ph-fill ph-instagram-logo text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-brand-500 hover:text-white transition-colors">
                        <i class="ph-fill ph-facebook-logo text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-brand-500 hover:text-white transition-colors">
                        <i class="ph-fill ph-youtube-logo text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-brand-500 hover:text-white transition-colors">
                        <i class="ph-fill ph-twitter-logo text-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ VISITOR & FOOTER ═══ --}}
<footer class="bg-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        
        {{-- Visitor Stats Block --}}
        <div class="grid lg:grid-cols-4 gap-6 mb-16">
            <div class="bg-[#fafafa] rounded-[2rem] p-8 flex items-center gap-6 border border-gray-100 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center shrink-0">
                    <i class="ph-duotone ph-users text-3xl text-gray-400"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-500 mb-1">Visitors Hari Ini</p>
                    <p class="text-3xl font-black text-gray-900 leading-none">1.248</p>
                    <p class="text-xs text-gray-400 mt-2">Pengunjung</p>
                </div>
            </div>
            
            <div class="lg:col-span-3 bg-brand-500 rounded-[2rem] p-8 flex items-center justify-between relative overflow-hidden shadow-lg shadow-brand-500/20">
                <div class="relative z-10 flex items-center gap-6">
                    <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center shrink-0 backdrop-blur-md">
                        <i class="ph-fill ph-eye text-3xl text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-brand-100 mb-1">Total Pengunjung</p>
                        <p class="text-4xl font-black text-white leading-none">523.891</p>
                        <p class="text-xs text-brand-200 mt-2">Sejak Januari 2025</p>
                    </div>
                </div>
                {{-- Decorative pattern --}}
                <div class="absolute right-0 top-0 bottom-0 w-1/2 bg-[#eeb644] clip-path-slant z-0 flex items-center justify-end pr-8 opacity-90">
                     <img src="{{ asset('assets/img/hero.png') }}" class="h-full object-cover opacity-20 mix-blend-multiply" alt="">
                </div>
                <style>
                    .clip-path-slant { clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%); }
                </style>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-8 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Lambang_Kota_Padang.png/432px-Lambang_Kota_Padang.png" alt="Logo Padang" class="h-10 w-auto grayscale opacity-80">
                <div class="leading-tight">
                    <span class="block text-[10px] font-bold text-gray-500 tracking-widest uppercase">Sekretariat Daerah</span>
                    <span class="block text-sm font-extrabold text-gray-700">Kota Padang</span>
                </div>
            </div>
            
            <p class="text-xs text-gray-500 max-w-md text-center md:text-left">
                Sekretariat Daerah Kota Padang berkomitmen untuk mendukung tata kelola pemerintahan yang baik demi terwujudnya Padang sebagai kota pintar dan kota sehat.
            </p>

            <div class="flex gap-6">
                <a href="#" class="text-xs font-bold text-gray-500 hover:text-brand-500 transition-colors">Sitemap</a>
                <a href="#" class="text-xs font-bold text-gray-500 hover:text-brand-500 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="text-xs font-bold text-gray-500 hover:text-brand-500 transition-colors">Disclaimer</a>
                <a href="#" class="text-xs font-bold text-gray-500 hover:text-brand-500 transition-colors">Aksesibilitas</a>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <p class="text-[11px] font-medium text-gray-400">
                &copy; {{ date('Y') }} Sekretariat Daerah Kota Padang. All rights reserved.
            </p>
        </div>

    </div>
</footer>

</body>
</html>
