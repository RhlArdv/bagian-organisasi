<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Public-facing controller for news/berita pages.
 *
 * Provides: landing page section data, paginated index, and detail view.
 */
class PublicBeritaController extends Controller
{
    /**
     * All news — paginated, filterable by category.
     */
    public function index(Request $request)
    {
        $categories = PostCategory::orderBy('name')->get();

        $query = Post::published()->with(['category', 'author']);

        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $category = PostCategory::where('slug', $request->kategori)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $posts = $query->paginate(9)->withQueryString();
        $activeKategori = $request->kategori ?? 'semua';

        return view('public.berita.index', compact('posts', 'categories', 'activeKategori'));
    }

    /**
     * Single news detail page.
     */
    public function show(string $slug)
    {
        $correlationId = uniqid('berita_view_', true);
        Log::info('Berita detail viewed', [
            'correlationId' => $correlationId,
            'operation' => 'view_berita',
            'slug' => $slug,
        ]);

        $post = Post::published()
            ->with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $post->incrementViews();

        // Related posts: same category, excluding current
        $relatedPosts = Post::published()
            ->with('category')
            ->where('id', '!=', $post->id)
            ->when($post->category_id, function ($q) use ($post) {
                $q->where('category_id', $post->category_id);
            })
            ->limit(3)
            ->get();

        // If not enough related, fill with latest posts
        if ($relatedPosts->count() < 3) {
            $remaining = 3 - $relatedPosts->count();
            $moreIds = $relatedPosts->pluck('id')->push($post->id);
            $morePosts = Post::published()
                ->with('category')
                ->whereNotIn('id', $moreIds)
                ->limit($remaining)
                ->get();
            $relatedPosts = $relatedPosts->merge($morePosts);
        }

        Log::info('Berita detail loaded', [
            'correlationId' => $correlationId,
            'operation' => 'view_berita',
            'postId' => $post->id,
            'views' => $post->views,
        ]);

        return view('public.berita.show', compact('post', 'relatedPosts'));
    }
}
