<x-public-layout :title="$layanan->judul . ' — ' . $namaKategori" :metaDescription="Str($layanan->deskripsi ?: '-', 150)">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-6 pb-24">
        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-2 text-xs font-bold text-gray-500 mb-6 flex-wrap">
            <a href="/" class="hover:text-emerald-700 transition-colors text-gray-700">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <a href="{{ $backRoute }}" class="hover:text-emerald-700 transition-colors text-gray-700">{{ $namaKategori }}</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500 font-semibold truncate max-w-sm">{{ $layanan->judul }}</span>
        </nav>

        {{-- JUDUL UTAMA (SOFT GREEN) --}}
        <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight leading-[1.25] mb-8 pb-6 border-b border-gray-200" style="color: #047857;">
            {{ $layanan->judul }}
        </h1>

        {{-- GRID 2 KOLOM (KIRI: KONTEN UTAMA, KANAN: SIDEBAR) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">

            {{-- KOLOM KIRI (KONTEN) --}}
            <div class="lg:col-span-8 space-y-10">

                {{-- DESKRIPSI LAYANAN (STRICTLY FROM DATABASE) --}}
                <div class="text-base lg:text-lg text-gray-800 font-medium leading-relaxed space-y-4">
                    @if($layanan->deskripsi)
                        {!! nl2br(e($layanan->deskripsi)) !!}
                    @else
                        <span class="text-gray-400 font-bold">-</span>
                    @endif
                </div>

                {{-- DASAR HUKUM --}}
                <div class="space-y-3">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph-bold ph-scales text-lg" style="color: #059669;"></i> DASAR HUKUM & REGULASI
                    </h3>
                    <div class="text-sm lg:text-base text-gray-800 font-medium leading-relaxed rounded-2xl p-6 shadow-sm" style="background-color: #f8fafc; border: 1px solid #cbd5e1;">
                        @if($layanan->dasar_hukum)
                            {!! nl2br(e($layanan->dasar_hukum)) !!}
                        @else
                            <span class="text-gray-400 font-bold">-</span>
                        @endif
                    </div>
                </div>

                {{-- ACCORDION STANDAR PELAYANAN (SOFT GREEN BADGES, STRICT DATABASE DATA) --}}
                <div class="space-y-4 pt-2">
                    <h3 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-list-numbers text-base" style="color: #059669;"></i> RINCIAN {{ strtoupper($namaKategori) }}
                    </h3>

                    {{-- 1. PERSYARATAN PELAYANAN --}}
                    <div x-data="{ open: true }" id="persyaratan" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">1</span>
                                <span class="text-gray-900 font-bold">Persyaratan Pelayanan</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-3 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="prose-sm max-w-none text-gray-800 space-y-2">
                                @if($layanan->persyaratan)
                                    {!! nl2br(e($layanan->persyaratan)) !!}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- 2. SISTEM, MEKANISME, DAN PROSEDUR --}}
                    <div x-data="{ open: false }" id="sistem_mekanisme" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">2</span>
                                <span class="text-gray-900 font-bold">Sistem, Mekanisme, dan Prosedur</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-3 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="prose-sm max-w-none text-gray-800 space-y-2 mb-4">
                                @if($layanan->sistem_mekanisme)
                                    {!! nl2br(e($layanan->sistem_mekanisme)) !!}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </div>

                            @if($layanan->flowchart_image)
                                <div class="mt-5 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                    <span class="text-xs font-black uppercase text-gray-600 block mb-2">Bagan Alur (Flowchart):</span>
                                    <img src="{{ asset('storage/' . $layanan->flowchart_image) }}" alt="Flowchart {{ $layanan->judul }}" class="rounded-xl border border-gray-300 max-w-full shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 3. JANGKA WAKTU PELAYANAN --}}
                    <div x-data="{ open: false }" id="jangka_waktu" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">3</span>
                                <span class="text-gray-900 font-bold">Jangka Waktu Pelayanan / Penyelesaian</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-4 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="flex items-center gap-3 font-bold text-base">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-200">
                                    <i class="ph-bold ph-clock text-xl"></i>
                                </div>
                                <span>{{ $layanan->jangka_waktu ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- 4. BIAYA / TARIF --}}
                    <div x-data="{ open: false }" id="biaya" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">4</span>
                                <span class="text-gray-900 font-bold">Biaya / Tarif Pelayanan</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-4 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="flex items-center gap-3 text-emerald-800 font-bold text-base p-4 rounded-xl bg-emerald-50 border border-emerald-200">
                                <i class="ph-fill ph-check-circle text-2xl text-emerald-600 shrink-0"></i>
                                <span>{{ $layanan->biaya ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- 5. PRODUK PELAYANAN --}}
                    <div x-data="{ open: false }" id="produk" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">5</span>
                                <span class="text-gray-900 font-bold">Produk Pelayanan yang Dihasilkan</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-4 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="prose-sm max-w-none text-gray-800 font-semibold space-y-2">
                                @if($layanan->produk_pelayanan)
                                    {!! nl2br(e($layanan->produk_pelayanan)) !!}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- 6. PENANGANAN PENGADUAN --}}
                    <div x-data="{ open: false }" id="pengaduan" class="rounded-2xl transition-all duration-200 overflow-hidden" style="background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <button @click="open = !open" type="button" class="w-full p-5 lg:p-6 flex items-center justify-between gap-4 text-left font-bold text-base lg:text-lg text-gray-900 hover:bg-emerald-50/50 transition-colors focus:outline-none">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-8 rounded-full font-black flex items-center justify-center text-sm shrink-0 shadow-sm" style="background-color: #10b981; color: #ffffff;">6</span>
                                <span class="text-gray-900 font-bold">Penanganan Pengaduan / Saran / Apresiasi</span>
                            </div>
                            <i class="ph-bold text-lg" :class="open ? 'ph-caret-up' : 'ph-caret-down'" style="color: #059669;"></i>
                        </button>
                        <div x-show="open" x-collapse class="px-6 lg:px-8 pb-6 pt-4 text-gray-800 font-medium text-sm lg:text-base leading-relaxed" style="border-top: 1px solid #f1f5f9;">
                            <div class="prose-sm max-w-none text-gray-800 space-y-2">
                                @if($layanan->pengaduan)
                                    {!! nl2br(e($layanan->pengaduan)) !!}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                {{-- INFORMASI TAMBAHAN --}}
                @if($layanan->informasi_tambahan)
                    <div class="rounded-2xl p-6 lg:p-7 shadow-sm mt-8" style="background-color: #f8fafc; border: 1px solid #cbd5e1;">
                        <h4 class="text-base font-black text-gray-900 mb-3">Informasi Tambahan</h4>
                        <div class="font-extrabold text-sm px-4 py-3 rounded-xl inline-flex items-center gap-3 shadow-sm" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                            <i class="ph-fill ph-info text-xl text-emerald-600 shrink-0"></i>
                            <span>{{ $layanan->informasi_tambahan }}</span>
                        </div>
                    </div>
                @endif

                {{-- TOMBOL AKSI & TOOLBAR --}}
                <div class="pt-6 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4" style="border-top: 1px solid #e2e8f0;">
                    <div class="flex flex-wrap items-center gap-3">
                        @if($layanan->link_sippn)
                            <a href="{{ $layanan->link_sippn }}" target="_blank" rel="noopener noreferrer"
                               class="px-6 py-3.5 font-black text-sm rounded-xl inline-flex items-center justify-center gap-2.5 shadow-md hover:opacity-90 transition-opacity" style="background-color: #059669; color: #ffffff;">
                                <i class="ph-fill ph-arrow-square-out text-lg"></i> Portal SIPPN
                            </a>
                        @endif

                        @if($layanan->file_download)
                            <a href="{{ asset('storage/' . $layanan->file_download) }}" target="_blank"
                               class="px-6 py-3.5 font-black text-sm rounded-xl inline-flex items-center justify-center gap-2.5 shadow-md hover:opacity-90 transition-opacity" style="background-color: #10b981; color: #ffffff;">
                                <i class="ph-bold ph-download-simple text-lg"></i> Unduh Dokumen Standar Pelayanan
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-3 self-start sm:self-center">
                        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" type="button"
                                class="px-4 py-2.5 hover:bg-gray-50 text-gray-800 font-bold text-xs sm:text-sm inline-flex items-center gap-2 shadow-sm transition-all rounded-xl" style="background-color: #ffffff; border: 1px solid #cbd5e1;">
                            <i class="ph-bold ph-arrow-up text-emerald-600"></i> Kembali ke atas
                        </button>
                        <button onclick="window.print()" type="button"
                                class="px-4 py-2.5 hover:bg-gray-50 text-gray-800 font-bold text-xs sm:text-sm inline-flex items-center gap-2 shadow-sm transition-all rounded-xl" style="background-color: #ffffff; border: 1px solid #cbd5e1;">
                            <i class="ph-bold ph-printer text-gray-700"></i> Cetak Halaman
                        </button>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (SIDEBAR / MAKLUMAT & DAFTAR) --}}
            <div class="lg:col-span-4 space-y-8 sticky top-28">

                {{-- KARTU MAKLUMAT PELAYANAN --}}
                <div class="rounded-3xl p-6 text-center shadow-lg relative overflow-hidden" style="background-color: #1e293b; border: 4px solid #10b981; color: #ffffff;">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#34d399_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
                    
                    @if($layanan->maklumat_image)
                        <img src="{{ asset('storage/' . $layanan->maklumat_image) }}" alt="Maklumat Pelayanan {{ $layanan->judul }}"
                             class="w-full rounded-2xl border-2 border-emerald-400/30 shadow-md object-cover relative z-10">
                    @else
                        <div class="relative z-10">
                            <div class="w-14 h-14 mx-auto rounded-full flex items-center justify-center mb-3 shadow-md" style="background-color: rgba(16, 185, 129, 0.2); border: 2px solid #10b981; color: #34d399;">
                                <i class="ph-fill ph-seal-check text-3xl"></i>
                            </div>
                            <h4 class="font-script text-3xl font-bold tracking-wide mb-1" style="color: #34d399;">Maklumat Pelayanan</h4>
                            <p class="text-[11px] uppercase font-black tracking-widest pb-3 mb-4" style="color: #cbd5e1; border-bottom: 1px solid rgba(255,255,255,0.15);">Bagian Organisasi Setda</p>
                            <p class="text-xs font-medium leading-relaxed italic mb-5" style="color: #f3f4f6;">
                                "Kami seluruh aparatur Bagian Organisasi Kota Padang berkomitmen penuh menyelenggarakan pelayanan publik yang prima, jujur, transparan, dan akuntabel sesuai dengan standar pelayanan yang telah ditetapkan."
                            </p>
                            <div class="pt-3.5 flex flex-col" style="border-top: 1px solid rgba(255,255,255,0.15);">
                                <span class="text-xs font-black tracking-wider" style="color: #34d399;">MOTTO PELAYANAN</span>
                                <span class="text-[11px] font-bold uppercase tracking-widest mt-1" style="color: #e2e8f0;">"Pelayanan Berkualitas, Wujud Pengabdian"</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- KARTU NAVIGASI STANDAR PELAYANAN (SOFT GREEN THEME) --}}
                <div class="rounded-3xl p-6 shadow-md" style="background-color: #ecfdf5; border: 2px solid #a7f3d0;">
                    <h4 class="text-base font-extrabold pb-3 mb-4 flex items-center gap-2.5" style="color: #047857; border-bottom: 1px solid #86efac;">
                        <i class="ph-fill ph-list-checks text-xl" style="color: #059669;"></i> Rincian {{ $namaKategori }}
                    </h4>
                    <ul class="space-y-3 text-sm font-bold text-gray-800">
                        <li><a href="#persyaratan" @click="document.getElementById('persyaratan').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">1</span> <span>Persyaratan Pelayanan</span></a></li>
                        <li><a href="#sistem_mekanisme" @click="document.getElementById('sistem_mekanisme').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">2</span> <span>Sistem & Mekanisme</span></a></li>
                        <li><a href="#jangka_waktu" @click="document.getElementById('jangka_waktu').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">3</span> <span>Jangka Waktu Pelayanan</span></a></li>
                        <li><a href="#biaya" @click="document.getElementById('biaya').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">4</span> <span>Biaya / Tarif</span></a></li>
                        <li><a href="#produk" @click="document.getElementById('produk').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">5</span> <span>Produk Pelayanan</span></a></li>
                        <li><a href="#pengaduan" @click="document.getElementById('pengaduan').scrollIntoView({behavior:'smooth'})" class="hover:text-emerald-700 py-1.5 px-3 rounded-lg hover:bg-emerald-100/50 flex items-center gap-3 transition-colors"><span class="text-xs font-black px-2 py-0.5 rounded text-white shrink-0" style="background-color: #10b981;">6</span> <span>Penanganan Pengaduan</span></a></li>
                    </ul>
                </div>

                {{-- KARTU LAYANAN LAINNYA --}}
                @if($relatedLayanans->count() > 0)
                    <div class="rounded-3xl p-6 shadow-md" style="background-color: #ffffff; border: 1px solid #cbd5e1;">
                        <h4 class="text-base font-extrabold pb-3 mb-4 flex items-center gap-2.5" style="color: #047857; border-bottom: 1px solid #e2e8f0;">
                            <i class="ph-fill ph-grid-four text-xl" style="color: #059669;"></i> Layanan Sejenis Lainnya
                        </h4>
                        <div class="space-y-3">
                            @foreach($relatedLayanans as $rel)
                                <a href="{{ route('public.layanan.show', $rel->id) }}" class="block group p-3 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-200">
                                    <h5 class="text-sm font-black text-gray-900 group-hover:text-emerald-700 transition-colors mb-1 line-clamp-1">{{ $rel->judul }}</h5>
                                    @if($rel->deskripsi)
                                        <p class="text-xs text-gray-600 font-medium line-clamp-2 leading-relaxed">{{ $rel->deskripsi }}</p>
                                    @else
                                        <p class="text-xs text-gray-400 font-bold">-</p>
                                    @endif
                                </a>
                                @if(!$loop->last)
                                    <hr class="border-gray-100">
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- BANNER LAPOR / PENGADUAN (SOFT GREEN GRADIENT) --}}
                <a href="{{ route('public.pengaduan') }}" 
                   class="w-full p-6 text-white rounded-3xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group overflow-hidden relative block" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                    <div class="absolute right-0 -bottom-4 opacity-10 group-hover:scale-110 transition-transform pointer-events-none">
                        <i class="ph-fill ph-megaphone text-8xl text-white"></i>
                    </div>
                    <div class="flex items-center gap-4 relative z-10">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0" style="background-color: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);">
                            <i class="ph-bold ph-megaphone text-2xl text-white"></i>
                        </div>
                        <div>
                            <span class="text-xs font-extrabold uppercase tracking-wider block" style="color: #a7f3d0;">Ada Pengaduan atau Saran?</span>
                            <span class="text-lg font-black tracking-tight text-white block">LAPOR DI SINI!</span>
                        </div>
                    </div>
                    <i class="ph-bold ph-arrow-right text-xl text-white relative z-10 group-hover:translate-x-1 transition-transform"></i>
                </a>

            </div>

        </div>
    </div>
</x-public-layout>
