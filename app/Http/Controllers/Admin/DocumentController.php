<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kategori_slug)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();
        $documents = Document::where('category_id', $kategori->id)->latest()->get();

        return view('admin.documents.index', compact('documents', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori_slug)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();
        return view('admin.documents.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kategori_slug)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_number' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:20480', // max 20MB
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'category_id' => $kategori->id,
            'uploaded_by' => auth()->id(),
            'title' => $validated['title'],
            'document_number' => $validated['document_number'],
            'year' => $validated['year'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'file_type' => $request->file('file')->getClientOriginalExtension(),
            'file_size' => $request->file('file')->getSize(),
        ]);

        return redirect()->route('documents.index', $kategori->slug)->with('success', 'Dokumen berhasil diunggah.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kategori_slug, $id)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();
        $document = Document::where('category_id', $kategori->id)->findOrFail($id);

        return view('admin.documents.edit', compact('document', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kategori_slug, $id)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();
        $document = Document::where('category_id', $kategori->id)->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_number' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $data = [
            'title' => $validated['title'],
            'document_number' => $validated['document_number'],
            'year' => $validated['year'],
            'description' => $validated['description'],
        ];

        if ($request->hasFile('file')) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $data['file_path'] = $request->file('file')->store('documents', 'public');
            $data['file_type'] = $request->file('file')->getClientOriginalExtension();
            $data['file_size'] = $request->file('file')->getSize();
        }

        $document->update($data);

        return redirect()->route('documents.index', $kategori->slug)->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kategori_slug, $id)
    {
        $kategori = DocumentCategory::where('slug', $kategori_slug)->firstOrFail();
        $document = Document::where('category_id', $kategori->id)->findOrFail($id);

        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents.index', $kategori->slug)->with('success', 'Dokumen berhasil dihapus.');
    }
}
