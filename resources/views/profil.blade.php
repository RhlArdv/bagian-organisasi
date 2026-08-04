<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Bagian Organisasi Setda Kota Padang</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}?v=1.0">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900" rel="stylesheet" />
    
    {{-- Phosphor Icons (jsDelivr Fast CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/index.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/duotone/style.css">

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
            position: relative;
        }
    </style>
</head>
<body class="bg-[#f4f7f6] text-gray-900 antialiased overflow-x-hidden min-h-screen flex flex-col" x-data="{ scrolled: false, mobileOpen: false }" @scroll.window.passive="scrolled = (window.pageYOffset > 30)">

    {{-- ═══ NAVBAR ═══ --}}
    @include('components.navbar')

    {{-- ═══════════════════════════════════════════════════ --}}
    {{-- ═══ MAIN CONTENT ═══ --}}
    {{-- ═══════════════════════════════════════════════════ --}}
    <main class="flex-1 w-full pt-28 lg:pt-32 pb-20">
        
        {{-- PAGE HEADER --}}
        <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
            <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Profil</h1>
            <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
                <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
                <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
                <span class="text-gray-500">Profil</span>
            </nav>
        </section>

        {{-- KATA SAMBUTAN --}}
        <section class="mb-10">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="bg-white rounded-[2rem] p-8 lg:p-12 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
                    
                    {{-- Left Text Box --}}
                    <div class="flex-1">
                        <h2 class="text-[22px] lg:text-3xl font-black text-[#1a202c] mb-3">
                            {{ isset($pages['sambutan']) && $pages['sambutan']->title ? $pages['sambutan']->title : 'Sambutan Kepala Bagian Organisasi' }}
                        </h2>
                        <div class="w-16 h-[3px] bg-brand-400 mb-6"></div>
                        
                        <div class="text-gray-600 font-medium text-[14px] leading-relaxed space-y-4 mb-8">
                            @if(isset($pages['sambutan']) && $pages['sambutan']->content)
                                {!! $pages['sambutan']->content !!}
                            @else
                                <p class="font-bold text-[#1a202c]">Assalamu'alaikum Wr. Wb.</p>
                                <p>Selamat datang di website resmi Bagian Organisasi Sekretariat Daerah Kota Padang. Website ini kami hadirkan sebagai wujud komitmen dalam memberikan informasi yang transparan, layanan yang prima, serta kemudahan akses bagi seluruh masyarakat dan perangkat daerah.</p>
                                <p>Kami berharap website ini dapat menjadi sarana komunikasi yang efektif serta mendukung terwujudnya pelayanan yang profesional, akuntabel, dan terpercaya.</p>
                                <p>Wassalamu'alaikum Wr. Wb.</p>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-[17px] font-black text-[#1a202c]">{{ isset($kepala) && $kepala ? $kepala->nama : 'Ir. Yudi Indra, M.M.' }}</h3>
                            <p class="text-[13px] font-bold text-brand-400 mt-0.5">{{ isset($kepala) && $kepala ? $kepala->jabatan : 'Kepala Bagian Organisasi' }}</p>
                        </div>
                    </div>

                    {{-- Right Photo --}}
                    <div class="relative w-full lg:w-[42%] px-2 lg:px-6">
                        <div class="absolute inset-0 bg-[#fdf2d9] rounded-[2rem] transform translate-x-4 translate-y-4 lg:translate-x-6 lg:translate-y-6 z-0"></div>
                        <div class="relative z-10 w-full aspect-[4/3] rounded-[2rem] overflow-hidden bg-[#f0f2f5]">
                            @php
                                $kepalaFoto = (isset($kepala) && $kepala && $kepala->foto) 
                                    ? (\Illuminate\Support\Str::startsWith($kepala->foto, ['http', '/']) ? $kepala->foto : \Illuminate\Support\Facades\Storage::url($kepala->foto))
                                    : '/assets/img/staff/kepala_pejabat_khaki_1785375439464.png';
                            @endphp
                            <img src="{{ $kepalaFoto }}" alt="{{ isset($kepala) && $kepala ? $kepala->nama : 'Kepala Bagian Organisasi' }}" class="w-full h-full object-cover object-top">
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- VISI, MISI, TUJUAN --}}
        <section class="mb-10">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Visi --}}
                    <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)] h-full">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-400 flex items-center justify-center mb-6">
                            <i class="ph-bold ph-eye text-[26px]"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#1a202c] mb-4">Visi</h3>
                        <div class="text-[13.5px] text-gray-600 font-medium leading-relaxed space-y-2">
                            @if(isset($pages['visi']) && $pages['visi']->content)
                                {!! $pages['visi']->content !!}
                            @else
                                <p>Terwujudnya pelayanan umum yang profesional, efektif, efisien dan berkelanjutan dalam mendukung tata kelola pemerintahan yang baik di Kota Padang.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Misi --}}
                    <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)] h-full">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-400 flex items-center justify-center mb-6">
                            <i class="ph-bold ph-target text-[26px]"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#1a202c] mb-4">Misi</h3>
                        @if(isset($pages['misi']) && $pages['misi']->content)
                            <div class="space-y-3">
                                {!! str_replace('<p>', '<div class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed"><span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span><div>', str_replace('</p>', '</div></div>', $pages['misi']->content)) !!}
                            </div>
                        @else
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Meningkatkan kualitas pelayanan umum yang cepat, tepat dan transparan.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Mengoptimalkan pengelolaan aset, rumah tangga dan dokumentasi.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Mewujudkan tata kelola administrasi yang akuntabel dan inovatif.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Mendukung pelaksanaan tugas pemerintahan daerah secara efektif dan efisien.
                                </li>
                            </ul>
                        @endif
                    </div>

                    {{-- Tujuan --}}
                    <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)] h-full">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-400 flex items-center justify-center mb-6">
                            <i class="ph-bold ph-flag-banner text-[26px]"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#1a202c] mb-4">Tujuan</h3>
                        @if(isset($pages['tujuan']) && $pages['tujuan']->content)
                            <div class="space-y-3">
                                {!! str_replace('<p>', '<div class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed"><span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span><div>', str_replace('</p>', '</div></div>', $pages['tujuan']->content)) !!}
                            </div>
                        @else
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Memberikan pelayanan umum yang prima bagi seluruh perangkat daerah.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Menyediakan sarana dan prasarana kerja yang memadai.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Mendukung kelancaran administrasi dan operasional Pemerintah Kota Padang.
                                </li>
                                <li class="flex items-start gap-3 text-[13.5px] text-gray-600 font-medium leading-relaxed">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                                    Mewujudkan lingkungan kerja yang tertib, aman dan nyaman.
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- TUPOKSI --}}
        <section class="mb-10">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="bg-white rounded-[2rem] p-8 lg:p-12 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex flex-col lg:flex-row gap-10 lg:gap-16">
                    <div class="w-full lg:w-[40%]">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="ph-bold ph-briefcase text-brand-400 text-3xl"></i>
                            <h2 class="text-[26px] font-black text-[#1a202c]">Tupoksi</h2>
                        </div>
                        <div class="text-gray-600 font-medium text-[13.5px] leading-relaxed mb-6 space-y-2">
                            @if(isset($pages['tugas-fungsi']) && $pages['tugas-fungsi']->content)
                                {!! $pages['tugas-fungsi']->content !!}
                            @else
                                <p>Bagian Organisasi Sekretariat Daerah Kota Padang mempunyai tugas melaksanakan penyiapan bahan perumusan kebijakan daerah, pengkoordinasian perumusan kebijakan daerah, pengkoordinasian pelaksanaan tugas perangkat daerah, pemantauan dan evaluasi pelaksanaan kebijakan daerah di bidang organisasi.</p>
                            @endif
                        </div>
                        <a href="#profil-pegawai" class="inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-brand-200 text-brand-400 font-bold rounded-full hover:bg-brand-50 transition-colors text-[13px]">
                            Selengkapnya <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                    <div class="w-full lg:w-[60%] space-y-3 lg:mt-2">
                        @if(isset($pages['fungsi']) && $pages['fungsi']->content)
                            @php
                                preg_match_all('/<p>(.*?)<\/p>/is', $pages['fungsi']->content, $matches);
                                $fungsiItems = !empty($matches[1]) ? $matches[1] : [$pages['fungsi']->content];
                            @endphp
                            @foreach($fungsiItems as $index => $item)
                                <div class="flex items-center gap-5 bg-[#fffaf3] p-4 lg:p-5 rounded-2xl border border-[#ffe8c7]">
                                    <span class="text-brand-400 font-bold text-[15px] w-8 text-center shrink-0">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="text-[13px] font-bold text-[#1a202c]">{!! $item !!}</div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center gap-5 bg-[#fffaf3] p-4 lg:p-5 rounded-2xl border border-[#ffe8c7]">
                                <span class="text-brand-400 font-bold text-[15px] w-8 text-center shrink-0">01</span>
                                <p class="text-[13px] font-bold text-[#1a202c]">Melaksanakan urusan ketatausahaan, kearsipan, dan kerumahtanggaan.</p>
                            </div>
                            <div class="flex items-center gap-5 bg-[#fffaf3] p-4 lg:p-5 rounded-2xl border border-[#ffe8c7]">
                                <span class="text-brand-400 font-bold text-[15px] w-8 text-center shrink-0">02</span>
                                <p class="text-[13px] font-bold text-[#1a202c]">Mengelola administrasi aset dan perlengkapan daerah.</p>
                            </div>
                            <div class="flex items-center gap-5 bg-[#fffaf3] p-4 lg:p-5 rounded-2xl border border-[#ffe8c7]">
                                <span class="text-brand-400 font-bold text-[15px] w-8 text-center shrink-0">03</span>
                                <p class="text-[13px] font-bold text-[#1a202c]">Menyelenggarakan dokumentasi dan publikasi kegiatan pimpinan daerah.</p>
                            </div>
                            <div class="flex items-center gap-5 bg-[#fffaf3] p-4 lg:p-5 rounded-2xl border border-[#ffe8c7]">
                                <span class="text-brand-400 font-bold text-[15px] w-8 text-center shrink-0">04</span>
                                <p class="text-[13px] font-bold text-[#1a202c]">Memberikan pelayanan administratif kepada perangkat daerah dan masyarakat.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- MAKLUMAT PELAYANAN --}}
        <section class="mb-12">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="bg-[#fff9ed] rounded-[2rem] p-8 lg:px-12 flex flex-col md:flex-row items-center md:items-start gap-6 border border-[#ffe5b5] shadow-sm">
                    <div class="w-[70px] h-[70px] bg-white rounded-2xl flex items-center justify-center shrink-0 shadow-sm text-brand-400">
                        <i class="ph-fill ph-shield-check text-[36px]"></i>
                    </div>
                    <div class="pt-1 text-center md:text-left">
                        <h3 class="text-xl font-black text-brand-500 mb-2">Maklumat Pelayanan</h3>
                        <div class="text-[#1a202c] font-medium text-[13.5px] leading-relaxed max-w-4xl opacity-80 space-y-2">
                            @if(isset($pages['maklumat-pelayanan']) && $pages['maklumat-pelayanan']->content)
                                {!! $pages['maklumat-pelayanan']->content !!}
                            @else
                                <p>Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan yang telah ditetapkan, memberikan pelayanan dengan sepenuh hati, transparan, cepat, tepat, dan akuntabel serta bersedia menerima sanksi sesuai peraturan perundang-undangan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PROFIL PEGAWAI --}}
        <section id="profil-pegawai" class="mb-14">
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <i class="ph-bold ph-users-three text-brand-400 text-3xl"></i>
                        <h2 class="text-[26px] font-black text-[#1a202c]">Profil Pegawai</h2>
                    </div>
                </div>

                @if(isset($pegawais) && $pegawais->count() > 0)
                    <x-pegawai-cards :pegawais="$pegawais" columns="5" />
                @else
                    <div class="text-center py-12 text-gray-400 font-medium">Belum ada data pegawai yang dipublikasikan.</div>
                @endif

                <div class="flex justify-center gap-1.5 mt-8">
                    <span class="w-6 h-1.5 rounded-full bg-brand-400"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                </div>
            </div>
        </section>
        
        {{-- KONTAK & LOKASI --}}
        <section>
            <div class="max-w-7xl mx-auto px-5 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
                    
                    {{-- Left: Kontak --}}
                    <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                        <h2 class="text-xl font-black text-[#1a202c] mb-8">Kontak Kami</h2>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <i class="ph-bold ph-phone-call text-brand-400 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-[13px] text-gray-700 font-medium">(0751) 123456</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-bold ph-envelope-simple text-brand-400 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-[13px] text-gray-700 font-medium">bag.organisasi@padang.go.id</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-bold ph-map-pin text-brand-400 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-[13px] text-gray-700 font-medium leading-relaxed">Jl. Jenderal Sudirman No. 1<br>Padang, Sumatera Barat 25129</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-bold ph-clock text-brand-400 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-[13px] text-[#1a202c] font-bold mb-0.5">Senin - Jumat</p>
                                    <p class="text-[13px] text-gray-500 font-medium">08.00 - 16.00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 mt-8 pt-6">
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-brand-400 hover:text-white hover:border-brand-400 transition-colors shadow-sm"><i class="ph-bold ph-instagram-logo"></i></a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-brand-400 hover:text-white hover:border-brand-400 transition-colors shadow-sm"><i class="ph-bold ph-facebook-logo"></i></a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-brand-400 hover:text-white hover:border-brand-400 transition-colors shadow-sm"><i class="ph-bold ph-twitter-logo"></i></a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-brand-400 hover:text-white hover:border-brand-400 transition-colors shadow-sm"><i class="ph-bold ph-youtube-logo"></i></a>
                        </div>
                    </div>

                    {{-- Right: Lokasi (Maps) --}}
                    <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex flex-col">
                        <h2 class="text-xl font-black text-[#1a202c] mb-6">Lokasi Kami</h2>
                        <div class="flex-1 bg-gray-100 rounded-2xl overflow-hidden relative border border-gray-100 min-h-[300px]">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2683976643275!2d100.35692807531795!3d-0.9512986353524716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b948c7c72e11%3A0x6771787fa612c99f!2sSekretariat%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1785310213215!5m2!1sid!2sid" 
                                class="w-full h-full absolute inset-0" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-black/5 pointer-events-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ═══ FOOTER ═══ --}}
    @include('components.footer')

    {{-- Widget Aksesibilitas Disabilitas (Ramah Inklusi) --}}
    <x-accessibility-widget />

    {{-- Widget Live Chat Pengguna (IP Locked System) --}}
    <x-live-chat />
</body>
</html>
