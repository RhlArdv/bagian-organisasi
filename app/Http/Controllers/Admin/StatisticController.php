<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::orderBy('order')->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon'  => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'order' => 'required|integer'
        ]);

        Statistic::create($request->all());

        return redirect()->route('statistics.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon'  => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'order' => 'required|integer'
        ]);

        $statistic->update($request->all());

        return redirect()->route('statistics.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        return redirect()->route('statistics.index')->with('success', 'Statistik berhasil dihapus.');
    }
}
