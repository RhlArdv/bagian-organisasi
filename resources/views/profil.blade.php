<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Bagian Organisasi Setda Kota Padang</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900" rel="stylesheet" />
    
    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-900 bg-[#f8fafc] font-sans selection:bg-brand-500 selection:text-white flex flex-col min-h-screen">

    {{-- ═══ NAVBAR (Dari Welcome) ═══ --}}
    <header class="fixed w-full z-50 top-0 transition-all duration-500 bg-white/80 backdrop-blur-xl border-b border-gray-100 shadow-sm shadow-brand-500/5 py-4">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 flex justify-between items-center">
            
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 lg:gap-4 group">
                <div class="relative w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center bg-white rounded-2xl shadow-xl shadow-brand-500/10 border border-brand-50 overflow-hidden group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-8 lg:w-10 h-auto relative z-10">
                </div>
                <div class="flex flex-col">
                    <span class="block text-[10px] lg:text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-0.5">Pemerintah Kota Padang</span>
                    <span class="block text-sm lg:text-base font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden lg:flex items-center justify-center gap-6 xl:gap-8 flex-1 px-4">
                <a href="/" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Beranda</a>
                <a href="/profil" class="text-[13px] font-bold text-brand-500 border-b-2 border-brand-500 pb-1 uppercase tracking-wide">Profil</a>
                <a href="/#layanan" class="text-[13px] font-bold text-gray-500 hover:text-brand-500 transition-colors uppercase tracking-wide">Layanan</a>
            </nav>

            {{-- Right CTA --}}
            <div class="hidden lg:flex items-center gap-4">
                <a href="/#kontak" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold text-[13px] hover:bg-brand-500 transition-colors shadow-lg shadow-gray-900/20 uppercase tracking-wide">
                    Hubungi Kami
                </a>
            </div>
            
        </div>
    </header>

    {{-- ═══ GEN-Z BENTO GRID LAYOUT ═══ --}}
    <main class="flex-1 max-w-[1400px] w-full mx-auto px-5 lg:px-8 pt-32 lg:pt-40 pb-24">
        
        {{-- HERO HEADER --}}
        <div class="text-center mb-12 lg:mb-20 relative">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] max-w-2xl h-[300px] bg-gradient-to-r from-brand-300 via-purple-300 to-orange-300 blur-[120px] opacity-40 -z-10 rounded-full pointer-events-none"></div>
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 shadow-sm text-sm font-bold tracking-tight text-gray-700 mb-6 hover:scale-105 transition-transform cursor-pointer">
                ✨ Mengenal Lebih Dekat
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-black tracking-tighter text-gray-900 leading-[1.1] mb-6">
                Pusat Inovasi <br class="hidden lg:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-orange-500">
                    Tata Kelola Kota Padang
                </span>
            </h1>
            <p class="text-gray-500 text-lg lg:text-xl font-medium max-w-2xl mx-auto">
                Kami adalah Bagian Organisasi Setda Kota Padang. Merancang birokrasi yang lincah, modern, dan selalu berpusat pada masyarakat.
            </p>
        </div>

        {{-- BENTO GRID CONTAINER --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 lg:gap-6 auto-rows-[minmax(250px,auto)]">
            
            {{-- BENTO 1: VISI (Large Box) --}}
            <div class="md:col-span-2 lg:col-span-2 row-span-2 bg-gray-900 text-white rounded-[2.5rem] lg:rounded-[3rem] p-8 lg:p-12 relative overflow-hidden group hover:scale-[1.01] transition-transform duration-500 shadow-xl shadow-gray-900/10">
                <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-brand-950"></div>
                <div class="absolute -top-10 -right-10 p-8 opacity-[0.03] group-hover:scale-110 transition-transform duration-700 pointer-events-none">
                    <i class="ph-fill ph-target text-[20rem]"></i>
                </div>
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 bg-white/10 rounded-[1.2rem] flex items-center justify-center backdrop-blur-md mb-10 border border-white/20 text-brand-400">
                            <i class="ph-bold ph-eye text-3xl"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-400 mb-4 tracking-widest uppercase">Visi Utama</h2>
                        <p class="text-3xl lg:text-[2.5rem] font-black leading-tight tracking-tight text-white mb-8">
                            "Mewujudkan Kota Padang Sebagai Kota Pendidikan, Perdagangan dan Pariwisata yang Sejahtera, Religius dan Berbudaya."
                        </p>
                    </div>
                    <div class="inline-flex items-center gap-2 text-brand-400 font-bold text-sm tracking-wide group-hover:translate-x-2 transition-transform">
                        Explore Misi <i class="ph-bold ph-arrow-right"></i>
                    </div>
                </div>
            </div>

            {{-- BENTO 2: MISI COUNTER (Small Box) --}}
            <div class="bg-brand-500 text-white rounded-[2.5rem] lg:rounded-[3rem] p-8 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-500 flex flex-col justify-center items-center text-center shadow-xl shadow-brand-500/20">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full blur-3xl pointer-events-none"></div>
                <h3 class="text-7xl font-black mb-2 tracking-tighter">7</h3>
                <p class="font-bold text-brand-100 uppercase tracking-widest text-sm">Misi Utama</p>
                <div class="mt-4 px-4 py-1.5 bg-black/10 rounded-full text-[11px] font-bold tracking-widest uppercase backdrop-blur-sm">
                    Berkelanjutan
                </div>
            </div>

            {{-- BENTO 3: TUPOKSI 1 (Kelembagaan) --}}
            <div class="bg-white border border-gray-100 rounded-[2.5rem] lg:rounded-[3rem] p-8 shadow-[0_4px_40px_rgba(0,0,0,0.03)] hover:shadow-xl hover:scale-[1.02] transition-all duration-500 group flex flex-col justify-between relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-5 pointer-events-none group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-buildings text-9xl transform translate-x-4 translate-y-4"></i>
                </div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-brand-50 text-brand-500 rounded-[1.2rem] flex items-center justify-center mb-8 group-hover:rotate-12 transition-transform shadow-inner">
                        <i class="ph-bold ph-buildings text-3xl"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-xl mb-2 tracking-tight">Kelembagaan</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Penataan SOTK, analisis, dan evaluasi formasi jabatan perangkat daerah.</p>
                </div>
            </div>
            
            {{-- BENTO 4: TUPOKSI 2 (Tata Laksana) --}}
            <div class="bg-white border border-gray-100 rounded-[2.5rem] lg:rounded-[3rem] p-8 shadow-[0_4px_40px_rgba(0,0,0,0.03)] hover:shadow-xl hover:scale-[1.02] transition-all duration-500 group flex flex-col justify-between relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-5 pointer-events-none group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-files text-9xl transform translate-x-4 translate-y-4"></i>
                </div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-[1.2rem] flex items-center justify-center mb-8 group-hover:-rotate-12 transition-transform shadow-inner">
                        <i class="ph-bold ph-files text-3xl"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-xl mb-2 tracking-tight">Tata Laksana</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Penyusunan SOP & Peningkatan kualitas Pelayanan Publik.</p>
                </div>
            </div>

            {{-- BENTO 5: TUPOKSI 3 (Kinerja RB) --}}
            <div class="bg-white border border-gray-100 rounded-[2.5rem] lg:rounded-[3rem] p-8 shadow-[0_4px_40px_rgba(0,0,0,0.03)] hover:shadow-xl hover:scale-[1.02] transition-all duration-500 group flex flex-col justify-between relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-5 pointer-events-none group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-chart-line-up text-9xl transform translate-x-4 translate-y-4"></i>
                </div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-[1.2rem] flex items-center justify-center mb-8 group-hover:scale-110 transition-transform shadow-inner">
                        <i class="ph-bold ph-chart-line-up text-3xl"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-xl mb-2 tracking-tight">Kinerja & RB</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Evaluasi SAKIP dan fasilitasi pelaksanaan Reformasi Birokrasi.</p>
                </div>
            </div>

            {{-- BENTO 6: STRUKTUR ORGANISASI (Wide Box) --}}
            <div class="md:col-span-2 lg:col-span-2 bg-gray-100 border border-gray-200 rounded-[2.5rem] lg:rounded-[3rem] p-8 lg:p-12 flex flex-col items-center justify-center text-center group hover:scale-[1.01] transition-transform duration-500 cursor-pointer overflow-hidden relative shadow-inner">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/60 via-transparent to-transparent opacity-50"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white shadow-xl shadow-gray-200/50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i class="ph-bold ph-tree-structure text-4xl text-gray-400 group-hover:text-brand-500 transition-colors"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-3xl tracking-tight mb-2">Struktur Organisasi</h3>
                    <p class="text-gray-500 font-medium text-sm">Lihat bagan hierarki struktural kami.</p>
                </div>
            </div>

            {{-- BENTO 7: PROFIL PEGAWAI --}}
            <div class="md:col-span-3 lg:col-span-2 bg-white border border-gray-100 shadow-[0_4px_40px_rgba(0,0,0,0.03)] rounded-[2.5rem] lg:rounded-[3rem] p-8 lg:p-10 relative overflow-hidden hover:shadow-xl transition-all duration-500 group flex flex-col justify-between">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="font-black text-gray-900 text-3xl tracking-tight mb-2">Meet The Team 👋</h3>
                        <p class="text-gray-500 text-sm font-medium">Orang-orang hebat di balik layar.</p>
                    </div>
                    <button class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-600 hover:bg-brand-500 hover:text-white transition-colors group-hover:rotate-45 duration-300 shrink-0">
                        <i class="ph-bold ph-arrow-up-right text-xl"></i>
                    </button>
                </div>
                
                <div class="flex items-center -space-x-4 ml-2">
                    <img src="https://ui-avatars.com/api/?name=H+P&background=f59e0b&color=fff" class="w-16 h-16 rounded-full border-4 border-white shadow-md z-40 hover:-translate-y-2 transition-transform cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name=S+K&background=3b82f6&color=fff" class="w-16 h-16 rounded-full border-4 border-white shadow-md z-30 hover:-translate-y-2 transition-transform cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name=S+T&background=10b981&color=fff" class="w-16 h-16 rounded-full border-4 border-white shadow-md z-20 hover:-translate-y-2 transition-transform cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name=S+R&background=8b5cf6&color=fff" class="w-16 h-16 rounded-full border-4 border-white shadow-md z-10 hover:-translate-y-2 transition-transform cursor-pointer">
                    <div class="w-16 h-16 rounded-full border-4 border-white shadow-md bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-xs z-0">
                        +15
                    </div>
                </div>
            </div>

            {{-- BENTO 8: MAKLUMAT (Full Width Quote) --}}
            <div class="md:col-span-3 lg:col-span-4 bg-gradient-to-r from-orange-500 to-brand-500 text-white rounded-[2.5rem] lg:rounded-[3rem] p-10 lg:p-14 mt-2 hover:scale-[1.01] transition-transform duration-500 relative overflow-hidden group shadow-2xl shadow-brand-500/20">
                <div class="absolute inset-0 bg-grid-pattern opacity-20 pointer-events-none"></div>
                <div class="absolute -right-10 -bottom-20 opacity-10 transform group-hover:rotate-12 transition-transform duration-1000 pointer-events-none">
                    <i class="ph-fill ph-certificate text-[30rem]"></i>
                </div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-10 lg:gap-14">
                    <div class="w-28 h-28 bg-white/20 backdrop-blur-xl rounded-[2rem] flex items-center justify-center shrink-0 border border-white/30 shadow-2xl">
                        <i class="ph-fill ph-quotes text-6xl"></i>
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="text-xs font-bold tracking-[0.2em] uppercase text-white/80 mb-4">Maklumat Pelayanan</h3>
                        <p class="text-2xl lg:text-4xl font-black leading-tight lg:leading-snug mb-8 tracking-tight text-white drop-shadow-sm">
                            "Kami sanggup menyelenggarakan pelayanan publik sesuai standar. Jika melanggar, kami siap menerima sanksi."
                        </p>
                        <div class="flex items-center justify-center md:justify-start gap-4">
                            <div class="w-12 h-12 bg-white rounded-full overflow-hidden shadow-lg">
                                <img src="https://ui-avatars.com/api/?name=K+B&background=f59e0b&color=fff" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-black text-sm lg:text-base">H. NAMA PEJABAT, S.STP, M.Si</h4>
                                <p class="text-xs text-white/80 font-semibold tracking-wider uppercase mt-1">Kepala Bagian Organisasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    {{-- ═══ MEGA FOOTER (Dari Welcome) ═══ --}}
    <footer class="bg-[#0f172a] text-white pt-20 pb-10 relative overflow-hidden mt-auto">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                {{-- Brand Column --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shrink-0">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-full h-auto">
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold text-brand-400 tracking-widest uppercase">Pemko Padang</span>
                            <span class="block text-base font-extrabold text-white leading-tight">BAGIAN ORGANISASI</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 font-medium leading-relaxed mb-6">
                        Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik.
                    </p>
                </div>
                {{-- Tautan Cepat --}}
                <div>
                    <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i class="ph-fill ph-link text-brand-500"></i> Tautan Cepat</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors">Profil Organisasi</a></li>
                        <li><a href="#" class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors">Layanan Publik</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500 font-medium">
                    &copy; {{ date('Y') }} Bagian Organisasi Setda Kota Padang. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
