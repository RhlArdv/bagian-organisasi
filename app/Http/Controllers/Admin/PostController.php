<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\HtmlPurifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(private readonly HtmlPurifierService $purifier) {}

    public function index()
    {
        $posts = Post::with(['author', 'category'])->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'category_id' => 'nullable|exists:post_categories,id',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'thumbnail'   => 'nullable|image|max:2048',
        ], [
            'title.regex' => 'Kolom judul tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        $data = $request->only(['title', 'excerpt', 'status', 'category_id']);

        // Sanitize rich-text content via HTMLPurifier (fixes WEB-510025 Stored XSS)
        $data['content']   = $this->purifier->purify($request->input('content', ''));
        $data['slug']      = Str::slug($request->title) . '-' . Str::random(5);
        $data['author_id'] = Auth::id();

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'category_id' => 'nullable|exists:post_categories,id',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published,archived',
            'thumbnail'   => 'nullable|image|max:2048',
        ], [
            'title.regex' => 'Kolom judul tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        $data = $request->only(['title', 'excerpt', 'status', 'category_id']);

        // Sanitize rich-text content via HTMLPurifier (fixes WEB-510025 Stored XSS)
        $data['content'] = $this->purifier->purify($request->input('content', ''));

        if ($request->status === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil dihapus.');
    }
}
