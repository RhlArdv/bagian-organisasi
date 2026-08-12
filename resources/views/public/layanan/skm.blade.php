<x-public-layout :title="'Survei Kepuasan Masyarakat (SKM)'" :metaDescription="'Laporan hasil dan pengukuran Survei Kepuasan Masyarakat atas pelayanan publik di lingkungan Bagian Organisasi Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black tracking-tight mb-2" style="color: #047857;">Survei Kepuasan Masyarakat</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-emerald-700 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Survei Kepuasan Masyarakat</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden" style="border: 1px solid #cbd5e1;">
                <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full opacity-50 pointer-events-none" style="background-color: #ecfdf5;"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-chart-line-up text-[16rem]" style="color: #059669;"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                    <div class="flex items-start gap-6 max-w-2xl">
                        <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                            <i class="ph-bold ph-smiley text-4xl"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl lg:text-3xl font-black mb-3 tracking-tight" style="color: #047857;">Indeks & Laporan SKM</h2>
                            <p class="text-gray-700 font-medium leading-relaxed">
                                Pengukuran dan analisis berkala atas tingkat kepuasan masyarakat terhadap layanan publik Bagian Organisasi sebagai instrumen peningkatan kualitas layanan secara berkelanjutan.
                            </p>
                        </div>
                    </div>

                    {{-- ONLINE SURVEY CTA --}}
                    <div class="w-full lg:w-auto p-6 rounded-3xl shadow-lg shrink-0 flex flex-col sm:flex-row lg:flex-col items-center justify-between gap-4 text-center sm:text-left lg:text-center relative overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #ffffff;">
                        <div>
                            <span class="text-[11px] font-extrabold uppercase tracking-wider block" style="color: #a7f3d0;">Partisipasi Publik</span>
                            <span class="text-base font-black block text-white mt-0.5">Isi Survei Digital Kami</span>
                        </div>
                        <a href="https://surveidigital.spbe.go.id/embed/survey/eyJzdXJ2ZXlfaWQiOjIsInNlcnZpY2VfaWQiOjkxNiwiaG9zdCI6Imh0dHBzOi8vYmFnb3JnYW5pc2FzaS5wYWRhbmcuZ28uaWQiLCJrZXkiOiJyWTc3Z1VOciJ9/embed/view/?jenis_layanan=Website" target="_blank" rel="noopener"
                           class="px-5 py-3 rounded-xl font-extrabold text-xs shadow-md hover:bg-emerald-50 transition-all text-emerald-800 bg-white inline-flex items-center gap-2">
                            <i class="ph-bold ph-paper-plane-tilt text-emerald-600 text-sm"></i>
                            <span>Buka Form Survei</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR DOKUMEN SKM DENGAN FILTER TAHUN & PENCARIAN --}}
    <section class="mb-16">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-100">
                <h3 class="text-xl font-black flex items-center gap-3 shrink-0" style="color: #047857;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="ph-bold ph-folder-simple text-xl"></i>
                    </div>
                    <span>Laporan Hasil SKM</span>
                </h3>

                {{-- FILTER & SEARCH BAR --}}
                <form action="{{ route('public.skm') }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3 sm:gap-3.5">
                    {{-- Search Input (Flexbox Wrapper) --}}
                    <div class="flex items-center bg-white rounded-xl shadow-sm px-3.5 py-2 w-full sm:w-64 shrink-0" style="border: 1px solid #cbd5e1;">
                        <i class="ph-bold ph-magnifying-glass text-gray-400 text-sm mr-2.5 shrink-0"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / nomor dokumen..." 
                               class="w-full bg-transparent border-0 p-0 text-xs font-bold text-gray-800 focus:outline-none focus:ring-0 placeholder-gray-400" style="outline: none; border: none; background: transparent; width: 100%;">
                    </div>

                    {{-- Select Tahun (Flexbox Wrapper) --}}
                    <div class="flex items-center rounded-xl shadow-sm px-3.5 py-2 w-44 shrink-0 cursor-pointer" style="background-color: #ecfdf5; border: 1px solid #6ee7b7;">
                        <i class="ph-bold ph-calendar-blank text-sm mr-2 shrink-0 pointer-events-none" style="color: #059669;"></i>
                        <select name="year" onchange="this.form.submit()" 
                                class="w-full bg-transparent border-0 p-0 text-xs font-black focus:outline-none focus:ring-0 appearance-none cursor-pointer pr-3" style="color: #047857; outline: none; border: none; background: transparent; width: 100%;">
                            <option value="all">Semua Tahun</option>
                            @if(isset($years) && $years->count() > 0)
                                @foreach($years as $yr)
                                    <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                                @endforeach
                            @endif
                        </select>
                        <i class="ph-bold ph-caret-down text-xs ml-1 shrink-0 pointer-events-none" style="color: #059669;"></i>
                    </div>

                    {{-- Tombol Cari --}}
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-black shadow-sm transition-all hover:opacity-90 flex items-center justify-center gap-1.5 shrink-0" style="background-color: #059669; color: #ffffff;">
                        <i class="ph-bold ph-magnifying-glass text-xs"></i>
                        <span>Cari</span>
                    </button>

                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <a href="{{ route('public.skm') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 border border-gray-200 transition-colors flex items-center justify-center gap-1 shrink-0" title="Reset Filter">
                            <i class="ph-bold ph-arrow-counter-clockwise text-xs"></i>
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
                                        <i class="ph-bold ph-smiley-winking"></i>
                                    </div>
                                    <div class="flex flex-col items-end gap-1">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black tracking-wide shadow-sm" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                                            <i class="ph-fill ph-check-circle text-emerald-600"></i> Laporan SKM
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
                        <i class="ph-duotone ph-chart-pie text-5xl" style="color: #059669;"></i>
                    </div>
                    @if(request()->filled('search') || (request()->filled('year') && request('year') != 'all'))
                        <h4 class="text-xl font-black text-gray-700 mb-2">Tidak Ada Dokumen Ditemukan</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto mb-6">Tidak ada laporan SKM yang sesuai dengan kata kunci pencarian atau filter tahun yang dipilih.</p>
                        <a href="{{ route('public.skm') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md transition-all duration-300 hover:opacity-90" style="background-color: #059669; color: #ffffff;">
                            <i class="ph-bold ph-arrow-counter-clockwise"></i>
                            <span>Reset Pencarian</span>
                        </a>
                    @else
                        <h4 class="text-xl font-black text-gray-700 mb-2">Belum Ada Data Laporan SKM</h4>
                        <p class="text-sm text-gray-500 font-medium max-w-md mx-auto">Data Laporan SKM akan ditampilkan sesuai database setelah diisi oleh admin.</p>
                    @endif
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
