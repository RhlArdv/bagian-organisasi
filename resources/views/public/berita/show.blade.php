<x-public-layout :title="$post->title" :metaDescription="$post->excerpt ?? Str::limit(strip_tags($post->content), 160)">

    @push('styles')
    <style>
        /* Prose styling for article content */
        .article-content {
            font-size: 1rem;
            line-height: 1.85;
            color: #374151;
        }
        .article-content p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a202c;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }
        .article-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        .article-content li {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .article-content ul li { list-style-type: disc; }
        .article-content ol li { list-style-type: decimal; }
        .article-content blockquote {
            border-left: 4px solid #e2e8f0;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background: #f8fafc;
            border-radius: 0 1rem 1rem 0;
            font-style: italic;
            color: #64748b;
        }
        .article-content img {
            border-radius: 1.5rem;
            width: 100%;
            height: auto;
            margin: 2rem 0;
        }
        .article-content a {
            color: #475569;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .article-content a:hover { color: #1e293b; }
        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.875rem;
        }
        .article-content th, .article-content td {
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            text-align: left;
        }
        .article-content th {
            background: #f8fafc;
            font-weight: 700;
        }
    </style>
    @endpush

    {{-- PAGE HEADER --}}
    <section class="pb-4 mb-6 border-b border-gray-200/60 max-w-7xl mx-auto px-5 lg:px-8">
        <nav class="flex items-center gap-2 text-[12px] font-medium text-gray-500 flex-wrap">
            <a href="/" class="hover:text-brand-400 transition-colors text-[#1a202c]">Beranda</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <a href="{{ route('public.berita.index') }}" class="hover:text-brand-400 transition-colors text-[#1a202c]">Berita</a>
            <i class="ph-bold ph-caret-right text-[10px] text-gray-400"></i>
            <span class="text-gray-500 truncate max-w-[200px]">{{ $post->title }}</span>
        </nav>
    </section>

    {{-- ARTICLE --}}
    <article class="mb-16">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">

                {{-- MAIN CONTENT (8 cols) --}}
                <div class="lg:col-span-8">

                    {{-- Meta --}}
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        @if($post->category)
                            <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg">{{ $post->category->name }}</span>
                        @endif
                        @if($post->published_at)
                            <span class="text-sm text-gray-400 font-medium flex items-center gap-1.5">
                                <i class="ph ph-calendar-blank"></i> {{ $post->published_at->translatedFormat('d F Y') }}
                            </span>
                        @endif
                        <span class="text-sm text-gray-400 font-medium flex items-center gap-1.5">
                            <i class="ph ph-eye"></i> {{ number_format($post->views) }}x dilihat
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl lg:text-[2.75rem] font-black text-[#1a202c] leading-[1.15] tracking-tight mb-8">
                        {{ $post->title }}
                    </h1>

                    {{-- Author --}}
                    @if($post->author)
                        <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="ph-fill ph-user text-lg text-gray-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#1a202c]">{{ $post->author->name }}</p>
                                <p class="text-xs text-gray-400 font-medium">Penulis</p>
                            </div>
                        </div>
                    @endif

                    {{-- Featured Image --}}
                    @if($post->thumbnail)
                        <div class="mb-10 rounded-[2rem] overflow-hidden shadow-lg">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                 class="w-full aspect-[16/9] object-cover">
                        </div>
                    @endif

                    {{-- Excerpt (Lead paragraph) --}}
                    @if($post->excerpt)
                        <p class="text-lg lg:text-xl text-gray-600 font-semibold leading-relaxed mb-8 border-l-4 border-brand-400 pl-6">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    {{-- Article Body --}}
                    <div class="article-content">
                        {!! $post->content !!}
                    </div>

                    {{-- Share & Back --}}
                    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#1a202c] transition-colors group">
                            <i class="ph-bold ph-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Berita
                        </a>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bagikan:</span>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' — ' . url()->current()) }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center hover:bg-emerald-100 transition-colors">
                                <i class="ph-fill ph-whatsapp-logo"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                <i class="ph-fill ph-facebook-logo"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href); this.querySelector('i').className='ph-fill ph-check'; setTimeout(() => this.querySelector('i').className='ph-fill ph-link', 2000)"
                                    class="w-9 h-9 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition-colors">
                                <i class="ph-fill ph-link"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR (4 cols) --}}
                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-32 space-y-8">

                        {{-- Related Posts --}}
                        @if($relatedPosts->count() > 0)
                            <div>
                                <h4 class="text-lg font-black text-[#1a202c] mb-5 flex items-center gap-2">
                                    <i class="ph-fill ph-newspaper text-brand-400"></i> Berita Terkait
                                </h4>
                                <div class="space-y-4">
                                    @foreach($relatedPosts as $related)
                                        <a href="{{ route('public.berita.show', $related->slug) }}"
                                           class="group flex gap-4 bg-white p-4 rounded-2xl border border-gray-100 hover:border-brand-200 hover:shadow-lg transition-all duration-300">
                                            <div class="w-20 h-16 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                                                @if($related->thumbnail)
                                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                                        <i class="ph-duotone ph-newspaper text-xl text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h5 class="text-sm font-bold text-[#1a202c] group-hover:text-brand-500 transition-colors line-clamp-2 leading-snug">{{ $related->title }}</h5>
                                                @if($related->published_at)
                                                    <span class="text-[11px] text-gray-400 font-medium mt-1 block">{{ $related->published_at->translatedFormat('d M Y') }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Quick Links --}}
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-[2rem] p-7 border border-gray-100">
                            <h4 class="text-lg font-black text-[#1a202c] mb-5 flex items-center gap-2">
                                <i class="ph-fill ph-link text-brand-400"></i> Tautan Terkait
                            </h4>
                            <div class="space-y-3">
                                <a href="{{ route('public.reformasi-birokrasi') }}" class="flex items-center gap-3 text-sm font-bold text-gray-600 hover:text-brand-500 transition-colors group">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="ph-bold ph-trend-up text-sm"></i>
                                    </div>
                                    Reformasi Birokrasi
                                </a>
                                <a href="{{ route('public.kelembagaan') }}" class="flex items-center gap-3 text-sm font-bold text-gray-600 hover:text-brand-500 transition-colors group">
                                    <div class="w-8 h-8 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="ph-bold ph-tree-structure text-sm"></i>
                                    </div>
                                    Penataan Kelembagaan
                                </a>
                                <a href="https://www.lapor.go.id/" target="_blank" class="flex items-center gap-3 text-sm font-bold text-gray-600 hover:text-brand-500 transition-colors group">
                                    <div class="w-8 h-8 bg-red-50 text-red-500 rounded-lg flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="ph-bold ph-megaphone text-sm"></i>
                                    </div>
                                    Layanan Pengaduan
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>

</x-public-layout>
