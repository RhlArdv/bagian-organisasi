<x-public-layout :title="'Regulasi — Peraturan Perundang-undangan'" :metaDescription="'Kumpulan Regulasi dan Peraturan Perundang-undangan mulai dari UU, PP, PermenPANRB, Perda, Perwako hingga Surat Edaran Pemerintah Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Regulasi & Aturan</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-red-600 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-red-600 font-bold">Regulasi</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-12">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border overflow-hidden" style="border: 1px solid #fecaca;">
                {{-- Decorative --}}
                <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full opacity-50 pointer-events-none" style="background-color: #fef2f2;"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-scales text-[16rem]" style="color: #dc2626;"></i>
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0" style="background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                        <i class="ph-bold ph-scales text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black mb-3 tracking-tight" style="color: #7f1d1d;">Dokumen Regulasi & Hukum</h2>
                        <p class="text-gray-700 font-medium leading-relaxed max-w-2xl">
                            Pusat dokumentasi dan informasi hukum terkait regulasi penyelenggaraan pemerintahan, penataan kelembagaan, ketatalaksanaan, dan reformasi birokrasi di lingkungan Pemerintah Kota Padang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KARTU SUB MENU KATEGORI --}}
    <section class="mb-14">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="mb-6">
                <h3 class="text-lg lg:text-xl font-black tracking-tight" style="color: #7f1d1d;">Eksplorasi Kategori Regulasi</h3>
                <p class="text-xs text-gray-500 font-medium">Pilih jenis regulasi atau peraturan untuk melihat daftar lengkap dan melakukan pencarian dokumen.</p>
            </div>

            @if($categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($categories as $cat)
                        @php
                            $docCount = isset($groupedDocuments[$cat->slug]) ? $groupedDocuments[$cat->slug]['documents']->count() : 0;
                            $catIcon = match($cat->slug) {
                                'undang-undang' => 'ph-scales',
                                'peraturan-pemerintah' => 'ph-bank',
                                'permenpanrb' => 'ph-book-bookmark',
                                'perda' => 'ph-buildings',
                                'perwako' => 'ph-gavel',
                                'surat-edaran' => 'ph-envelope-simple-open',
                                default => 'ph-folder-notch'
                            };
                        @endphp
                        <a href="{{ route('public.regulasi.sub', $cat->slug) }}" 
                           class="group bg-white rounded-2xl p-5 border transition-all duration-300 flex flex-col justify-between items-center text-center hover:-translate-y-1 hover:shadow-lg relative overflow-hidden" style="border: 1px solid #fecaca;">
                            <div class="w-12 h-12 rounded-xl mb-3 flex items-center justify-center transition-transform duration-300 group-hover:scale-110" style="background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                                <i class="ph-bold {{ $catIcon }} text-2xl"></i>
                            </div>
                            <h4 class="text-xs font-black mb-1 group-hover:text-red-700 transition-colors line-clamp-1" style="color: #1e293b;">{{ $cat->name }}</h4>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 group-hover:bg-red-50 group-hover:text-red-600 transition-colors">
                                {{ $docCount }} Dokumen
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- TABBED CATEGORIES --}}
    <section class="mb-20" x-data="{ activeTab: new URLSearchParams(location.search).get('tab') || '{{ $categories->first()?->slug ?? '' }}' }">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">

            <div class="border-t border-gray-200/80 pt-8 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black tracking-tight" style="color: #7f1d1d;">Daftar Dokumen per Kategori</h3>
                    <p class="text-xs text-gray-500 font-medium">Lihat dan unduh dokumen regulasi terbaru.</p>
                </div>
                <div>
                    @foreach($categories as $cat)
                        <a x-show="activeTab === '{{ $cat->slug }}'" x-cloak href="{{ route('public.regulasi.sub', $cat->slug) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-black shadow-sm transition-all hover:opacity-90" style="background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                            <span>Buka Halaman Lengkap {{ $cat->name }}</span>
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Tab Buttons --}}
            @if($categories->count() > 0)
                <div class="flex flex-wrap gap-2.5 mb-8">
                    @foreach($categories as $cat)
                        <button @click="activeTab = '{{ $cat->slug }}'; history.replaceState(null, '', '?tab={{ $cat->slug }}')"
                                :class="activeTab === '{{ $cat->slug }}' ? 'bg-red-600 text-white font-black shadow-lg shadow-red-500/20' : 'bg-white text-gray-600 font-bold border border-gray-200 hover:border-red-300 hover:text-red-600'"
                                class="px-5 py-2.5 text-xs lg:text-sm rounded-full transition-all duration-200 flex items-center gap-2">
                            <span>{{ $cat->name }}</span>
                            @if(isset($groupedDocuments[$cat->slug]))
                                <span :class="activeTab === '{{ $cat->slug }}' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-500'" class="px-2 py-0.5 rounded-full text-[11px] font-extrabold transition-colors">
                                    {{ $groupedDocuments[$cat->slug]['documents']->count() }}
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>

                {{-- Tab Content --}}
                @foreach($groupedDocuments as $slug => $group)
                    <div x-show="activeTab === '{{ $slug }}'"
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0">

                        @if($group['documents']->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($group['documents'] as $doc)
                                    <div class="group rounded-[2rem] p-6 lg:p-7 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden bg-white shadow-sm hover:shadow-md" style="border: 2px solid #fecaca;">
                                        <div class="absolute top-0 left-0 right-0 h-1.5" style="background: linear-gradient(90deg, #dc2626 0%, #f87171 100%);"></div>

                                        <div>
                                            <div class="flex items-center justify-between gap-3 mb-5 pt-2">
                                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-bold text-xl shadow-sm" style="background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626;">
                                                    <i class="ph-bold ph-file-pdf"></i>
                                                </div>
                                                <div class="flex flex-col items-end gap-1">
                                                    @if($doc->year)
                                                        <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-gray-500 bg-gray-100 px-2.5 py-0.5 rounded-md border border-gray-200">
                                                            <i class="ph-bold ph-calendar"></i> Tahun {{ $doc->year }}
                                                        </span>
                                                    @endif
                                                    @if($doc->file_size)
                                                        <span class="text-[11px] font-extrabold text-gray-400">{{ number_format($doc->file_size / 1024 / 1024, 1) }} MB</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <h4 class="text-base font-black transition-colors duration-200 mb-2 leading-snug" style="color: #0f172a;">
                                                <a href="{{ route('public.dokumen.show', $doc->id) }}" class="hover:text-red-700 focus:outline-none block">
                                                    {{ $doc->title }}
                                                </a>
                                            </h4>
                                            @if($doc->document_number)
                                                <div class="mb-3">
                                                    <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-200">
                                                        <i class="ph-bold ph-hash text-red-600"></i> {{ $doc->document_number }}
                                                    </span>
                                                </div>
                                            @endif
                                            <p class="text-xs font-medium line-clamp-2 text-gray-600 mb-6">
                                                {{ $doc->description ?: '-' }}
                                            </p>
                                        </div>

                                        <div class="pt-4 flex items-center justify-between mt-auto border-t border-gray-100 gap-2">
                                            <div class="flex items-center gap-1.5 text-[11px] font-bold text-gray-400">
                                                <i class="ph-bold ph-download-simple text-red-500"></i>
                                                <span>{{ $doc->download_count ?? 0 }} diunduh</span>
                                            </div>
                                            <a href="{{ route('public.dokumen.show', $doc->id) }}" 
                                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl font-bold text-xs shadow-sm hover:opacity-90 transition-all" style="background-color: #dc2626; color: #ffffff;">
                                                <span>Detail</span>
                                                <i class="ph-bold ph-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-[2rem] p-14 text-center shadow-sm" style="border: 1px solid #fecaca;">
                                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5" style="background-color: #fef2f2; border: 1px solid #fecaca;">
                                    <i class="ph-duotone ph-folder-open text-4xl" style="color: #dc2626;"></i>
                                </div>
                                <h4 class="text-lg font-black text-gray-700 mb-1">Belum Ada Dokumen</h4>
                                <p class="text-xs text-gray-500 font-medium">Dokumen regulasi pada kategori {{ $group['name'] }} saat ini belum tersedia.</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-sm" style="border: 1px solid #fecaca;">
                    <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6" style="background-color: #fef2f2; border: 1px solid #fecaca;">
                        <i class="ph-duotone ph-scales text-5xl" style="color: #dc2626;"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-700 mb-2">Kategori Belum Tersedia</h4>
                    <p class="text-sm text-gray-500 font-medium max-w-md mx-auto">Kategori Regulasi akan ditampilkan setelah dikonfigurasi oleh administrator.</p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
