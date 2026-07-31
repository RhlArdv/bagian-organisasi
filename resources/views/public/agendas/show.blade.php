<x-public-layout :title="$agenda->title . ' - Agenda & Aktivitas'">
{{-- ═══ HERO HEADER ═══ --}}
<section class="relative pt-32 pb-40 bg-[#0a0f1c] overflow-hidden text-white flex items-center">
    <div class="absolute inset-0 z-0">
        @if($agenda->image)
            <img src="{{ asset('storage/' . $agenda->image) }}" alt="Background" class="w-full h-full object-cover opacity-20 mix-blend-luminosity">
        @else
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&q=80" alt="Background" class="w-full h-full object-cover opacity-10 mix-blend-luminosity">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f1c] via-[#0a0f1c]/80 to-transparent"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-4xl mx-auto px-5 lg:px-8 text-center pt-10">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-500/20 text-brand-400 text-xs font-bold tracking-widest mb-6 border border-brand-500/30 uppercase backdrop-blur-sm">
            <i class="ph-bold ph-calendar-check"></i> Detail Agenda
        </div>
        <h1 class="text-4xl lg:text-5xl font-black mb-6 leading-tight">{{ $agenda->title }}</h1>
    </div>
</section>

{{-- ═══ AGENDA CONTENT ═══ --}}
<section class="pb-24 relative z-20 -mt-20">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">
            
            {{-- Main Content --}}
            <div class="lg:col-span-8 space-y-10">
                <div class="bg-white rounded-[2.5rem] p-8 sm:p-10 shadow-2xl shadow-gray-200/50 border border-gray-100">
                    
                    {{-- Info Cards Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-100/50 flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-xl shadow-sm text-blue-500 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-calendar text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal Kegiatan</p>
                                <p class="font-black text-gray-900">{{ $agenda->date->translatedFormat('l, d F Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-brand-50/50 rounded-2xl p-5 border border-brand-100/50 flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-xl shadow-sm text-brand-500 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-clock text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Waktu</p>
                                <p class="font-black text-gray-900">{{ $agenda->time ?: 'Menyesuaikan' }}</p>
                            </div>
                        </div>
                        
                        <div class="sm:col-span-2 bg-emerald-50/50 rounded-2xl p-5 border border-emerald-100/50 flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-xl shadow-sm text-emerald-500 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-map-pin text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Lokasi Kegiatan</p>
                                <p class="font-black text-gray-900">{{ $agenda->location }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose prose-lg max-w-none prose-headings:font-black prose-a:text-brand-500">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 border-b border-gray-100 pb-4">Keterangan Tambahan</h3>
                        @if($agenda->description)
                            {!! nl2br(e($agenda->description)) !!}
                        @else
                            <p class="text-gray-500 italic">Tidak ada keterangan tambahan untuk agenda ini.</p>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('public.agendas.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-xl text-gray-600 font-bold hover:bg-gray-50 transition-colors shadow-sm">
                        <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <button onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-50 text-brand-600 rounded-xl font-bold hover:bg-brand-100 transition-colors">
                        <i class="ph-bold ph-printer"></i> Cetak Agenda
                    </button>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4 space-y-8 mt-10 lg:mt-0">
                <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                    <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                        <i class="ph-bold ph-calendar-plus text-brand-500"></i> Agenda Mendatang
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($upcomingAgendas as $upcoming)
                            <a href="{{ route('public.agendas.show', $upcoming->id) }}" class="group flex gap-4 p-3 rounded-2xl hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-brand-50 text-brand-600 rounded-xl flex flex-col items-center justify-center font-black leading-none group-hover:bg-brand-500 group-hover:text-white transition-colors">
                                    <span class="text-lg">{{ $upcoming->date->format('d') }}</span>
                                    <span class="text-[9px] uppercase tracking-wider mt-0.5">{{ $upcoming->date->translatedFormat('M') }}</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-gray-900 text-sm line-clamp-2 leading-snug group-hover:text-brand-500 transition-colors mb-1">{{ $upcoming->title }}</h4>
                                    <p class="text-[11px] font-medium text-gray-500 flex items-center gap-1">
                                        <i class="ph-fill ph-map-pin"></i> <span class="line-clamp-1">{{ $upcoming->location }}</span>
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-6 bg-gray-50 rounded-xl">
                                <p class="text-sm text-gray-400 font-medium">Belum ada agenda mendatang</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
</x-public-layout>
