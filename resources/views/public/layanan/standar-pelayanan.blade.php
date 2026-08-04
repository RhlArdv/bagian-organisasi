<x-public-layout :title="'Standar Pelayanan'" :metaDescription="'Standar pelayanan publik Bagian Organisasi Kota Padang — jaminan kepastian layanan prima bagi masyarakat'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Standar Pelayanan</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-emerald-600 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Standar Pelayanan</span>
        </nav>
    </section>

    {{-- HERO CARD --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative rounded-[2.5rem] p-10 lg:p-14 transition-all duration-300 overflow-hidden" style="background-color: #ffffff; border: 2px solid #a7f3d0; box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.08);">
                <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full opacity-50 pointer-events-none" style="background-color: #ecfdf5;"></div>
                <div class="absolute bottom-0 right-0 opacity-[0.04] pointer-events-none" style="color: #059669;">
                    <i class="ph-fill ph-star text-[16rem]"></i>
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0 shadow-sm" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="ph-bold ph-star text-4xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-black mb-3 tracking-tight" style="color: #0f172a;">Standar Pelayanan Publik</h2>
                        <p class="font-medium leading-relaxed max-w-2xl text-sm lg:text-base" style="color: #334155;">
                            Tolak ukur kualitas pelayanan publik sebagai jaminan kepastian layanan prima kepada masyarakat. 
                            Setiap layanan memiliki standar yang jelas meliputi persyaratan, mekanisme, biaya, dan jangka waktu penyelesaian.
                        </p>
                    </div>
                    <div class="shrink-0 rounded-2xl px-6 py-4 text-center shadow-sm" style="background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                        <span class="block text-3xl font-black" style="color: #047857;">{{ $layanans->count() }}</span>
                        <span class="text-[11px] font-black uppercase tracking-widest" style="color: #059669;">Standar</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STANDAR PELAYANAN LIST (CARDS IN SOFT GREEN) --}}
    <section class="pb-24">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <h3 class="text-xl font-black mb-6 flex items-center gap-3" style="color: #047857;">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                    <i class="ph-bold ph-star text-xl"></i>
                </div>
                Daftar Standar Pelayanan
            </h3>

            @if($layanans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($layanans as $layanan)
                        <div class="group rounded-[2rem] p-7 lg:p-8 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between relative overflow-hidden" style="background-color: #ffffff; border: 2px solid #cbd5e1; box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);">
                            {{-- Aksen Dekoratif Atas (Soft Green Gradient) --}}
                            <div class="absolute top-0 left-0 right-0 h-2" style="background: linear-gradient(90deg, #059669 0%, #34d399 100%);"></div>

                            <div>
                                {{-- Icon & Tag --}}
                                <div class="flex items-center justify-between gap-4 mb-6 pt-2 relative z-10">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-sm" style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #059669;">
                                        <i class="ph-bold ph-star"></i>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-black tracking-wide shadow-sm" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                                        <i class="ph-fill ph-check-circle text-emerald-600"></i> Standar Pelayanan
                                    </span>
                                </div>

                                {{-- Judul & Deskripsi (Strictly Database) --}}
                                <h4 class="text-lg lg:text-xl font-black transition-colors duration-200 mb-3 leading-snug relative z-10" style="color: #0f172a;">
                                    <a href="{{ route('public.layanan.show', $layanan->id) }}" class="hover:text-emerald-700 focus:outline-none block">
                                        {{ $layanan->judul }}
                                    </a>
                                </h4>
                                <p class="text-sm font-medium line-clamp-3 leading-relaxed mb-8 relative z-10" style="color: #334155;">
                                    {{ $layanan->deskripsi ?: '-' }}
                                </p>
                            </div>

                            {{-- Footer Kartu --}}
                            <div class="pt-5 flex items-center justify-end mt-auto relative z-10" style="border-top: 1px solid #e2e8f0;">
                                <a href="{{ route('public.layanan.show', $layanan->id) }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-md hover:opacity-90 transition-all duration-300" style="background-color: #059669; color: #ffffff;">
                                    <span>Lihat Detail</span>
                                    <i class="ph-bold ph-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-[2.5rem] p-16 text-center shadow-sm" style="background-color: #ffffff; border: 1px solid #cbd5e1;">
                    <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6" style="background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                        <i class="ph-duotone ph-star text-5xl" style="color: #059669;"></i>
                    </div>
                    <h4 class="text-xl font-black mb-3" style="color: #0f172a;">Belum Ada Standar Pelayanan</h4>
                    <p class="text-sm font-medium max-w-md mx-auto" style="color: #64748b;">Data standar pelayanan akan ditampilkan setelah diinput melalui dashboard.</p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
