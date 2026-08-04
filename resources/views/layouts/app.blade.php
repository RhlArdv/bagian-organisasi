<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bagian Organisasi') }} - Dashboard</title>

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

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-[#f4f7f6] text-gray-900 antialiased overflow-x-hidden">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

        {{-- MOBILE OVERLAY --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
            @click="sidebarOpen = false"></div>

        {{-- SIDEBAR --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 flex flex-col transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Sidebar Header (Logo) --}}
            <div class="h-24 flex items-center gap-3 px-8 border-b border-gray-50">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-10 h-12 object-contain">
                <div>
                    <span class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">Dashboard</span>
                    <span class="block text-sm font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
                </div>
            </div>

            {{-- Sidebar Menu --}}
            <div class="flex-1 overflow-y-auto py-8 px-4 space-y-1 no-scrollbar">
                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Menu Utama</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-squares-four text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Dashboard Overview</span>
                </a>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan
                    Beranda</p>

                <a href="{{ route('banners.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('banners.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-image text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Banner / Slider Utama</span>
                </a>

                <a href="{{ route('metrics.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('metrics.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-chart-bar text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Indikator Kinerja (RB, SAKIP)</span>
                </a>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Profil</p>
                <a href="{{ route('pegawai.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pegawai.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-users text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Profil Pegawai</span>
                </a>

                <a href="{{ route('pages.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pages.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-file-text text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Halaman Profil (Visi, Misi)</span>
                </a>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Kelembagaan</p>

                <!-- Kelembagaan Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/layanan/penataan-kelembagaan*') || request()->is('admin/layanan/evaluasi-kelembagaan*') || request()->is('admin/layanan/nomenklatur-opd*') || request()->is('admin/documents/peta-jabatan*') || request()->is('admin/documents/produk-hukum*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/layanan/penataan-kelembagaan*') || request()->is('admin/layanan/evaluasi-kelembagaan*') || request()->is('admin/layanan/nomenklatur-opd*') || request()->is('admin/documents/peta-jabatan*') || request()->is('admin/documents/produk-hukum*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-buildings text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Layanan Kelembagaan</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('layanan.index', 'penataan-kelembagaan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/layanan/penataan-kelembagaan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Penataan Kelembagaan
                        </a>
                        <a href="{{ route('layanan.index', 'evaluasi-kelembagaan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/layanan/evaluasi-kelembagaan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Evaluasi Kelembagaan
                        </a>
                        <a href="{{ route('layanan.index', 'nomenklatur-opd') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/layanan/nomenklatur-opd*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Nomenklatur OPD
                        </a>
                        <a href="{{ route('documents.index', 'peta-jabatan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/peta-jabatan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Peta Jabatan
                        </a>
                        <a href="{{ route('documents.index', 'produk-hukum') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/produk-hukum*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Produk Hukum
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Analisis Jabatan
                    & ABK</p>

                <!-- Analisis Jabatan & ABK Jabatan Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/documents/informasi-anjab*') || request()->is('admin/documents/informasi-abk*') || request()->is('admin/documents/pedoman-anjab-abk*') || request()->is('admin/documents/formulir-permohonan*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/documents/informasi-anjab*') || request()->is('admin/documents/informasi-abk*') || request()->is('admin/documents/pedoman-anjab-abk*') || request()->is('admin/documents/formulir-permohonan*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-chart-line-up text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Analisis Jabatan & ABK</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('documents.index', 'informasi-anjab') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/informasi-anjab*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Informasi Anjab
                        </a>
                        <a href="{{ route('documents.index', 'informasi-abk') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/informasi-abk*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Informasi ABK
                        </a>
                        <a href="{{ route('documents.index', 'pedoman-anjab-abk') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/pedoman-anjab-abk*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Buku Pedoman
                        </a>
                        <a href="{{ route('documents.index', 'formulir-permohonan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/formulir-permohonan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Formulir Permohonan
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pelayanan Publik
                </p>

                <!-- Pelayanan Publik Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/layanan/standar-pelayanan*') || request()->is('admin/documents/maklumat-pelayanan*') || request()->is('admin/documents/skm*') || request()->is('admin/layanan/forum-konsultasi-publik*') || request()->is('admin/documents/pengelolaan-pengaduan*') || request()->is('admin/documents/dokumen-pelayanan-publik*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/layanan/standar-pelayanan*') || request()->is('admin/documents/maklumat-pelayanan*') || request()->is('admin/documents/skm*') || request()->is('admin/layanan/forum-konsultasi-publik*') || request()->is('admin/documents/pengelolaan-pengaduan*') || request()->is('admin/documents/dokumen-pelayanan-publik*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-handshake text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Pelayanan Publik</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('layanan.index', 'standar-pelayanan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/layanan/standar-pelayanan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Standar Pelayanan
                        </a>
                        <a href="{{ route('documents.index', 'maklumat-pelayanan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/maklumat-pelayanan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Maklumat Pelayanan
                        </a>
                        <a href="{{ route('documents.index', 'skm') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/skm*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Survei Kepuasan Masyarakat
                        </a>
                        <a href="{{ route('layanan.index', 'forum-konsultasi-publik') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/layanan/forum-konsultasi-publik*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Forum Konsultasi Publik
                        </a>
                        <a href="{{ route('documents.index', 'pengelolaan-pengaduan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/pengelolaan-pengaduan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Pengelolaan Pengaduan
                        </a>
                        <a href="{{ route('documents.index', 'dokumen-pelayanan-publik') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/dokumen-pelayanan-publik*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Dokumen Pelayanan Publik
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Tata Laksana</p>

                <!-- Tata Laksana Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/documents/sop-pelayanan*') || request()->is('admin/documents/peta-proses-bisnis*') || request()->is('admin/documents/tata-naskah-dinas*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/documents/sop-pelayanan*') || request()->is('admin/documents/peta-proses-bisnis*') || request()->is('admin/documents/tata-naskah-dinas*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-flow-arrow text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Tata Laksana</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('documents.index', 'sop-pelayanan') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/sop-pelayanan*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            SOP Pelayanan
                        </a>
                        <a href="{{ route('documents.index', 'peta-proses-bisnis') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/peta-proses-bisnis*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Peta Proses Bisnis
                        </a>
                        <a href="{{ route('documents.index', 'tata-naskah-dinas') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/tata-naskah-dinas*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Tata Naskah Dinas
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Reformasi
                    Birokrasi</p>

                <!-- Reformasi Birokrasi Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/documents/indeks-rb*') || request()->is('admin/documents/sakip*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/documents/indeks-rb*') || request()->is('admin/documents/sakip*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-star text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Reformasi Birokrasi</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('documents.index', 'indeks-rb') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/indeks-rb*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Indeks RB
                        </a>
                        <a href="{{ route('documents.index', 'sakip') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/sakip*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            SAKIP
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Regulasi</p>

                <!-- Regulasi Dropdown -->
                <div x-data="{ open: {{ (request()->is('admin/documents/undang-undang*') || request()->is('admin/documents/peraturan-pemerintah*') || request()->is('admin/documents/permenpanrb*') || request()->is('admin/documents/perda*') || request()->is('admin/documents/perwako*') || request()->is('admin/documents/surat-edaran*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->is('admin/documents/undang-undang*') || request()->is('admin/documents/peraturan-pemerintah*') || request()->is('admin/documents/permenpanrb*') || request()->is('admin/documents/perda*') || request()->is('admin/documents/perwako*') || request()->is('admin/documents/surat-edaran*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-scales text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Regulasi</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('documents.index', 'undang-undang') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/undang-undang*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Undang-Undang
                        </a>
                        <a href="{{ route('documents.index', 'peraturan-pemerintah') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/peraturan-pemerintah*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Peraturan Pemerintah (PP)
                        </a>
                        <a href="{{ route('documents.index', 'permenpanrb') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/permenpanrb*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            PermenPANRB
                        </a>
                        <a href="{{ route('documents.index', 'perda') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/perda*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Perda
                        </a>
                        <a href="{{ route('documents.index', 'perwako') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/perwako*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Perwako
                        </a>
                        <a href="{{ route('documents.index', 'surat-edaran') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->is('admin/documents/surat-edaran*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Surat Edaran
                        </a>
                    </div>
                </div>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Konten &
                    Informasi</p>

                <!-- Konten Dropdown -->
                <div x-data="{ open: {{ (request()->routeIs('posts.*') || request()->routeIs('announcements.*')) ? 'true' : 'false' }} }"
                    class="space-y-1">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ (request()->routeIs('posts.*') || request()->routeIs('announcements.*')) ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-newspaper text-xl"></i>
                            <span class="text-[13px] font-semibold truncate">Berita & Informasi</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-sm transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" class="pl-11 pr-4 py-2 space-y-1"
                        style="display: none;">

                        <a href="{{ route('posts.index') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->routeIs('posts.*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Berita
                        </a>
                        <a href="{{ route('announcements.index') }}"
                            class="block px-3 py-2 text-[13px] rounded-lg transition-colors truncate {{ request()->routeIs('announcements.*') ? 'bg-brand-50 text-brand-600 font-medium' : 'text-gray-500 hover:text-brand-500 hover:bg-gray-50 font-medium' }}">
                            Pengumuman
                        </a>
                    </div>
                </div>

                <!-- <a href="{{ route('statistics.index') }}" class="flex items-center gap-3 px-4 py-3 mt-1 rounded-xl transition-all {{ request()->routeIs('statistics.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-chart-bar text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Statistik Utama</span>
                </a> -->

                <a href="{{ route('agendas.index') }}"
                    class="flex items-center gap-3 px-4 py-3 mt-1 rounded-xl transition-all {{ request()->routeIs('agendas.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-calendar text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Agenda & Aktivitas</span>
                </a>

                <a href="{{ route('faqs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 mt-1 rounded-xl transition-all {{ request()->routeIs('faqs.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-question text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">FAQ (Tanya Jawab)</span>
                </a>

                <a href="{{ route('feedbacks.index') }}"
                    class="flex items-center justify-between px-4 py-3 mt-1 rounded-xl transition-all {{ request()->routeIs('feedbacks.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <div class="flex items-center gap-3">
                        <i class="ph-bold ph-chat-text text-xl"></i>
                        <span class="text-[13px] font-semibold truncate">Kritik, Saran & Pengaduan</span>
                    </div>
                    @php
                        $pendingCount = \App\Models\Feedback::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-extrabold text-brand-700 bg-brand-100 rounded-full border border-brand-200">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.live-chat.index') }}"
                    class="flex items-center justify-between px-4 py-3 mt-1 rounded-xl transition-all {{ request()->routeIs('admin.live-chat.*') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <div class="flex items-center gap-3">
                        <i class="ph-bold ph-chat-circle-dots text-xl"></i>
                        <span class="text-[13px] font-semibold truncate">Live Chat Pengguna</span>
                    </div>
                    @php
                        $chatUnreadCount = \App\Models\ChatSession::where('status', 'open')->where('unread_admin', '>', 0)->count();
                    @endphp
                    @if($chatUnreadCount > 0)
                        <span class="relative flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-extrabold text-white bg-red-500 rounded-full shadow-sm shadow-red-500/40">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative">{{ $chatUnreadCount }}</span>
                        </span>
                    @endif
                </a>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan
                    Kontak</p>
                <a href="{{ route('settings.contact') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('settings.contact') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-address-book text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Kontak & Lokasi</span>
                </a>

                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan Akun
                </p>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('profile.edit') ? 'bg-brand-50 text-brand-500 font-medium' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-user-circle text-xl"></i>
                    <span class="text-[13px] font-semibold truncate">Profil Akun</span>
                </a>
            </div>

            {{-- Sidebar Footer (Logout) --}}
            <div class="p-4 pb-8 border-t border-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold hover:bg-red-50 transition-all">
                        <i class="ph-bold ph-sign-out text-xl"></i>
                        <span class="text-[13px] font-semibold truncate">Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen w-full lg:w-[calc(100%-16rem)] max-w-full overflow-x-hidden">

            {{-- TOPBAR --}}
            <header
                class="h-20 md:h-24 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 lg:px-10 sticky top-0 z-30">

                {{-- Left side Topbar --}}
                <div class="flex items-center gap-2 sm:gap-4">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-600 hover:bg-brand-50 hover:text-brand-500 transition-colors">
                        <i class="ph-bold ph-list text-xl"></i>
                    </button>
                    <div class="overflow-hidden max-w-[200px] sm:max-w-md md:max-w-none">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>
                </div>

                {{-- Right side Topbar (Profile Dropdown) --}}
                <div class="relative shrink-0" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center gap-2 sm:gap-3 p-1.5 sm:p-2 sm:pr-4 rounded-full border border-gray-100 hover:border-brand-200 hover:bg-brand-50 transition-all group">
                        <div
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="text-left hidden md:block">
                            <span
                                class="block text-sm font-bold text-gray-900 group-hover:text-brand-600">{{ Auth::user()->name }}</span>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase">Administrator</span>
                        </div>
                        <i class="ph-bold ph-caret-down text-gray-400 text-xs transition-transform duration-300 ml-1 sm:ml-2"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-transition.opacity.duration.200ms
                        class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 shadow-xl shadow-brand-500/5 rounded-2xl py-3 z-50"
                        style="display: none;">
                        <div class="px-5 py-2 mb-2 border-b border-gray-50 md:hidden">
                            <span class="block text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</span>
                            <span class="block text-[10px] font-bold text-gray-400 truncate">{{ Auth::user()->email }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-brand-500 hover:bg-brand-50 transition-colors">
                            <i class="ph-bold ph-user"></i> Profil Akun
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 transition-colors">
                                <i class="ph-bold ph-sign-out"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-10 max-w-full overflow-x-hidden">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>

</html>