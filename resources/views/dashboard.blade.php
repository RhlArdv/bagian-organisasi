<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-extrabold text-xl sm:text-2xl text-gray-900 tracking-tight">
                Dashboard Overview
            </h2>
            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-white border border-gray-200 rounded-full text-[11px] font-bold text-gray-500 shadow-sm">
                <i class="ph-bold ph-calendar-blank text-brand-500"></i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Master Grid -->
    <div class="max-w-7xl mx-auto pb-12 space-y-6">
        
        <!-- Top Row: Welcome & Main Stat -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Welcome Banner -->
            <div class="lg:col-span-2 relative overflow-hidden bg-white rounded-[2rem] p-8 lg:p-10 border border-gray-100 shadow-[0_2px_20px_rgb(0,0,0,0.02)] group">
                <div class="absolute inset-0 bg-gradient-to-br from-brand-50/80 via-white to-blue-50/50"></div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl group-hover:bg-brand-500/20 transition-colors duration-700"></div>
                <div class="absolute bottom-0 right-0 p-6 opacity-5 transform translate-x-1/4 translate-y-1/4 group-hover:scale-105 transition-transform duration-700">
                    <i class="ph-fill ph-shapes text-[200px] text-brand-900"></i>
                </div>
                
                <div class="relative z-10 flex flex-col h-full justify-center">
                    <span class="inline-block px-3 py-1 bg-brand-100 text-brand-700 text-[10px] font-extrabold uppercase tracking-widest rounded-full w-fit mb-4">
                        Control Panel
                    </span>
                    <h3 class="text-3xl lg:text-4xl font-black text-gray-900 tracking-tight mb-3">
                        Selamat datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-blue-600">{{ Auth::user()->name }}</span>
                    </h3>
                    <p class="text-gray-500 text-sm max-w-lg leading-relaxed font-medium mb-8">
                        Kelola seluruh konten publikasi, pantau layanan, dan perbarui informasi organisasi dari satu panel terpusat yang dirancang untuk produktivitas Anda.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-brand-500/30 transition-all active:scale-95">
                            <i class="ph-bold ph-pencil-simple text-lg"></i>
                            Tulis Berita
                        </a>
                        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm transition-all active:scale-95">
                            <i class="ph-bold ph-users text-lg"></i>
                            Kelola Pegawai
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Pegawai Highlight -->
            <div class="bg-gradient-to-b from-gray-900 to-gray-800 rounded-[2rem] p-8 border border-gray-800 shadow-[0_10px_40px_rgb(0,0,0,0.1)] flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 group-hover:bg-white/10 transition-colors duration-500"></div>
                <div class="relative z-10 flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-xl bg-white/10 text-white flex items-center justify-center backdrop-blur-md border border-white/10">
                        <i class="ph-fill ph-users-three text-xl"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-green-400 bg-green-400/10 border border-green-400/20 px-2.5 py-1 rounded-full">
                        <i class="ph-bold ph-trend-up"></i> Data Aktif
                    </span>
                </div>
                <div class="relative z-10 mt-auto">
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pegawai</span>
                    <span class="block text-6xl font-black text-white tracking-tighter">{{ number_format($pegawaiCount) }}</span>
                </div>
            </div>
        </div>

        <!-- Middle Row: 3 Core Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Berita -->
            <div class="bg-white rounded-[2rem] p-6 sm:p-8 border border-gray-100 shadow-[0_2px_20px_rgb(0,0,0,0.02)] flex items-center gap-6 group hover:border-blue-100 hover:shadow-blue-500/5 transition-all cursor-default">
                <div class="w-16 h-16 shrink-0 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <i class="ph-fill ph-newspaper text-3xl"></i>
                </div>
                <div>
                    <span class="block text-4xl font-black text-gray-900 tracking-tighter mb-1">{{ number_format($beritaCount) }}</span>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Berita<br>Diterbitkan</span>
                </div>
            </div>
            
            <!-- Regulasi -->
            <div class="bg-white rounded-[2rem] p-6 sm:p-8 border border-gray-100 shadow-[0_2px_20px_rgb(0,0,0,0.02)] flex items-center gap-6 group hover:border-amber-100 hover:shadow-amber-500/5 transition-all cursor-default">
                <div class="w-16 h-16 shrink-0 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                    <i class="ph-fill ph-scales text-3xl"></i>
                </div>
                <div>
                    <span class="block text-4xl font-black text-gray-900 tracking-tighter mb-1">{{ number_format($regulasiCount) }}</span>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Regulasi<br>Aktif</span>
                </div>
            </div>

            <!-- Pengumuman -->
            <div class="bg-white rounded-[2rem] p-6 sm:p-8 border border-gray-100 shadow-[0_2px_20px_rgb(0,0,0,0.02)] flex items-center gap-6 group hover:border-purple-100 hover:shadow-purple-500/5 transition-all cursor-default">
                <div class="w-16 h-16 shrink-0 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <i class="ph-fill ph-megaphone text-3xl"></i>
                </div>
                <div>
                    <span class="block text-4xl font-black text-gray-900 tracking-tighter mb-1">{{ number_format($pengumumanCount) }}</span>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Pengumuman<br>Publik</span>
                </div>
            </div>
        </div>

        <!-- Bottom Row: Minor Stats & Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Micro stats (Span 1) -->
            <div class="lg:col-span-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between group cursor-default hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center">
                            <i class="ph-fill ph-handshake text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Layanan</span>
                    </div>
                    <span class="text-xl font-black text-gray-900">{{ number_format($layananCount) }}</span>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between group cursor-default hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center">
                            <i class="ph-fill ph-question text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total FAQ</span>
                    </div>
                    <span class="text-xl font-black text-gray-900">{{ number_format($faqCount) }}</span>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between group cursor-default hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <i class="ph-fill ph-image text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Banner</span>
                    </div>
                    <span class="text-xl font-black text-gray-900">{{ number_format($bannerCount) }}</span>
                </div>
            </div>

            <!-- Chart (Span 2) -->
            <div class="lg:col-span-2 bg-white rounded-[2rem] p-6 sm:p-8 border border-gray-100 shadow-[0_2px_20px_rgb(0,0,0,0.02)]">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="font-black text-gray-900 text-lg">Aktivitas & Publikasi</h3>
                        <p class="text-xs font-medium text-gray-500 mt-1">Statistik tren 6 bulan terakhir</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-50 text-gray-600 text-[10px] font-bold border border-gray-100">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span> Berita
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-50 text-gray-600 text-[10px] font-bold border border-gray-100">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Regulasi
                        </span>
                    </div>
                </div>
                <div class="relative w-full h-[250px]">
                    <div id="activityChart"></div>
                </div>
            </div>
        </div>
        
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" integrity="sha384-mJV8BBub153uq3sC/2rRR776669na79SoJgVgRO94Oc20Prl7DiRwRXTfiVt83j8" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [{
                    name: 'Publikasi Berita',
                    data: [12, 19, 15, 25, 22, 30]
                }, {
                    name: 'Dokumen Regulasi',
                    data: [7, 11, 8, 15, 13, 22]
                }],
                chart: {
                    type: 'area',
                    height: 250,
                    toolbar: { show: false },
                    fontFamily: 'inherit',
                    parentHeightOffset: 0,
                    sparkline: {
                        enabled: false
                    }
                },
                colors: ['#0d9488', '#f59e0b'], // Brand Teal and Amber
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: { 
                    curve: 'smooth', 
                    width: [3, 3],
                    lineCap: 'round'
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: {
                            colors: '#94a3b8',
                            fontSize: '11px',
                            fontWeight: 600
                        }
                    },
                    crosshairs: {
                        stroke: {
                            color: '#e2e8f0',
                            width: 1,
                            dashArray: 3
                        }
                    }
                },
                yaxis: { 
                    show: true,
                    labels: {
                        style: {
                            colors: '#94a3b8',
                            fontSize: '11px',
                            fontWeight: 600
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: { show: true }
                    },
                    yaxis: {
                        lines: { show: true }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 15
                    }
                },
                legend: {
                    show: false
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function (val) {
                            return val + " Dokumen"
                        }
                    },
                    style: {
                        fontSize: '12px',
                        fontFamily: 'inherit'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#activityChart"), options);
            chart.render();
        });
    </script>
    @endpush
</x-app-layout>
