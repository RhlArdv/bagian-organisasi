<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    private $categories = [
        'penataan-kelembagaan' => 'Penataan Kelembagaan',
        'evaluasi-kelembagaan' => 'Evaluasi Kelembagaan',
        'nomenklatur-opd' => 'Nomenklatur OPD',
        // Pelayanan Publik
        'standar-pelayanan' => 'Standar Pelayanan',
        'forum-konsultasi-publik' => 'Forum Konsultasi Publik',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index($kategori)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $nama_kategori = $this->categories[$kategori];
        $layanans = Layanan::where('kategori', $kategori)->latest()->get();

        return view('admin.layanan.index', compact('layanans', 'kategori', 'nama_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $nama_kategori = $this->categories[$kategori];
        return view('admin.layanan.create', compact('kategori', 'nama_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kategori)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dasar_hukum' => 'nullable|string',
            'maklumat_image' => 'nullable|image|max:5120',
            'persyaratan' => 'nullable|string',
            'sistem_mekanisme' => 'nullable|string',
            'flowchart_image' => 'nullable|image|max:5120',
            'jangka_waktu' => 'nullable|string|max:255',
            'biaya' => 'nullable|string|max:255',
            'produk_pelayanan' => 'nullable|string|max:255',
            'pengaduan' => 'nullable|string',
            'informasi_tambahan' => 'nullable|string',
            'link_sippn' => 'nullable|url|max:255',
            'file_download' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $validated['kategori'] = $kategori;

        if ($request->hasFile('maklumat_image')) {
            $validated['maklumat_image'] = $request->file('maklumat_image')->store('layanan/images', 'public');
        }
        if ($request->hasFile('flowchart_image')) {
            $validated['flowchart_image'] = $request->file('flowchart_image')->store('layanan/images', 'public');
        }
        if ($request->hasFile('file_download')) {
            $validated['file_download'] = $request->file('file_download')->store('layanan/files', 'public');
        }

        Layanan::create($validated);

        return redirect()->route('layanan.index', $kategori)->with('success', 'Data layanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kategori, $id)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $layanan = Layanan::where('kategori', $kategori)->findOrFail($id);
        $nama_kategori = $this->categories[$kategori];

        return view('admin.layanan.edit', compact('layanan', 'kategori', 'nama_kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kategori, $id)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $layanan = Layanan::where('kategori', $kategori)->findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dasar_hukum' => 'nullable|string',
            'maklumat_image' => 'nullable|image|max:5120',
            'persyaratan' => 'nullable|string',
            'sistem_mekanisme' => 'nullable|string',
            'flowchart_image' => 'nullable|image|max:5120',
            'jangka_waktu' => 'nullable|string|max:255',
            'biaya' => 'nullable|string|max:255',
            'produk_pelayanan' => 'nullable|string|max:255',
            'pengaduan' => 'nullable|string',
            'informasi_tambahan' => 'nullable|string',
            'link_sippn' => 'nullable|url|max:255',
            'file_download' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('maklumat_image')) {
            if ($layanan->maklumat_image && Storage::disk('public')->exists($layanan->maklumat_image)) {
                Storage::disk('public')->delete($layanan->maklumat_image);
            }
            $validated['maklumat_image'] = $request->file('maklumat_image')->store('layanan/images', 'public');
        }
        if ($request->hasFile('flowchart_image')) {
            if ($layanan->flowchart_image && Storage::disk('public')->exists($layanan->flowchart_image)) {
                Storage::disk('public')->delete($layanan->flowchart_image);
            }
            $validated['flowchart_image'] = $request->file('flowchart_image')->store('layanan/images', 'public');
        }
        if ($request->hasFile('file_download')) {
            if ($layanan->file_download && Storage::disk('public')->exists($layanan->file_download)) {
                Storage::disk('public')->delete($layanan->file_download);
            }
            $validated['file_download'] = $request->file('file_download')->store('layanan/files', 'public');
        }

        $layanan->update($validated);

        return redirect()->route('layanan.index', $kategori)->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kategori, $id)
    {
        if (!array_key_exists($kategori, $this->categories)) {
            abort(404);
        }

        $layanan = Layanan::where('kategori', $kategori)->findOrFail($id);

        if ($layanan->maklumat_image && Storage::disk('public')->exists($layanan->maklumat_image)) {
            Storage::disk('public')->delete($layanan->maklumat_image);
        }
        if ($layanan->flowchart_image && Storage::disk('public')->exists($layanan->flowchart_image)) {
            Storage::disk('public')->delete($layanan->flowchart_image);
        }
        if ($layanan->file_download && Storage::disk('public')->exists($layanan->file_download)) {
            Storage::disk('public')->delete($layanan->file_download);
        }

        $layanan->delete();

        return redirect()->route('layanan.index', $kategori)->with('success', 'Data layanan berhasil dihapus.');
    }
}
