<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('date', 'desc')->paginate(10);
        return view('admin.agendas.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'time'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('agendas', 'public');
        }

        Agenda::create($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'time'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($agenda->image) {
                Storage::disk('public')->delete($agenda->image);
            }
            $validated['image'] = $request->file('image')->store('agendas', 'public');
        }

        $agenda->update($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->image) {
            Storage::disk('public')->delete($agenda->image);
        }
        $agenda->delete();
        
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
