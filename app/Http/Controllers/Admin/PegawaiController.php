<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::orderBy('order_index')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Pegawai::whereIn('level', ['kepala', 'kasubag'])->get();
        return view('admin.pegawai.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:pegawai',
            'nama' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'jabatan' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'pangkat_golongan' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'level' => 'required|in:kepala,kasubag,staf',
            'parent_id' => 'nullable|exists:pegawai,id',
            'order_index' => 'required|integer',
            'is_active' => 'boolean',
        ], [
            'nama.regex' => 'Kolom nama tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'jabatan.regex' => 'Kolom jabatan tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $parents = Pegawai::whereIn('level', ['kepala', 'kasubag'])->where('id', '!=', $pegawai->id)->get();
        return view('admin.pegawai.edit', compact('pegawai', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:pegawai,nip,' . $pegawai->id,
            'nama' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'jabatan' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'pangkat_golongan' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'level' => 'required|in:kepala,kasubag,staf',
            'parent_id' => 'nullable|exists:pegawai,id',
            'order_index' => 'required|integer',
        ], [
            'nama.regex' => 'Kolom nama tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'jabatan.regex' => 'Kolom jabatan tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        if ($request->hasFile('foto')) {
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }
        
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
