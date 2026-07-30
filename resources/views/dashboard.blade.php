<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Dashboard Overview
        </h2>
    </x-slot>

    <div class="space-y-6">
        
        {{-- Welcome Card --}}
        <div class="bg-gradient-to-r from-brand-600 to-brand-500 rounded-[2rem] p-8 lg:p-12 text-white shadow-xl shadow-brand-500/20 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-white/10 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h3 class="text-3xl font-black mb-2">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
                    <p class="text-brand-100 text-sm max-w-xl leading-relaxed">
                        Anda masuk sebagai Administrator. Melalui panel ini, Anda dapat mengelola seluruh konten publikasi, memperbarui informasi profil pegawai, dan memantau layanan Bagian Organisasi.
                    </p>
                </div>
                <div class="hidden lg:block shrink-0">
                    <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center border border-white/20 backdrop-blur-md shadow-2xl">
                        <i class="ph-fill ph-shield-check text-6xl text-white drop-shadow-md"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Grid Utama --}}
        <h3 class="font-bold text-gray-800 text-lg">Informasi Utama</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center">
                    <i class="ph-bold ph-users text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">{{ number_format($pegawaiCount) }}</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Total Pegawai</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                    <i class="ph-bold ph-article text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">{{ number_format($beritaCount) }}</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Berita Diterbitkan</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center">
                    <i class="ph-bold ph-scales text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">{{ number_format($regulasiCount) }}</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Regulasi Aktif</span>
                </div>
            </div>
        </div>

        {{-- Stats Grid Tambahan --}}
        <h3 class="font-bold text-gray-800 text-lg pt-4 border-t border-gray-100">Statistik Konten & Layanan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                    <i class="ph-bold ph-megaphone text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900">{{ number_format($pengumumanCount) }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Pengumuman</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center">
                    <i class="ph-bold ph-handshake text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900">{{ number_format($layananCount) }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Layanan Publik</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center">
                    <i class="ph-bold ph-question text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900">{{ number_format($faqCount) }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Total FAQ</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                    <i class="ph-bold ph-image text-xl"></i>
                </div>
                <div>
                    <span class="block text-2xl font-black text-gray-900">{{ number_format($bannerCount) }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Banner Aktif</span>
                </div>
            </div>
        </div>

        {{-- Statistik Grafik --}}
        <h3 class="font-bold text-gray-800 text-lg pt-4 border-t border-gray-100">Grafik Aktivitas</h3>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div id="activityChart"></div>
        </div>

        {{-- Quick Actions --}}
        <h3 class="font-bold text-gray-800 text-lg pt-4 border-t border-gray-100">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('posts.create') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] hover:shadow-lg hover:border-brand-100 transition-all flex flex-col items-center justify-center text-center gap-3">
                <div class="w-12 h-12 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center group-hover:bg-brand-500 group-hover:text-white transition-colors">
                    <i class="ph-bold ph-pencil-simple text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Tulis Berita Baru</h4>
                    <p class="text-xs text-gray-500 mt-1">Buat publikasi berita terbaru</p>
                </div>
            </a>

            <a href="{{ route('announcements.create') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] hover:shadow-lg hover:border-purple-100 transition-all flex flex-col items-center justify-center text-center gap-3">
                <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition-colors">
                    <i class="ph-bold ph-megaphone text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Buat Pengumuman</h4>
                    <p class="text-xs text-gray-500 mt-1">Publikasikan info penting</p>
                </div>
            </a>

            <a href="{{ route('banners.create') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] hover:shadow-lg hover:border-indigo-100 transition-all flex flex-col items-center justify-center text-center gap-3">
                <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                    <i class="ph-bold ph-image text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Upload Banner</h4>
                    <p class="text-xs text-gray-500 mt-1">Ganti slider halaman utama</p>
                </div>
            </a>
        </div>
        
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    height: 350,
                    toolbar: { show: false },
                    fontFamily: 'inherit'
                },
                colors: ['#0d9488', '#f5a500'], // Teal and Orange
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: false },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                },
                theme: { mode: 'light' }
            };

            var chart = new ApexCharts(document.querySelector("#activityChart"), options);
            chart.render();
        });
    </script>
    @endpush
</x-app-layout>
