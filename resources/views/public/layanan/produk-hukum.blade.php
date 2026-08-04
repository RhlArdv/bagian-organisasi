<x-public-layout :title="'Produk Hukum — Penataan Kelembagaan'" :metaDescription="'Regulasi, Peraturan Daerah, Peraturan Wali Kota, dan Produk Hukum kelembagaan Pemerintah Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black tracking-tight mb-2" style="color: #047857;">Produk Hukum & Regulasi</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-emerald-700 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <a href="{{ route('public.kelembagaan') }}" class="hover:text-emerald-700 transition-colors text-gray-500">Kelembagaan</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Produk Hukum</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden" style="border: 1px solid #cbd5e1;">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-emerald-50 rounded-full opacity-50 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-scales text-[16rem]" style="color: #059669;"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="ph-bold ph-scales text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black mb-3 tracking-tight" style="color: #047857;">Produk Hukum Kelembagaan</h2>
                        <p class="text-gray-700 font-medium leading-relaxed max-w-2xl">
                            Kumpulan regulasi, Peraturan Daerah (Perda), Peraturan Wali Kota (Perwako), dan surat keputusan terkait kedudukan, susunan organisasi, tugas dan fungsi, serta tata kerja Perangkat Daerah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR PRODUK HUKUM DENGAN FILTER TAHUN & PENCARIAN --}}
    <section class="mb-16">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                <h3 class="text-xl font-black flex items-center gap-3" style="color: #047857;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="ph-bold ph-file-text text-xl"></i>
                    </div>
                    <span>Daftar Produk Hukum & Regulasi</span>
                </h3>

                {{-- FILTER & SEARCH BAR --}}
                <form action="{{ route('public.produk-hukum') }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full lg:w-auto">
                    {{-- Search Input --}}
                    <div class="relative flex-1 sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / nomor regulasi..." 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl text-xs font-bold bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 shadow-sm transition-all text-gray-800">
                        <i class="ph-bold ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>

                    {{-- Select Tahun --}}
                    <div class="relative w-40 shrink-0">
                        <select name="year" onchange="this.form.submit()" 
                                class="w-full pl-9 pr-8 py-2.5 rounded-xl text-xs font-black shadow-sm appearance-none cursor-pointer transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500/30" style="color: #047857; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <option value="all">Semua Tahun</option>
                            @if(isset($years) && $years->count() > 0)
                                @foreach($years as $yr)
                                    <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                                @endforeach
                            @endif
                        </select>
                        <i class="ph-bold ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-emerald-600 text-sm pointer-events-none"></i>
                        <i class="ph-bold ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-emerald-600 text-xs pointer-events-none"></i>
                    </div>

                    {{-- Tombol Filter --}}
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-black shadow-sm transition-all hover:opacity-90 shrink-0 flex items-center gap-1.5" style="background-color: #059669; color: #ffffff;">
                        <i class="ph-bold ph-funnel-simple text-sm"></i>
                        <span>Filter</span>
                    </button>

                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <a href="{{ route('public.produk-hukum') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors shrink-0 flex items-center gap-1" title="Reset Filter">
                            <i class="ph-bold ph-arrow-counter-clockwise"></i>
                            <span>Reset</span>
                        </a>
                    @endif
                </form>
            </div>

            @if($documents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($documents as $doc)
                        <div class="group rounded-[2rem] p-7 lg:p-8 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);">
                            {{-- Aksen Dekoratif Atas --}}
                            <div class="absolute top-0 left-0 right-0 h-2" style="background: linear-gradient(90deg, #059669 0%, #34d399 100%);"></div>

                            <div>
                                {{-- Icon & Tag --}}
                                <div class="flex items-center justify-between gap-4 mb-6 pt-2 relative z-10">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-sm" style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #059669;">
                                        <i class="ph-bold ph-scales"></i>
                                    </div>
                                    <div class="flex flex-col items-end gap-1">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black tracking-wide shadow-sm" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                                            <i class="ph-fill ph-check-circle text-emerald-600"></i> Produk Hukum
                                        </span>
                                        @if($doc->year)
                                            <span class="text-[11px] font-extrabold text-gray-400">Tahun {{ $doc->year }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Judul & Deskripsi --}}
                                <h4 class="text-lg lg:text-xl font-black transition-colors duration-200 mb-3 leading-snug relative z-10" style="color: #0f172a;">
                                    <a href="{{ route('public.dokumen.show', $doc->id) }}" class="hover:text-emerald-700 focus:outline-none block">
                                        {{ $doc->title }}
                                    </a>
                                </h4>
                                <p class="text-sm font-medium line-clamp-3 leading-relaxed mb-8 relative z-10" style="color: #334155;">
                                    {{ $doc->description ?: '-' }}
                                </p>
                            </div>

                            {{-- Footer Kartu --}}
                            <div class="pt-5 flex items-center justify-end mt-auto relative z-10" style="border-top: 1px solid #e2e8f0;">
                                <a href="{{ route('public.dokumen.show', $doc->id) }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md hover:opacity-90 transition-all duration-300" style="background-color: #059669; color: #ffffff;">
                                    <span>Lihat Detail</span>
                                    <i class="ph-bold ph-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-sm border border-gray-200" style="border: 1px solid #cbd5e1;">
                    <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6" style="background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                        <i class="ph-duotone ph-scales text-5xl" style="color: #059669;"></i>
                    </div>
                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <h4 class="text-xl font-black text-gray-700 mb-2">Tidak Ada Produk Hukum Ditemukan</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto mb-6">Tidak ada Produk Hukum atau regulasi yang sesuai dengan kata kunci pencarian atau filter tahun yang dipilih.</p>
                        <a href="{{ route('public.produk-hukum') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md transition-all duration-300 hover:opacity-90" style="background-color: #059669; color: #ffffff;">
                            <i class="ph-bold ph-arrow-counter-clockwise"></i>
                            <span>Reset Pencarian</span>
                        </a>
                    @else
                        <h4 class="text-xl font-black text-gray-700 mb-2">Belum Ada Produk Hukum</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto">Data Produk Hukum dan regulasi akan ditampilkan sesuai database setelah diisi oleh admin.</p>
                    @endif
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
