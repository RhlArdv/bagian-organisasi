<x-public-layout :title="'Agenda & Aktivitas - Bagian Organisasi'">
{{-- ═══ HERO SECTION ═══ --}}
<section class="relative pt-32 pb-20 bg-[#0a0f1c] overflow-hidden text-white min-h-[40vh] flex items-center">
    {{-- Glow Effects --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-5xl h-full pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-brand-500/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/20 rounded-full blur-[100px]"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-5 lg:px-8">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-white text-xs font-bold tracking-widest mb-6 border border-white/10 uppercase">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span> Jadwal Kegiatan
            </div>
            <h1 class="text-4xl lg:text-6xl font-black mb-6 leading-tight tracking-tight">
                Agenda & Aktivitas <br>
                <span class="text-brand-500 font-script font-normal text-6xl lg:text-7xl">Organisasi</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl font-medium leading-relaxed mb-8">
                Pantau seluruh jadwal kegiatan, rapat koordinasi, dan agenda penting Bagian Organisasi secara transparan dan up-to-date.
            </p>

            <form action="{{ route('public.agendas.index') }}" method="GET" class="relative max-w-xl">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama kegiatan atau lokasi..." class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-400 rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all font-medium backdrop-blur-md">
                <i class="ph-bold ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-brand-500 text-white p-2.5 rounded-xl hover:bg-brand-600 transition-colors">
                    <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ═══ AGENDA LIST ═══ --}}
<section class="py-20 bg-gray-50 relative">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        
        @if(request('q'))
            <div class="mb-10 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Hasil pencarian untuk: <span class="text-brand-500">"{{ request('q') }}"</span></h3>
                <a href="{{ route('public.agendas.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm transition-all">Reset</a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($agendas as $agenda)
                <div class="group bg-white rounded-[2rem] border border-gray-100 p-3 shadow-sm hover:shadow-2xl hover:shadow-brand-500/5 hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    <div class="relative w-full aspect-[4/3] rounded-[1.5rem] overflow-hidden mb-5">
                        @if($agenda->image)
                            <img src="{{ asset('storage/' . $agenda->image) }}" alt="{{ $agenda->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#0a0f1c] to-slate-800 relative">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80" alt="Placeholder" class="w-full h-full object-cover opacity-40 mix-blend-overlay group-hover:scale-110 transition-transform duration-700">
                            </div>
                        @endif
                        
                        {{-- Date Floating Badge --}}
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2 text-center shadow-lg border border-white">
                            <span class="block text-2xl font-black text-brand-500 leading-none mb-1">{{ $agenda->date->format('d') }}</span>
                            <span class="block text-[10px] font-bold text-gray-900 uppercase tracking-widest">{{ $agenda->date->translatedFormat('M y') }}</span>
                        </div>
                    </div>
                    
                    <div class="px-3 pb-4 flex flex-col flex-1">
                        <h3 class="text-xl font-extrabold text-gray-900 mb-4 leading-snug group-hover:text-brand-500 transition-colors line-clamp-2">
                            <a href="{{ route('public.agendas.show', $agenda->id) }}" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                {{ $agenda->title }}
                            </a>
                        </h3>
                        
                        <div class="flex flex-col gap-3 mt-auto pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2.5 text-sm font-medium text-gray-500">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                    <i class="ph-fill ph-map-pin text-lg"></i>
                                </div>
                                <span class="line-clamp-1">{{ $agenda->location }}</span>
                            </div>
                            @if($agenda->time)
                            <div class="flex items-center gap-2.5 text-sm font-medium text-gray-500">
                                <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
                                    <i class="ph-fill ph-clock text-lg"></i>
                                </div>
                                <span>{{ $agenda->time }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border border-gray-100 shadow-sm">
                    <div class="w-24 h-24 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-calendar-blank text-5xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-3">Tidak Ada Agenda</h3>
                    <p class="text-gray-500 font-medium">Belum ada jadwal kegiatan yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($agendas->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>
</section>
</x-public-layout>
