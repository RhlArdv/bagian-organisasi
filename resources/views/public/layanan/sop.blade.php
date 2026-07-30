<x-public-layout :title="'Standar Operasional Prosedur'" :metaDescription="'Dokumen SOP pelayanan Bagian Organisasi Sekretariat Daerah Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Standar Operasional Prosedur</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">SOP</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-white rounded-[2.5rem] p-10 lg:p-14 shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden">
                {{-- Decorative --}}
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-blue-50 rounded-full opacity-50 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-files text-[16rem]"></i>
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center shrink-0">
                        <i class="ph-bold ph-files text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black text-[#1a202c] mb-3 tracking-tight">Dokumen SOP Pelayanan</h2>
                        <p class="text-gray-600 font-medium leading-relaxed max-w-2xl">
                            Pedoman baku pelaksanaan tugas dan fungsi aparatur secara sistematis. 
                            SOP menjamin konsistensi dan kualitas pelayanan publik di seluruh perangkat daerah Kota Padang.
                        </p>
                    </div>
                    <div class="shrink-0 bg-blue-50 rounded-2xl px-6 py-4 text-center">
                        <span class="block text-3xl font-black text-blue-600">{{ $documents->count() }}</span>
                        <span class="text-[11px] font-bold text-blue-400 uppercase tracking-widest">Total SOP</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SOP LIST --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            @if($documents->count() > 0)
                <div class="space-y-3">
                    @foreach($documents as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                           class="group flex items-center gap-4 lg:gap-6 bg-white p-5 lg:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="ph-fill ph-file-pdf text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm lg:text-base font-bold text-[#1a202c] group-hover:text-blue-600 transition-colors truncate">{{ $doc->title }}</h4>
                                <div class="flex items-center gap-3 mt-1 flex-wrap">
                                    @if($doc->document_number)
                                        <span class="text-xs text-gray-400 font-medium flex items-center gap-1"><i class="ph ph-hash"></i> {{ $doc->document_number }}</span>
                                    @endif
                                    @if($doc->year)
                                        <span class="text-xs text-gray-400 font-medium flex items-center gap-1"><i class="ph ph-calendar-blank"></i> {{ $doc->year }}</span>
                                    @endif
                                    @if($doc->file_size)
                                        <span class="text-xs text-gray-400 font-medium">{{ number_format($doc->file_size / 1024 / 1024, 1) }} MB</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                                <i class="ph-bold ph-download-simple"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-files text-5xl text-blue-200"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-300 mb-3">Dokumen Belum Tersedia</h4>
                    <p class="text-sm text-gray-400 font-medium max-w-md mx-auto">Dokumen SOP akan ditampilkan di sini setelah diunggah oleh admin melalui dashboard.</p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
