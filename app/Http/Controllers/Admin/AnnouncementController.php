<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest('published_at')->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'nullable|string',
            'published_at' => 'required|date',
            'expired_at'   => 'nullable|date|after:published_at',
            'attachment'   => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'published_at', 'expired_at']);
        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('announcements', 'public');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements/images', 'public');
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'nullable|string',
            'published_at' => 'required|date',
            'expired_at'   => 'nullable|date|after:published_at',
            'attachment'   => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'published_at', 'expired_at']);
        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('attachment')) {
            if ($announcement->attachment) {
                Storage::disk('public')->delete($announcement->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('announcements', 'public');
        }

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements/images', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->attachment) {
            Storage::disk('public')->delete($announcement->attachment);
        }
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
