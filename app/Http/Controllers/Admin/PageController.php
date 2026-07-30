<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::orderBy('id', 'asc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'] ?? '',
            'updated_by' => Auth::id(),
        ];

        if ($request->hasFile('featured_image')) {
            // Hapus gambar lama jika ada
            if ($page->featured_image && Storage::disk('public')->exists($page->featured_image)) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $page->update($data);

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }
}
