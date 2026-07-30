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

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center">
                    <i class="ph-bold ph-users text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">42</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Total Pegawai</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                    <i class="ph-bold ph-article text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">128</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Berita Diterbitkan</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] flex items-center gap-5 hover:-translate-y-1 transition-transform">
                <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center">
                    <i class="ph-bold ph-files text-2xl"></i>
                </div>
                <div>
                    <span class="block text-3xl font-black text-gray-900">56</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Regulasi Aktif</span>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
