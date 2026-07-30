<x-public-layout :title="'Reformasi Birokrasi'" :metaDescription="'Indeks Reformasi Birokrasi dan capaian SAKIP Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Reformasi Birokrasi</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Reformasi Birokrasi</span>
        </nav>
    </section>

    {{-- HERO BANNER --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-slate-800 rounded-[2.5rem] p-10 lg:p-16 text-white overflow-hidden">
                {{-- Decorative --}}
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4 pointer-events-none">
                    <i class="ph-duotone ph-chart-line-up text-[20rem]"></i>
                </div>
                <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span> Fokus Utama
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black mb-4 leading-tight tracking-tight">Indeks Reformasi<br>Birokrasi</h2>
                    <p class="text-gray-300 font-medium leading-relaxed text-sm lg:text-base opacity-90 max-w-lg">
                        Mewujudkan pemerintahan yang bersih, akuntabel, dan kapabel melalui pengawasan tata kelola yang efektif dan efisien untuk Kota Padang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- INDEKS RB --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <h3 class="text-xl font-black text-[#1a202c] mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                    <i class="ph-bold ph-trend-up text-xl"></i>
                </div>
                Capaian Indeks RB per Tahun
            </h3>

            @if($indeksRb->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($indeksRb as $item)
                        <div class="group bg-white rounded-[2rem] p-6 lg:p-8 shadow-[0_4px_25px_rgb(0,0,0,0.03)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full -translate-y-1/2 translate-x-1/2 opacity-60 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <span class="text-[11px] font-bold text-blue-500 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Tahun {{ $item->year }}</span>
                                <div class="mt-5 mb-3">
                                    <span class="text-4xl font-black text-[#1a202c]">{{ number_format($item->score, 2) }}</span>
                                </div>
                                @if($item->predicate)
                                    <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                                        <i class="ph-fill ph-seal-check"></i> Predikat: {{ $item->predicate }}
                                    </span>
                                @endif
                                <p class="text-xs text-gray-500 font-medium mt-3 leading-relaxed">{{ $item->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2rem] p-12 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-chart-line-up text-4xl text-gray-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-400 mb-2">Belum Ada Data</h4>
                    <p class="text-sm text-gray-400 font-medium">Data Indeks RB akan ditampilkan setelah diinput oleh admin.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- SAKIP --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <h3 class="text-xl font-black text-[#1a202c] mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                    <i class="ph-bold ph-medal text-xl"></i>
                </div>
                Capaian SAKIP
            </h3>

            @if($sakip->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($sakip as $item)
                        <div class="group bg-white rounded-[2rem] p-6 lg:p-8 shadow-[0_4px_25px_rgb(0,0,0,0.03)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-full -translate-y-1/2 translate-x-1/2 opacity-60 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <span class="text-[11px] font-bold text-emerald-500 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-lg">Tahun {{ $item->year }}</span>
                                <div class="mt-5 mb-3">
                                    <span class="text-4xl font-black text-[#1a202c]">{{ number_format($item->score, 2) }}</span>
                                </div>
                                @if($item->predicate)
                                    <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                                        <i class="ph-fill ph-seal-check"></i> {{ $item->predicate }}
                                    </span>
                                @endif
                                <p class="text-xs text-gray-500 font-medium mt-3 leading-relaxed">{{ $item->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2rem] p-12 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-medal text-4xl text-gray-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-400 mb-2">Belum Ada Data</h4>
                    <p class="text-sm text-gray-400 font-medium">Data SAKIP akan ditampilkan setelah diinput oleh admin.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- DOKUMEN TERKAIT --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <h3 class="text-xl font-black text-[#1a202c] mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                    <i class="ph-bold ph-file-pdf text-xl"></i>
                </div>
                Dokumen Terkait
            </h3>

            @if($documents->count() > 0)
                <div class="space-y-3">
                    @foreach($documents as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                           class="group flex items-center gap-4 lg:gap-6 bg-white p-5 lg:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-brand-200 transition-all duration-300">
                            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="ph-fill ph-file-pdf text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm lg:text-base font-bold text-[#1a202c] group-hover:text-brand-500 transition-colors truncate">{{ $doc->title }}</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    @if($doc->year)<span class="text-xs text-gray-400 font-medium">{{ $doc->year }}</span>@endif
                                    @if($doc->file_size)<span class="text-xs text-gray-400 font-medium">{{ number_format($doc->file_size / 1024 / 1024, 1) }} MB</span>@endif
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                                <i class="ph-bold ph-download-simple"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2rem] p-10 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-16 h-16 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="ph-duotone ph-file-pdf text-3xl text-gray-300"></i>
                    </div>
                    <p class="text-sm text-gray-400 font-medium">Belum ada dokumen yang diunggah.</p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
