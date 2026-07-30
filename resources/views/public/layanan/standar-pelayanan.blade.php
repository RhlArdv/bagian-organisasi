<x-public-layout :title="'Standar Pelayanan'" :metaDescription="'Standar pelayanan publik Bagian Organisasi Kota Padang — jaminan kepastian layanan prima bagi masyarakat'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Standar Pelayanan</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Standar Pelayanan</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-rose-50 rounded-full opacity-50 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-star text-[16rem]"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-3xl flex items-center justify-center shrink-0">
                        <i class="ph-bold ph-star text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black text-[#1a202c] mb-3 tracking-tight">Standar Pelayanan Publik</h2>
                        <p class="text-gray-600 font-medium leading-relaxed max-w-2xl">
                            Tolak ukur kualitas pelayanan publik sebagai jaminan kepastian layanan prima kepada masyarakat. 
                            Setiap layanan memiliki standar yang jelas meliputi persyaratan, mekanisme, biaya, dan jangka waktu penyelesaian.
                        </p>
                    </div>
                    <div class="shrink-0 bg-rose-50 rounded-2xl px-6 py-4 text-center">
                        <span class="block text-3xl font-black text-rose-600">{{ $layanans->count() }}</span>
                        <span class="text-[11px] font-bold text-rose-400 uppercase tracking-widest">Standar</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STANDAR PELAYANAN LIST --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            @if($layanans->count() > 0)
                <div class="space-y-4" x-data="{ openItem: null }">
                    @foreach($layanans as $layanan)
                        <div class="bg-white rounded-[2rem] shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                            {{-- Header --}}
                            <button @click="openItem = openItem === {{ $layanan->id }} ? null : {{ $layanan->id }}"
                                    class="w-full p-6 lg:p-8 flex items-center gap-5 text-left">
                                <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center shrink-0 transition-transform duration-300"
                                     :class="openItem === {{ $layanan->id }} ? 'rotate-6 scale-110' : ''">
                                    <i class="ph-bold ph-star text-xl"></i>
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

                            {{-- Detail --}}
                            <div x-show="openItem === {{ $layanan->id }}"
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
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi Layanan</h5>
                                            <p class="text-sm text-gray-700 font-medium leading-relaxed">{{ $layanan->deskripsi }}</p>
                                        </div>
                                    @endif

                                    @if($layanan->dasar_hukum)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Dasar Hukum</h5>
                                            <div class="text-sm text-gray-700 font-medium leading-relaxed bg-gray-50 rounded-xl p-5">{!! nl2br(e($layanan->dasar_hukum)) !!}</div>
                                        </div>
                                    @endif

                                    @if($layanan->persyaratan)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Persyaratan</h5>
                                            <div class="text-sm text-gray-700 font-medium leading-relaxed bg-gray-50 rounded-xl p-5">{!! nl2br(e($layanan->persyaratan)) !!}</div>
                                        </div>
                                    @endif

                                    @if($layanan->sistem_mekanisme)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Sistem & Mekanisme</h5>
                                            <div class="text-sm text-gray-700 font-medium leading-relaxed">{!! nl2br(e($layanan->sistem_mekanisme)) !!}</div>
                                        </div>
                                    @endif

                                    @if($layanan->flowchart_image)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alur / Flowchart</h5>
                                            <img src="{{ asset('storage/' . $layanan->flowchart_image) }}" alt="Flowchart {{ $layanan->judul }}" class="rounded-2xl border border-gray-200 max-w-full">
                                        </div>
                                    @endif

                                    {{-- Quick Info Grid --}}
                                    <div class="grid sm:grid-cols-3 gap-4">
                                        @if($layanan->jangka_waktu)
                                            <div class="bg-blue-50 rounded-xl p-4">
                                                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest mb-1"><i class="ph-fill ph-clock"></i> Jangka Waktu</p>
                                                <p class="text-sm font-bold text-blue-700">{{ $layanan->jangka_waktu }}</p>
                                            </div>
                                        @endif
                                        @if($layanan->biaya)
                                            <div class="bg-emerald-50 rounded-xl p-4">
                                                <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-1"><i class="ph-fill ph-currency-circle-dollar"></i> Biaya</p>
                                                <p class="text-sm font-bold text-emerald-700">{{ $layanan->biaya }}</p>
                                            </div>
                                        @endif
                                        @if($layanan->produk_pelayanan)
                                            <div class="bg-purple-50 rounded-xl p-4">
                                                <p class="text-[10px] font-bold text-purple-400 uppercase tracking-widest mb-1"><i class="ph-fill ph-package"></i> Produk</p>
                                                <p class="text-sm font-bold text-purple-700">{{ $layanan->produk_pelayanan }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if($layanan->pengaduan)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pengaduan</h5>
                                            <div class="text-sm text-gray-700 font-medium leading-relaxed">{!! nl2br(e($layanan->pengaduan)) !!}</div>
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-3">
                                        @if($layanan->file_download)
                                            <a href="{{ asset('storage/' . $layanan->file_download) }}" target="_blank"
                                               class="inline-flex items-center gap-2 bg-rose-50 text-rose-600 font-bold text-sm px-5 py-3 rounded-xl hover:bg-rose-100 transition-colors">
                                                <i class="ph-bold ph-download-simple"></i> Download Dokumen
                                            </a>
                                        @endif
                                        @if($layanan->link_sippn)
                                            <a href="{{ $layanan->link_sippn }}" target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 font-bold text-sm px-5 py-3 rounded-xl hover:bg-blue-100 transition-colors">
                                                <i class="ph-bold ph-arrow-square-out"></i> Lihat di SIPPN
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-rose-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-star text-5xl text-rose-200"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-300 mb-3">Belum Ada Standar Pelayanan</h4>
                    <p class="text-sm text-gray-400 font-medium max-w-md mx-auto">Data standar pelayanan akan ditampilkan setelah diinput oleh admin melalui dashboard.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- DOKUMEN STANDAR PELAYANAN --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <h3 class="text-xl font-black text-[#1a202c] mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                    <i class="ph-bold ph-file-pdf text-xl"></i>
                </div>
                Dokumen Standar Pelayanan
            </h3>

            @if($documents->count() > 0)
                <div class="space-y-3">
                    @foreach($documents as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                           class="group flex items-center gap-4 lg:gap-6 bg-white p-5 lg:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300">
                            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="ph-fill ph-file-pdf text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm lg:text-base font-bold text-[#1a202c] group-hover:text-rose-600 transition-colors truncate">{{ $doc->title }}</h4>
                                <div class="flex items-center gap-3 mt-1 flex-wrap">
                                    @if($doc->year)
                                        <span class="text-xs text-gray-400 font-medium"><i class="ph ph-calendar-blank"></i> {{ $doc->year }}</span>
                                    @endif
                                    @if($doc->file_size)
                                        <span class="text-xs text-gray-400 font-medium">{{ number_format($doc->file_size / 1024 / 1024, 1) }} MB</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 group-hover:bg-rose-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
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
                    <p class="text-sm text-gray-400 font-medium">Belum ada dokumen standar pelayanan yang diunggah.</p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
