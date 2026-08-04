<x-public-layout :title="'Penataan Kelembagaan'" :metaDescription="'Layanan penataan kelembagaan perangkat daerah Kota Padang — evaluasi, nomenklatur, peta jabatan, dan produk hukum'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Penataan Kelembagaan</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Penataan Kelembagaan</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-emerald-50 rounded-full opacity-50 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-tree-structure text-[16rem]"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-3xl flex items-center justify-center shrink-0">
                        <i class="ph-bold ph-tree-structure text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black text-[#1a202c] mb-3 tracking-tight">Layanan Penataan Kelembagaan</h2>
                        <p class="text-gray-600 font-medium leading-relaxed max-w-2xl">
                            Evaluasi dan penyesuaian nomenklatur Perangkat Daerah sesuai dengan kebutuhan dan regulasi. 
                            Meliputi penataan struktur organisasi, peta jabatan, dan produk hukum kelembagaan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR LAYANAN & DOKUMEN KELEMBAGAAN (TABBED) --}}
    @php
        $layananCategories = [
            'penataan-kelembagaan' => 'Penataan Kelembagaan',
            'evaluasi-kelembagaan' => 'Evaluasi Kelembagaan',
            'nomenklatur-opd' => 'Nomenklatur OPD',
        ];
        $hasDokumen = $documents->flatten()->count() > 0;
    @endphp

    <section class="mb-10" x-data="{ activeTab: new URLSearchParams(location.search).get('tab') || 'penataan-kelembagaan' }">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            
            {{-- Tab Buttons --}}
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($layananCategories as $slug => $name)
                    <button @click="activeTab = '{{ $slug }}'"
                            :class="activeTab === '{{ $slug }}' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/20' : 'bg-white text-gray-600 border border-gray-200 hover:border-emerald-300 hover:text-emerald-600'"
                            class="px-5 py-2.5 text-sm font-bold rounded-full transition-all duration-200">
                        {{ $name }}
                        @if(isset($layanans[$slug]))
                            <span class="ml-1.5 text-xs opacity-70">({{ $layanans[$slug]->count() }})</span>
                        @endif
                    </button>
                @endforeach

                @if($hasDokumen)
                    <button @click="activeTab = 'dokumen'"
                            :class="activeTab === 'dokumen' ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'bg-white text-gray-600 border border-gray-200 hover:border-red-300 hover:text-red-600'"
                            class="px-5 py-2.5 text-sm font-bold rounded-full transition-all duration-200">
                        Dokumen Kelembagaan
                    </button>
                @endif
            </div>

            {{-- Tab Content - Layanan --}}
            @foreach($layananCategories as $slug => $name)
                <div x-show="activeTab === '{{ $slug }}'"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0">
                     
                     @if(isset($layanans[$slug]) && $layanans[$slug]->count() > 0)
                        <div class="space-y-4" x-data="{ openItem: null }">
                            @foreach($layanans[$slug] as $layanan)
                                <div class="bg-white rounded-[2rem] shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                                    {{-- Header (Click to expand) --}}
                                    <button @click="openItem = openItem === {{ $layanan->id }} ? null : {{ $layanan->id }}"
                                            class="w-full p-6 lg:p-8 flex items-center gap-5 text-left">
                                        <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0 transition-transform duration-300"
                                             :class="openItem === {{ $layanan->id }} ? 'rotate-6 scale-110' : ''">
                                            <i class="ph-bold ph-buildings text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-base lg:text-lg font-black text-[#1a202c] truncate">{{ $layanan->judul }}</h4>
                                            @if($layanan->deskripsi)
                                                <p class="text-sm text-gray-500 font-medium mt-1 line-clamp-1">{{ $layanan->deskripsi }}</p>
                                            @endif
                                        </div>
                                        <i class="ph-bold ph-caret-down text-gray-400 text-lg transition-transform duration-300 shrink-0"
                                           :class="openItem === {{ $layanan->id }} ? 'rotate-180' : ''"></i>
                                    </button>

                                    {{-- Expanded Content --}}
                                    <div x-show="openItem === {{ $layanan->id }}"
                                         x-cloak
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 -translate-y-2"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 -translate-y-2"
                                         class="px-6 lg:px-8 pb-8 border-t border-gray-50">
                                        <div class="pt-6 space-y-6">
                                            @if($layanan->deskripsi)
                                                <div>
                                                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi</h5>
                                                    <p class="text-sm text-gray-700 font-medium leading-relaxed">{{ $layanan->deskripsi }}</p>
                                                </div>
                                            @endif

                                            @if($layanan->dasar_hukum)
                                                <div>
                                                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Dasar Hukum</h5>
                                                    <div class="text-sm text-gray-700 font-medium leading-relaxed prose-sm">{!! nl2br(e($layanan->dasar_hukum)) !!}</div>
                                                </div>
                                            @endif

                                            @if($layanan->persyaratan)
                                                <div>
                                                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Persyaratan</h5>
                                                    <div class="text-sm text-gray-700 font-medium leading-relaxed">{!! nl2br(e($layanan->persyaratan)) !!}</div>
                                                </div>
                                            @endif

                                            <div class="grid sm:grid-cols-3 gap-4">
                                                @if($layanan->jangka_waktu)
                                                    <div class="bg-gray-50 rounded-xl p-4">
                                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jangka Waktu</p>
                                                        <p class="text-sm font-bold text-[#1a202c]">{{ $layanan->jangka_waktu }}</p>
                                                    </div>
                                                @endif
                                                @if($layanan->biaya)
                                                    <div class="bg-gray-50 rounded-xl p-4">
                                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Biaya</p>
                                                        <p class="text-sm font-bold text-[#1a202c]">{{ $layanan->biaya }}</p>
                                                    </div>
                                                @endif
                                                @if($layanan->produk_pelayanan)
                                                    <div class="bg-gray-50 rounded-xl p-4">
                                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Produk Pelayanan</p>
                                                        <p class="text-sm font-bold text-[#1a202c]">{{ $layanan->produk_pelayanan }}</p>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($layanan->file_download)
                                                <a href="{{ asset('storage/' . $layanan->file_download) }}" target="_blank"
                                                   class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 font-bold text-sm px-5 py-3 rounded-xl hover:bg-emerald-100 transition-colors">
                                                    <i class="ph-bold ph-download-simple"></i> Download Dokumen
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                     @else
                        <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                            <div class="w-24 h-24 mx-auto bg-emerald-50 rounded-full flex items-center justify-center mb-6">
                                <i class="ph-duotone ph-tree-structure text-5xl text-emerald-200"></i>
                            </div>
                            <h4 class="text-xl font-black text-gray-300 mb-3">Belum Ada Layanan</h4>
                            <p class="text-sm text-gray-400 font-medium max-w-md mx-auto">Layanan {{ $name }} belum tersedia.</p>
                        </div>
                     @endif
                </div>
            @endforeach

            {{-- Tab Content - Dokumen --}}
            @if($hasDokumen)
                <div x-show="activeTab === 'dokumen'"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0">
                     
                     <div class="space-y-8">
                         @foreach($docCategories as $cat)
                             @if(isset($documents[$cat->slug]) && $documents[$cat->slug]->count() > 0)
                                 <div>
                                     <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                                         <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> {{ $cat->name }}
                                     </h4>
                                     <div class="space-y-2">
                                         @foreach($documents[$cat->slug] as $doc)
                                             <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                                class="group flex items-center gap-4 bg-white p-4 lg:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                                                 <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                                     <i class="ph-fill ph-file-pdf text-lg"></i>
                                                 </div>
                                                 <div class="flex-1 min-w-0">
                                                     <h5 class="text-sm font-bold text-[#1a202c] group-hover:text-emerald-600 transition-colors truncate">{{ $doc->title }}</h5>
                                                     <div class="flex items-center gap-3 mt-0.5">
                                                         @if($doc->year)<span class="text-xs text-gray-400 font-medium">{{ $doc->year }}</span>@endif
                                                     </div>
                                                 </div>
                                                 <div class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-emerald-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                                                     <i class="ph-bold ph-download-simple text-sm"></i>
                                                 </div>
                                             </a>
                                         @endforeach
                                     </div>
                                 </div>
                             @endif
                         @endforeach
                     </div>
                </div>
            @endif

        </div>
    </section>
</x-public-layout>

