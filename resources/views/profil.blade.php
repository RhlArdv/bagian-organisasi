<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Bagian Organisasi Sekretariat Daerah Kota Padang</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900|playfair-display:700,700i" rel="stylesheet" />
    
    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800 bg-gray-50 h-screen overflow-hidden flex flex-col font-sans">

    {{-- ═══ NAVBAR (FIXED, COMPACT) ═══ --}}
    <header class="bg-white/90 backdrop-blur-md border-b border-gray-100 z-50 shrink-0 h-20 flex items-center shadow-sm">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 w-full flex justify-between items-center">
            
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 lg:w-11 lg:h-11 flex items-center justify-center bg-white rounded-xl shadow-md shadow-brand-500/10 border border-brand-50 group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-7 h-auto relative z-10">
                </div>
                <div class="flex flex-col">
                    <span class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-0.5">Pemko Padang</span>
                    <span class="block text-sm font-extrabold text-gray-900 leading-none">BAGIAN ORGANISASI</span>
                </div>
            </a>

            {{-- Navigation Links --}}
            <nav class="hidden lg:flex items-center gap-8">
                <a href="/" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Beranda</a>
                <a href="/profil" class="text-[13px] font-bold text-brand-500 border-b-2 border-brand-500 pb-1 uppercase tracking-wide">Profil</a>
            </nav>

            {{-- CTA Button --}}
            <div class="hidden lg:block">
                <a href="#kontak" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-brand-500 transition-colors shadow-lg shadow-gray-900/20">
                    Hubungi Kami
                </a>
            </div>
            
            {{-- Mobile Menu Button (Omitted for brevity in dashboard) --}}
            <button class="lg:hidden text-gray-900">
                <i class="ph-bold ph-list text-2xl"></i>
            </button>
        </div>
    </header>

    {{-- ═══ DASHBOARD PROFIL (100vh Layout) ═══ --}}
    <main class="flex-1 flex overflow-hidden w-full max-w-[1440px] mx-auto p-4 lg:p-6 gap-6" x-data="{ activeTab: 'visi' }">
        
        {{-- LEFT SIDEBAR: Navigation --}}
        <aside class="w-full lg:w-80 shrink-0 bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 flex flex-col overflow-hidden relative hidden lg:flex">
            {{-- Decorative top bg --}}
            <div class="h-32 bg-[#0f172a] relative overflow-hidden shrink-0">
                <img src="{{ asset('assets/img/logo.png') }}" class="absolute -right-4 -top-4 w-40 opacity-10 mix-blend-luminosity">
            </div>
            
            {{-- Profile Title Box --}}
            <div class="px-6 relative -mt-12 shrink-0 mb-6">
                <div class="w-20 h-20 bg-white rounded-2xl shadow-xl shadow-brand-500/10 flex items-center justify-center p-3 border border-gray-50 mb-4">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-full h-auto">
                </div>
                <h1 class="text-2xl font-black tracking-tight text-gray-900 leading-tight mb-1">Profil <span class="text-brand-500">Instansi</span></h1>
                <p class="text-xs text-gray-500 font-medium leading-relaxed">Bagian Organisasi Setda Kota Padang.</p>
            </div>

            {{-- Tabs --}}
            <div class="flex-1 overflow-y-auto px-4 pb-6 space-y-1 hide-scrollbar">
                <button @click="activeTab = 'visi'" :class="activeTab === 'visi' ? 'bg-brand-50 text-brand-600 font-bold' : 'text-gray-500 font-semibold hover:bg-gray-50'" class="w-full text-left px-4 py-3.5 rounded-xl text-sm transition-all flex items-center gap-3">
                    <i class="ph-fill ph-target text-lg" :class="activeTab === 'visi' ? 'text-brand-500' : 'text-gray-400'"></i> Visi & Misi
                </button>
                <button @click="activeTab = 'tupoksi'" :class="activeTab === 'tupoksi' ? 'bg-brand-50 text-brand-600 font-bold' : 'text-gray-500 font-semibold hover:bg-gray-50'" class="w-full text-left px-4 py-3.5 rounded-xl text-sm transition-all flex items-center gap-3">
                    <i class="ph-fill ph-briefcase text-lg" :class="activeTab === 'tupoksi' ? 'text-brand-500' : 'text-gray-400'"></i> Tugas Pokok & Fungsi
                </button>
                <button @click="activeTab = 'struktur'" :class="activeTab === 'struktur' ? 'bg-brand-50 text-brand-600 font-bold' : 'text-gray-500 font-semibold hover:bg-gray-50'" class="w-full text-left px-4 py-3.5 rounded-xl text-sm transition-all flex items-center gap-3">
                    <i class="ph-fill ph-tree-structure text-lg" :class="activeTab === 'struktur' ? 'text-brand-500' : 'text-gray-400'"></i> Struktur Organisasi
                </button>
                <button @click="activeTab = 'pegawai'" :class="activeTab === 'pegawai' ? 'bg-brand-50 text-brand-600 font-bold' : 'text-gray-500 font-semibold hover:bg-gray-50'" class="w-full text-left px-4 py-3.5 rounded-xl text-sm transition-all flex items-center gap-3">
                    <i class="ph-fill ph-users-three text-lg" :class="activeTab === 'pegawai' ? 'text-brand-500' : 'text-gray-400'"></i> Profil Pegawai
                </button>
                <button @click="activeTab = 'maklumat'" :class="activeTab === 'maklumat' ? 'bg-brand-50 text-brand-600 font-bold' : 'text-gray-500 font-semibold hover:bg-gray-50'" class="w-full text-left px-4 py-3.5 rounded-xl text-sm transition-all flex items-center gap-3">
                    <i class="ph-fill ph-certificate text-lg" :class="activeTab === 'maklumat' ? 'text-brand-500' : 'text-gray-400'"></i> Maklumat Pelayanan
                </button>
            </div>
            
            <div class="p-4 border-t border-gray-100 shrink-0 text-center">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">&copy; {{ date('Y') }} Pemko Padang</span>
            </div>
        </aside>

        {{-- RIGHT CONTENT AREA: The scrollable view --}}
        <section class="flex-1 bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-y-auto hide-scrollbar relative">
            
            {{-- Tab 1: Visi & Misi --}}
            <div x-show="activeTab === 'visi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="p-8 lg:p-12 min-h-full flex flex-col justify-center">
                <div class="max-w-4xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 text-brand-600 text-xs font-bold tracking-wide mb-6">
                        <span class="w-2 h-2 rounded-full bg-brand-500"></span> Visi Daerah
                    </div>
                    <h2 class="text-3xl lg:text-5xl font-black text-gray-900 mb-8 leading-tight tracking-tight">
                        Mewujudkan Kota Padang Sebagai Kota Pendidikan, Perdagangan dan Pariwisata yang Sejahtera, Religius dan Berbudaya.
                    </h2>
                    
                    <div class="w-full h-px bg-gray-100 my-10"></div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="ph-fill ph-target text-brand-500 text-2xl"></i> Misi Kami
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-200 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-white text-brand-500 flex items-center justify-center font-black shadow-sm mb-4">1</div>
                            <p class="text-gray-700 text-sm font-medium leading-relaxed">Meningkatkan Kualitas Pendidikan untuk Menghasilkan SDM yang Beriman, Kreatif, Inovatif dan Berdaya Saing.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-200 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-white text-brand-500 flex items-center justify-center font-black shadow-sm mb-4">2</div>
                            <p class="text-gray-700 text-sm font-medium leading-relaxed">Mewujudkan Kota Padang Sebagai Pusat Perdagangan dan Pariwisata yang Tangguh.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-200 transition-colors md:col-span-2">
                            <div class="w-10 h-10 rounded-xl bg-white text-brand-500 flex items-center justify-center font-black shadow-sm mb-4">3</div>
                            <p class="text-gray-700 text-sm font-medium leading-relaxed">Meningkatkan Pertumbuhan Ekonomi untuk Kesejahteraan Masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 2: Tupoksi --}}
            <div x-show="activeTab === 'tupoksi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="p-8 lg:p-12" style="display: none;">
                <h2 class="text-3xl font-black text-gray-900 mb-2">Tugas Pokok & Fungsi</h2>
                <p class="text-gray-500 mb-10">Penyelenggaraan fungsi perumusan kebijakan, pengoordinasian, pembinaan, dan evaluasi.</p>
                
                <div class="grid xl:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-brand-200 transition-all group">
                        <div class="w-12 h-12 bg-brand-50 text-brand-500 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <i class="ph-bold ph-buildings text-xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-2">Kelembagaan & Anjab</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">Menyiapkan bahan perumusan kebijakan, pembinaan, dan fasilitasi di bidang kelembagaan dan analisis jabatan perangkat daerah.</p>
                        <ul class="text-xs text-gray-600 space-y-2 font-medium bg-gray-50 p-4 rounded-xl">
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-500"></i> Penataan SOTK</li>
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-500"></i> Evaluasi Jabatan</li>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-200 transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <i class="ph-bold ph-files text-xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-2">Tata Laksana & Pelayanan Publik</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">Menyiapkan bahan perumusan kebijakan di bidang ketatalaksanaan, standar operasional prosedur, dan peningkatan kualitas pelayanan.</p>
                        <ul class="text-xs text-gray-600 space-y-2 font-medium bg-gray-50 p-4 rounded-xl">
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-blue-500"></i> Penyusunan SOP</li>
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-blue-500"></i> SKM & Inovasi</li>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-emerald-200 transition-all group">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <i class="ph-bold ph-chart-line-up text-xl"></i>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-2">Kinerja & Reformasi Birokrasi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">Melaksanakan pembinaan dan pemantauan sistem akuntabilitas kinerja instansi pemerintah dan fasilitasi pelaksanaan reformasi birokrasi.</p>
                        <ul class="text-xs text-gray-600 space-y-2 font-medium bg-gray-50 p-4 rounded-xl">
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-emerald-500"></i> Evaluasi SAKIP</li>
                            <li class="flex items-center gap-2"><i class="ph-bold ph-check text-emerald-500"></i> Road Map RB</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Tab 3: Struktur Organisasi --}}
            <div x-show="activeTab === 'struktur'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="p-8 lg:p-12 min-h-full flex flex-col" style="display: none;">
                <h2 class="text-3xl font-black text-gray-900 mb-2">Struktur Organisasi</h2>
                <p class="text-gray-500 mb-8">Bagan hierarki Bagian Organisasi Sekretariat Daerah Kota Padang.</p>
                <div class="flex-1 w-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl flex items-center justify-center">
                    <div class="text-center">
                        <i class="ph-bold ph-image text-5xl text-gray-300 mb-3 block mx-auto"></i>
                        <p class="text-gray-500 font-medium">Bagan Struktur (Flowchart) akan diunggah melalui Admin.</p>
                    </div>
                </div>
            </div>

            {{-- Tab 4: Profil Pegawai --}}
            <div x-show="activeTab === 'pegawai'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="p-8 lg:p-12" style="display: none;">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 mb-2">Profil Pegawai</h2>
                        <p class="text-gray-500">Mengenal lebih dekat tim Bagian Organisasi Setda Kota Padang.</p>
                    </div>
                    <button class="bg-gray-100 hover:bg-brand-50 hover:text-brand-600 text-gray-600 px-4 py-2 rounded-xl text-sm font-bold transition-colors">Lihat Semua</button>
                </div>
                
                <div class="grid grid-cols-2 xl:grid-cols-4 gap-6">
                    {{-- Card 1 --}}
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 text-center hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl shadow-brand-500/5 group">
                        <div class="w-20 h-20 mx-auto rounded-full mb-4 overflow-hidden border-4 border-brand-50 group-hover:border-brand-200 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=K+B&background=f59e0b&color=fff" alt="Foto" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">H. Nama Pejabat, S.STP</h4>
                        <p class="text-[11px] text-brand-500 font-bold uppercase tracking-wider mt-1.5">Kepala Bagian</p>
                    </div>
                    {{-- Card 2 --}}
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 text-center hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl shadow-blue-500/5 group">
                        <div class="w-20 h-20 mx-auto rounded-full mb-4 overflow-hidden border-4 border-blue-50 group-hover:border-blue-200 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=S+K&background=3b82f6&color=fff" alt="Foto" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">Nama Pegawai, S.Kom</h4>
                        <p class="text-[11px] text-blue-500 font-bold uppercase tracking-wider mt-1.5">Subkor Kelembagaan</p>
                    </div>
                    {{-- Card 3 --}}
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 text-center hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl shadow-emerald-500/5 group">
                        <div class="w-20 h-20 mx-auto rounded-full mb-4 overflow-hidden border-4 border-emerald-50 group-hover:border-emerald-200 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=S+T&background=10b981&color=fff" alt="Foto" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">Nama Pegawai, S.A.P</h4>
                        <p class="text-[11px] text-emerald-500 font-bold uppercase tracking-wider mt-1.5">Subkor Tata Laksana</p>
                    </div>
                    {{-- Card 4 --}}
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 text-center hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl shadow-purple-500/5 group">
                        <div class="w-20 h-20 mx-auto rounded-full mb-4 overflow-hidden border-4 border-purple-50 group-hover:border-purple-200 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=S+K&background=8b5cf6&color=fff" alt="Foto" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">Nama Pegawai, S.IP</h4>
                        <p class="text-[11px] text-purple-500 font-bold uppercase tracking-wider mt-1.5">Subkor Kinerja & RB</p>
                    </div>
                </div>
            </div>

            {{-- Tab 5: Maklumat Pelayanan --}}
            <div x-show="activeTab === 'maklumat'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="p-8 lg:p-12 min-h-full flex items-center justify-center" style="display: none;">
                <div class="max-w-2xl w-full bg-white p-10 lg:p-14 rounded-[2rem] border-4 border-double border-brand-200 text-center relative overflow-hidden shadow-2xl shadow-brand-500/10">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-16 mx-auto mb-6 opacity-80">
                    <h2 class="text-2xl font-black text-gray-900 mb-2 font-serif uppercase tracking-widest">Maklumat Pelayanan</h2>
                    <div class="w-16 h-1 bg-brand-500 mx-auto mb-8 rounded-full"></div>
                    
                    <p class="text-lg text-gray-700 leading-loose italic mb-10 font-serif">
                        "Dengan ini, Kami menyatakan sanggup menyelenggarakan pelayanan publik sesuai dengan standar pelayanan yang telah ditetapkan, dan apabila tidak menepati janji ini, Kami siap menerima sanksi sesuai dengan peraturan perundang-undangan yang berlaku."
                    </p>
                    
                    <div class="inline-block text-left border-l-4 border-brand-500 pl-4 py-1">
                        <p class="text-xs text-gray-500 mb-1">Padang, 01 Januari 2026</p>
                        <p class="font-bold text-gray-900 mb-8">Kepala Bagian Organisasi</p>
                        <p class="font-bold text-gray-900 underline decoration-2 underline-offset-4 text-sm">H. NAMA PEJABAT, S.STP, M.Si</p>
                    </div>
                </div>
            </div>
            
        </section>
    </main>

    <style>
        /* Custom Scrollbar for the Right Content Area */
        .hide-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .hide-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .hide-scrollbar::-webkit-scrollbar-thumb {
            background-color: #e5e7eb;
            border-radius: 10px;
        }
        .hide-scrollbar:hover::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
        }
    </style>
</body>
</html>
