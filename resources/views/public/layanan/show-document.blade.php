<x-public-layout :title="$document->title . ' — ' . $namaKategori" :metaDescription="Str::limit($document->description ?: 'Detail dokumen ' . $document->title, 150)">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-6 pb-24">
        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-2 text-xs font-semibold text-gray-500 mb-8 overflow-x-auto whitespace-nowrap py-1">
            <a href="/" class="hover:text-emerald-700 transition-colors">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <a href="{{ $backRoute }}" class="hover:text-emerald-700 transition-colors">{{ $namaKategori }}</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-600 truncate max-w-xs font-bold">{{ $document->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- KOTA KANAN (KONTEN UTAMA DOKUMEN & RINCIAN DATABASE) --}}
            <div class="lg:col-span-8 space-y-8">
                
                {{-- HEADER DOKUMEN CARD --}}
                <div class="p-8 lg:p-10 rounded-[2.5rem] relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);">
                    {{-- Top Green Accent --}}
                    <div class="absolute top-0 left-0 right-0 h-2" style="background: linear-gradient(90deg, #059669 0%, #34d399 100%);"></div>
                    
                    <div class="flex flex-wrap items-center gap-3 mb-6 pt-2">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black tracking-wide" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                            <i class="ph-fill ph-file-pdf text-emerald-600"></i> {{ $namaKategori }}
                        </span>
                        @if($document->year)
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                <i class="ph-bold ph-calendar-blank"></i> Tahun {{ $document->year }}
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl lg:text-3xl font-black mb-6 leading-snug tracking-tight" style="color: #0f172a;">
                        {{ $document->title }}
                    </h1>

                    {{-- TABEL RINCIAN ATRIBUT DATABASE --}}
                    <div class="mt-6 pt-6 rounded-2xl p-6" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <h3 class="text-xs font-extrabold uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                            <i class="ph-bold ph-info text-emerald-600 text-sm"></i> Rincian Informasi Dokumen
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div class="p-3 bg-white rounded-xl border border-gray-200/80 shadow-sm">
                                <span class="text-xs font-bold text-gray-400 block mb-1">Nomor Dokumen</span>
                                <span class="font-black text-gray-800">{{ $document->document_number ?: '-' }}</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-gray-200/80 shadow-sm">
                                <span class="text-xs font-bold text-gray-400 block mb-1">Tahun Penetapan</span>
                                <span class="font-black text-gray-800">{{ $document->year ?: '-' }}</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-gray-200/80 shadow-sm">
                                <span class="text-xs font-bold text-gray-400 block mb-1">Tipe Dokumen</span>
                                <span class="font-black text-gray-800 uppercase">{{ $document->file_type ?: 'PDF' }}</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-gray-200/80 shadow-sm">
                                <span class="text-xs font-bold text-gray-400 block mb-1">Ukuran File</span>
                                <span class="font-black text-gray-800">
                                    @if($document->file_size)
                                        {{ number_format($document->file_size / 1024, 1) }} KB
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-gray-200/80 shadow-sm sm:col-span-2">
                                <span class="text-xs font-bold text-gray-400 block mb-1">Tanggal Diunggah</span>
                                <span class="font-black text-gray-800">{{ $document->created_at ? $document->created_at->translatedFormat('d F Y (H:i)') : '-' }} WIB</span>
                            </div>
                        </div>
                    </div>

                    {{-- KETERANGAN / DESKRIPSI --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-base font-black mb-3 text-gray-900 flex items-center gap-2">
                            <i class="ph-bold ph-text-align-left text-emerald-600"></i> Keterangan / Deskripsi Dokumen
                        </h3>
                        <div class="text-sm lg:text-base text-gray-700 leading-relaxed whitespace-pre-line bg-emerald-50/30 p-5 rounded-2xl border border-emerald-100 font-medium">
                            {{ $document->description ?: '-' }}
                        </div>
                    </div>
                </div>

                {{-- PRATINJAU DOKUMEN (PREVIEW PDF) --}}
                @if($document->file_path)
                    <div class="p-8 rounded-[2.5rem] relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <h3 class="text-lg font-black text-gray-900 flex items-center gap-2.5">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-lg" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                    <i class="ph-bold ph-eye"></i>
                                </div>
                                Pratinjau Dokumen PDF
                            </h3>
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" download
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-black text-xs shadow-md hover:opacity-90 transition-all duration-300" style="background-color: #059669; color: #ffffff;">
                                <i class="ph-bold ph-download-simple text-sm"></i>
                                <span>Unduh Berkas</span>
                            </a>
                        </div>
                        <div class="w-full h-[600px] rounded-2xl overflow-hidden border border-gray-200 shadow-inner bg-gray-100">
                            <iframe src="{{ asset('storage/' . $document->file_path) }}#toolbar=0" class="w-full h-full border-0" title="Pratinjau PDF {{ $document->title }}">
                                <p class="p-6 text-center text-sm font-medium text-gray-600">
                                    Browser Anda tidak mendukung pratinjau langsung PDF. 
                                    <a href="{{ asset('storage/' . $document->file_path) }}" class="text-emerald-600 font-bold underline" download>Klik di sini untuk mengunduh dokumen</a>.
                                </p>
                            </iframe>
                        </div>
                    </div>
                @endif

            </div>

            {{-- SIDEBAR KIRI/KANAN --}}
            <div class="lg:col-span-4 space-y-8">
                
                {{-- TOMBOL AKSI CEPAT UNDUH --}}
                <div class="p-7 rounded-[2rem] relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center text-3xl shadow-sm" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                            <i class="ph-bold ph-file-arrow-down"></i>
                        </div>
                        <h4 class="text-lg font-black text-gray-900 mb-1">Unduh Dokumen Asli</h4>
                        <p class="text-xs font-medium text-gray-500">Berkas PDF resmi siap diunduh sesuai database yang diinput admin.</p>
                    </div>

                    @if($document->file_path)
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" download
                           class="w-full py-4 px-6 rounded-2xl font-black text-sm text-center shadow-lg hover:opacity-95 transition-all duration-300 flex items-center justify-center gap-3" style="background-color: #059669; color: #ffffff;">
                            <i class="ph-bold ph-download-simple text-xl"></i>
                            <span>Unduh Sekarang</span>
                        </a>
                    @else
                        <div class="p-4 text-center bg-gray-100 rounded-xl text-xs font-bold text-gray-500">
                            File Tidak Tersedia (-)
                        </div>
                    @endif
                </div>

                {{-- DOKUMEN SEJENIS LAINNYA --}}
                @if($relatedDocuments && $relatedDocuments->count() > 0)
                    <div class="p-7 rounded-[2rem] relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);">
                        <h3 class="text-base font-black mb-5 pb-3 flex items-center gap-2.5" style="border-bottom: 1px solid #e2e8f0; color: #0f172a;">
                            <i class="ph-bold ph-stack text-emerald-600 text-lg"></i>
                            <span>Dokumen {{ $namaKategori }} Lainnya</span>
                        </h3>

                        <div class="space-y-4">
                            @foreach($relatedDocuments as $relDoc)
                                <a href="{{ route('public.dokumen.show', $relDoc->id) }}" class="group block p-3.5 rounded-2xl transition-all duration-200 border border-transparent hover:border-emerald-200 hover:shadow-md" style="background-color: #f8fafc;">
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 font-bold text-base mt-0.5" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                            <i class="ph-bold ph-file-text"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug mb-1">
                                                {{ $relDoc->title }}
                                            </h4>
                                            <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">
                                                Tahun {{ $relDoc->year ?: '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                            <a href="{{ $backRoute }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors">
                                <span>Lihat Semua Daftar {{ $namaKategori }}</span>
                                <i class="ph-bold ph-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- BANTUAN & INFORMASI --}}
                <div class="p-7 rounded-[2rem] relative overflow-hidden" style="background-color: #ecfdf5; border: 2px solid #a7f3d0;">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-white text-emerald-600 flex items-center justify-center font-bold text-2xl shadow-sm border border-emerald-200">
                            <i class="ph-bold ph-question"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-black" style="color: #047857;">Perlu Bantuan?</h4>
                            <span class="text-xs font-semibold text-emerald-700">Hubungi Bagian Organisasi</span>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-emerald-900 mb-5 leading-relaxed">
                        Jika Anda memerlukan klarifikasi teknis atau memiliki pertanyaan mengenai regulasi dan dokumen di atas, silakan hubungi kami atau gunakan kanal layanan pengaduan.
                    </p>
                    <a href="{{ route('public.pengaduan') }}" 
                       class="w-full block text-center py-3 px-4 rounded-xl font-bold text-xs shadow-md transition-all duration-300 hover:opacity-95" style="background-color: #059669; color: #ffffff;">
                        <i class="ph-bold ph-chat-text mr-1"></i> Layanan Konsultasi / Pengaduan
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-public-layout>
