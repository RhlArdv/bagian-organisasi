<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                Overview
            </h2>
            <div class="flex items-center gap-2 text-sm font-medium text-gray-500">
                <i class="ph-bold ph-calendar-blank"></i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Bento Grid Container -->
    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-12 gap-6 pb-12">
        
        <!-- Welcome Bento (Span 8) -->
        <div class="lg:col-span-8 group relative overflow-hidden bg-gray-900 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl shadow-gray-900/20">
            <!-- Animated Background Glows -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-500/30 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 group-hover:bg-brand-500/40 transition-colors duration-700"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-indigo-500/20 rounded-full blur-[80px] translate-y-1/3 -translate-x-1/3"></div>
            
            <div class="relative z-10 flex flex-col justify-between h-full min-h-[160px]">
                <div>
                    <h3 class="text-3xl lg:text-4xl font-black text-white tracking-tight mb-3">Selamat datang, {{ Auth::user()->name }}</h3>
                    <p class="text-gray-300 text-sm lg:text-base max-w-xl leading-relaxed font-medium">
                        Kelola seluruh konten publikasi, pantau layanan, dan perbarui informasi organisasi melalui satu panel kendali yang terpusat.
                    </p>
                </div>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-full font-semibold text-sm backdrop-blur-md transition-all border border-white/10">
                        <i class="ph-bold ph-pencil-simple text-lg"></i>
                        Tulis Berita
                    </a>
                    <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-400 text-white px-5 py-2.5 rounded-full font-semibold text-sm shadow-lg shadow-brand-500/30 transition-all border border-brand-400/50">
                        <i class="ph-bold ph-users text-lg"></i>
                        Kelola Pegawai
                    </a>
                </div>
            </div>
            
            <!-- Graphic element -->
            <div class="absolute -bottom-6 -right-6 text-white/5 pointer-events-none transform group-hover:scale-105 transition-transform duration-700">
                <i class="ph-fill ph-circles-four text-[250px]"></i>
            </div>
        </div>

        <!-- Pegawai Stat (Span 4) -->
        <div class="lg:col-span-4 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col justify-between relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 cursor-default">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-50 to-brand-100/50 text-brand-600 flex items-center justify-center border border-brand-100/50">
                    <i class="ph-fill ph-users-three text-2xl"></i>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-full">
                        <i class="ph-bold ph-trend-up"></i> Aktif
                    </span>
                </div>
            </div>
            <div>
                <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Total Pegawai</span>
                <span class="block text-5xl font-black text-gray-900 tracking-tighter">{{ number_format($pegawaiCount) }}</span>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-brand-50/50 rounded-full blur-2xl group-hover:bg-brand-100 transition-colors duration-500"></div>
        </div>

        <!-- Berita & Regulasi (Span 3 x 2) -->
        <div class="lg:col-span-3 bg-brand-500 rounded-[2.5rem] p-8 text-white shadow-xl shadow-brand-500/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 cursor-default">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative z-10 flex flex-col h-full justify-between min-h-[160px]">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm text-white flex items-center justify-center mb-6">
                    <i class="ph-fill ph-newspaper text-xl"></i>
                </div>
                <div>
                    <span class="block text-[10px] font-extrabold text-brand-100 uppercase tracking-widest mb-1">Berita Diterbitkan</span>
                    <span class="block text-4xl font-black tracking-tighter">{{ number_format($beritaCount) }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 cursor-default min-h-[160px]">
            <div class="flex flex-col h-full justify-between">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center mb-6 border border-blue-100/50">
                    <i class="ph-fill ph-scales text-xl"></i>
                </div>
                <div>
                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Regulasi Aktif</span>
                    <span class="block text-4xl font-black text-gray-900 tracking-tighter">{{ number_format($regulasiCount) }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Mini Bento (Span 6) -->
        <div class="lg:col-span-6 bg-white rounded-[2.5rem] p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] min-h-[160px]">
            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">Aksi Cepat</h4>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <a href="{{ route('announcements.create') }}" class="group flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-brand-50 hover:text-brand-600 transition-all text-center h-full">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 group-hover:text-brand-500 group-hover:scale-110 transition-all duration-300 mb-2">
                        <i class="ph-bold ph-megaphone text-lg"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-600 group-hover:text-brand-600">Pengumuman</span>
                </a>
                <a href="{{ route('banners.create') }}" class="group flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-purple-50 hover:text-purple-600 transition-all text-center h-full">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 group-hover:text-purple-500 group-hover:scale-110 transition-all duration-300 mb-2">
                        <i class="ph-bold ph-image text-lg"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-600 group-hover:text-purple-600">Banner</span>
                </a>
                <a href="{{ route('pegawai.create') }}" class="group flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 hover:text-green-600 transition-all text-center h-full">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 group-hover:text-green-500 group-hover:scale-110 transition-all duration-300 mb-2">
                        <i class="ph-bold ph-user-plus text-lg"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-600 group-hover:text-green-600">Pegawai</span>
                </a>
                <a href="{{ route('agendas.create') }}" class="group flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-rose-50 hover:text-rose-600 transition-all text-center h-full">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 group-hover:text-rose-500 group-hover:scale-110 transition-all duration-300 mb-2">
                        <i class="ph-bold ph-calendar-plus text-lg"></i>
                    </div>
                    <span class="text-[11px] font-bold text-gray-600 group-hover:text-rose-600">Agenda</span>
                </a>
            </div>
        </div>

        <!-- Micro Stats (Span 12) -->
        <div class="lg:col-span-12 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-4 hover:shadow-lg transition-all duration-300 group cursor-default">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center border border-purple-100/50 group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-speaker-hifi text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($pengumumanCount) }}</span>
                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mt-0.5">Pengumuman</span>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-4 hover:shadow-lg transition-all duration-300 group cursor-default">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center border border-rose-100/50 group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-handshake text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($layananCount) }}</span>
                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mt-0.5">Layanan Publik</span>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-4 hover:shadow-lg transition-all duration-300 group cursor-default">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center border border-teal-100/50 group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-question text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($faqCount) }}</span>
                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mt-0.5">Total FAQ</span>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-4 hover:shadow-lg transition-all duration-300 group cursor-default">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center border border-amber-100/50 group-hover:scale-110 transition-transform">
                    <i class="ph-fill ph-image text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($bannerCount) }}</span>
                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mt-0.5">Banner Aktif</span>
                </div>
            </div>
        </div>

        <!-- Chart Bento (Span 12) -->
        <div class="lg:col-span-12 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">Aktivitas & Publikasi</h3>
                    <p class="text-xs font-semibold text-gray-400">Statistik tren 6 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-brand-50 text-brand-600 text-[10px] font-bold">
                        <span class="w-2 h-2 rounded-full bg-brand-500"></span> Berita
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Regulasi
                    </span>
                </div>
            </div>
            <div class="relative min-h-[300px]">
                <div id="activityChart"></div>
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
                    height: 320,
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
