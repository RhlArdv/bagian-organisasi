<x-public-layout :title="$metaInfo['title'] . ' — Regulasi Kota Padang'" :metaDescription="$metaInfo['description']">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">{{ $metaInfo['title'] }}</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500 flex-wrap">
            <a href="/" class="hover:text-red-600 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <a href="{{ route('public.regulasi') }}" class="hover:text-red-600 transition-colors text-gray-500">Regulasi</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-red-600 font-bold">{{ $kategori->name }}</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-12">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border overflow-hidden" style="border: 1px solid #fecaca;">
                <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full opacity-50 pointer-events-none" style="background-color: #fef2f2;"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill {{ $metaInfo['icon'] ?? 'ph-scales' }} text-[16rem]" style="color: #dc2626;"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0 shadow-sm" style="background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                        <i class="ph-bold {{ $metaInfo['icon'] ?? 'ph-scales' }} text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider mb-3" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;">
                            <i class="ph-bold ph-folder-notch text-red-600"></i>
                            <span>{{ $metaInfo['subtitle'] }}</span>
                        </div>
                        <h2 class="text-2xl lg:text-3xl font-black mb-3 tracking-tight" style="color: #7f1d1d;">{{ $metaInfo['title'] }}</h2>
                        <p class="text-gray-700 font-medium leading-relaxed max-w-3xl">
                            {{ $metaInfo['description'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR DOKUMEN DENGAN FILTER TAHUN & PENCARIAN --}}
    <section class="mb-16">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-100">
                <h3 class="text-xl font-black flex items-center gap-3 shrink-0" style="color: #7f1d1d;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                        <i class="ph-bold ph-file-text text-xl"></i>
                    </div>
                    <span>Daftar Dokumen {{ $kategori->name }}</span>
                </h3>

                {{-- FILTER & SEARCH BAR --}}
                <form action="{{ route('public.regulasi.sub', $kategori->slug) }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3 sm:gap-3.5">
                    {{-- Search Input --}}
                    <div class="flex items-center bg-white rounded-xl shadow-sm px-3.5 py-2 w-full sm:w-64 shrink-0" style="border: 1px solid #cbd5e1;">
                        <i class="ph-bold ph-magnifying-glass text-gray-400 text-sm mr-2.5 shrink-0"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / nomor aturan..." 
                               class="w-full bg-transparent border-0 p-0 text-xs font-bold text-gray-800 focus:outline-none focus:ring-0 placeholder-gray-400" style="outline: none; border: none; background: transparent; width: 100%;">
                    </div>

                    {{-- Select Tahun --}}
                    <div class="flex items-center rounded-xl shadow-sm px-3.5 py-2 w-44 shrink-0 cursor-pointer" style="background-color: #fef2f2; border: 1px solid #fca5a5;">
                        <i class="ph-bold ph-calendar-blank text-sm mr-2 shrink-0 pointer-events-none" style="color: #dc2626;"></i>
                        <select name="year" onchange="this.form.submit()" 
                                class="w-full bg-transparent border-0 p-0 text-xs font-black focus:outline-none focus:ring-0 appearance-none cursor-pointer pr-3" style="color: #991b1b; outline: none; border: none; background: transparent; width: 100%;">
                            <option value="all">Semua Tahun</option>
                            @if(isset($years) && $years->count() > 0)
                                @foreach($years as $yr)
                                    <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                                @endforeach
                            @endif
                        </select>
                        <i class="ph-bold ph-caret-down text-xs ml-1 shrink-0 pointer-events-none" style="color: #dc2626;"></i>
                    </div>

                    {{-- Tombol Cari --}}
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-black shadow-sm transition-all hover:opacity-90 flex items-center justify-center gap-1.5 shrink-0" style="background-color: #dc2626; color: #ffffff;">
                        <i class="ph-bold ph-magnifying-glass text-xs"></i>
                        <span>Cari</span>
                    </button>

                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <a href="{{ route('public.regulasi.sub', $kategori->slug) }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 border border-gray-200 transition-colors flex items-center justify-center gap-1 shrink-0" title="Reset Filter">
                            <i class="ph-bold ph-arrow-counter-clockwise text-xs"></i>
                            <span>Reset</span>
                        </a>
                    @endif
                </form>
            </div>

            @if($documents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($documents as $doc)
                        <div class="group rounded-[2rem] p-7 lg:p-8 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #fecaca; box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);">
                            {{-- Aksen Dekoratif Atas --}}
                            <div class="absolute top-0 left-0 right-0 h-2" style="background: linear-gradient(90deg, #dc2626 0%, #f87171 100%);"></div>

                            <div>
                                {{-- Icon & Tag --}}
                                <div class="flex items-center justify-between gap-4 mb-6 pt-2 relative z-10">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-sm" style="background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626;">
                                        <i class="ph-bold ph-file-pdf"></i>
                                    </div>
                                    <div class="flex flex-col items-end gap-1.5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black tracking-wide shadow-sm" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;">
                                            <i class="ph-fill ph-scales text-red-600"></i> {{ $kategori->name }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            @if($doc->year)
                                                <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-gray-500 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">
                                                    <i class="ph-bold ph-calendar"></i> Tahun {{ $doc->year }}
                                                </span>
                                            @endif
                                            @if($doc->file_size)
                                                <span class="text-[11px] font-bold text-gray-400">{{ number_format($doc->file_size / 1024 / 1024, 1) }} MB</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Judul & Deskripsi --}}
                                <h4 class="text-lg lg:text-xl font-black transition-colors duration-200 mb-3 leading-snug relative z-10" style="color: #0f172a;">
                                    <a href="{{ route('public.dokumen.show', $doc->id) }}" class="hover:text-red-700 focus:outline-none block">
                                        {{ $doc->title }}
                                    </a>
                                </h4>
                                @if($doc->document_number)
                                    <div class="mb-3">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-black text-gray-700 bg-gray-100 px-3 py-1.5 rounded-xl border border-gray-200 shadow-xs">
                                            <i class="ph-bold ph-hash text-red-600"></i> {{ $doc->document_number }}
                                        </span>
                                    </div>
                                @endif
                                <p class="text-sm font-medium line-clamp-3 leading-relaxed mb-6 relative z-10" style="color: #334155;">
                                    {{ $doc->description ?: '-' }}
                                </p>
                            </div>

                            {{-- Footer Kartu (Metadata & Tombol Detail) --}}
                            <div class="pt-5 flex items-center justify-between mt-auto relative z-10 gap-2" style="border-top: 1px solid #e2e8f0;">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-400">
                                    <i class="ph-bold ph-download-simple text-sm text-red-500"></i>
                                    <span>{{ $doc->download_count ?? 0 }} diunduh</span>
                                </div>
                                <a href="{{ route('public.dokumen.show', $doc->id) }}" 
                                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md hover:opacity-90 transition-all duration-300 shrink-0" style="background-color: #dc2626; color: #ffffff;">
                                    <span>Lihat Detail</span>
                                    <i class="ph-bold ph-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-sm" style="border: 1px solid #fecaca;">
                    <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6" style="background-color: #fef2f2; border: 1px solid #fecaca;">
                        <i class="ph-duotone ph-file-text text-5xl" style="color: #dc2626;"></i>
                    </div>
                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <h4 class="text-xl font-black text-gray-700 mb-2">Tidak Ada Dokumen Ditemukan</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto mb-6">Tidak ada dokumen regulasi {{ $kategori->name }} yang sesuai dengan kata kunci pencarian atau filter tahun yang dipilih.</p>
                        <a href="{{ route('public.regulasi.sub', $kategori->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md transition-all duration-300 hover:opacity-90" style="background-color: #dc2626; color: #ffffff;">
                            <i class="ph-bold ph-arrow-counter-clockwise"></i> Reset Filter
                        </a>
                    @else
                        <h4 class="text-xl font-black text-gray-700 mb-2">Belum Ada Dokumen {{ $kategori->name }}</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto">Dokumen peraturan dan regulasi {{ $kategori->name }} akan segera diunggah oleh administrator.</p>
                    @endif
                </div>
            @endif

        </div>
    </section>

</x-public-layout>
