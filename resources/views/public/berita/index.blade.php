<x-public-layout :title="'Berita & Informasi'" :metaDescription="'Berita terbaru, kegiatan, dan informasi publik dari Bagian Organisasi Sekretariat Daerah Kota Padang'">

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-8 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <h1 class="text-[28px] lg:text-3xl font-black text-[#1a202c] tracking-tight mb-2">Berita & Informasi</h1>
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500">Berita</span>
        </nav>
    </section>

    {{-- HERO BANNER --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="relative bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-slate-800 rounded-[2.5rem] p-10 lg:p-16 text-white overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4 pointer-events-none">
                    <i class="ph-duotone ph-newspaper text-[20rem]"></i>
                </div>
                <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="relative z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Media Center
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black mb-4 leading-tight tracking-tight">Kabar Terkini<br>Bagian Organisasi</h2>
                    <p class="text-gray-300 font-medium leading-relaxed text-sm lg:text-base opacity-90 max-w-lg">
                        Ikuti perkembangan terbaru tentang kegiatan, regulasi, dan capaian Bagian Organisasi Sekretariat Daerah Kota Padang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- FILTER & CONTENT --}}
    <section class="mb-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">

            {{-- Category Filter Pills --}}
            <div class="flex flex-wrap gap-2 mb-10">
                <a href="{{ route('public.berita.index') }}"
                   class="px-5 py-2.5 text-sm font-bold rounded-full transition-all duration-200 {{ $activeKategori === 'semua' ? 'bg-[#1e293b] text-white shadow-lg' : 'bg-white text-gray-600 border border-gray-200 hover:border-gray-400 hover:text-gray-900' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.berita.index', ['kategori' => $cat->slug]) }}"
                       class="px-5 py-2.5 text-sm font-bold rounded-full transition-all duration-200 {{ $activeKategori === $cat->slug ? 'bg-[#1e293b] text-white shadow-lg' : 'bg-white text-gray-600 border border-gray-200 hover:border-gray-400 hover:text-gray-900' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            @if($posts->count() > 0)
                {{-- News Grid --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($posts as $post)
                        <a href="{{ route('public.berita.show', $post->slug) }}"
                           class="group bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

                            {{-- Thumbnail --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-gray-100">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <i class="ph-duotone ph-newspaper text-5xl text-gray-400"></i>
                                    </div>
                                @endif

                                {{-- Date Badge --}}
                                @if($post->published_at)
                                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md rounded-xl px-3 py-2 text-center shadow-lg min-w-[3rem]">
                                        <span class="block text-lg font-black text-gray-900 leading-none">{{ $post->published_at->format('d') }}</span>
                                        <span class="block text-[10px] font-bold text-brand-500 mt-0.5 uppercase tracking-wider">{{ $post->published_at->translatedFormat('M') }}</span>
                                    </div>
                                @endif

                                {{-- Category Badge --}}
                                @if($post->category)
                                    <div class="absolute top-4 right-4">
                                        <span class="text-[10px] font-bold uppercase tracking-wider bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-lg shadow-sm text-gray-700">{{ $post->category->name }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-6 lg:p-7 flex flex-col flex-1">
                                <h3 class="text-lg font-extrabold text-[#1a202c] leading-snug group-hover:text-brand-500 transition-colors line-clamp-2 mb-3">
                                    {{ $post->title }}
                                </h3>
                                @if($post->excerpt)
                                    <p class="text-sm text-gray-500 font-medium leading-relaxed line-clamp-2 mb-4 flex-1">{{ $post->excerpt }}</p>
                                @endif
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                    <div class="flex items-center gap-3">
                                        @if($post->author)
                                            <div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="ph-fill ph-user text-xs text-gray-500"></i>
                                            </div>
                                            <span class="text-xs text-gray-400 font-medium">{{ $post->author->name }}</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                                        <span class="flex items-center gap-1"><i class="ph ph-eye"></i> {{ number_format($post->views) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="mt-12 flex justify-center">
                        <div class="inline-flex items-center gap-2">
                            {{-- Previous --}}
                            @if($posts->onFirstPage())
                                <span class="w-10 h-10 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center cursor-not-allowed">
                                    <i class="ph-bold ph-caret-left"></i>
                                </span>
                            @else
                                <a href="{{ $posts->previousPageUrl() }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all">
                                    <i class="ph-bold ph-caret-left"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($posts->getUrlRange(max(1, $posts->currentPage() - 2), min($posts->lastPage(), $posts->currentPage() + 2)) as $page => $url)
                                <a href="{{ $url }}"
                                   class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all {{ $page == $posts->currentPage() ? 'bg-[#1e293b] text-white shadow-lg' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100' }}">
                                    {{ $page }}
                                </a>
                            @endforeach

                            {{-- Next --}}
                            @if($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all">
                                    <i class="ph-bold ph-caret-right"></i>
                                </a>
                            @else
                                <span class="w-10 h-10 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center cursor-not-allowed">
                                    <i class="ph-bold ph-caret-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    <p class="text-center text-xs text-gray-400 font-medium mt-4">
                        Menampilkan {{ $posts->firstItem() }}-{{ $posts->lastItem() }} dari {{ $posts->total() }} berita
                    </p>
                @endif
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <i class="ph-duotone ph-newspaper text-5xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-300 mb-3">
                        @if($activeKategori !== 'semua')
                            Belum Ada Berita di Kategori Ini
                        @else
                            Belum Ada Berita
                        @endif
                    </h3>
                    <p class="text-sm text-gray-400 font-medium max-w-md mx-auto">
                        @if($activeKategori !== 'semua')
                            Coba lihat kategori lain atau kembali ke <a href="{{ route('public.berita.index') }}" class="text-brand-500 hover:underline font-bold">semua berita</a>.
                        @else
                            Berita akan ditampilkan setelah dipublikasikan oleh admin.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>

</x-public-layout>
