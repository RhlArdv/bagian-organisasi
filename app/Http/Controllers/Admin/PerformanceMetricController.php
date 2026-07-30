<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerformanceMetric;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PerformanceMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metrics = PerformanceMetric::orderBy('year', 'desc')->orderBy('type', 'asc')->get();
        return view('admin.metrics.index', compact('metrics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metrics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:NILAI_RB,NILAI_SAKIP,IKM,JUMLAH_OPD',
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:' . (date('Y') + 5),
                Rule::unique('performance_metrics')->where(function ($query) use ($request) {
                    return $query->where('type', $request->type)
                                 ->where('year', $request->year);
                })
            ],
            'score' => 'required|numeric|min:0',
            'predicate' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        PerformanceMetric::create($validated);

        return redirect()->route('metrics.index')->with('success', 'Data Indikator Kinerja berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerformanceMetric $metric)
    {
        return view('admin.metrics.edit', compact('metric'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerformanceMetric $metric)
    {
        $validated = $request->validate([
            'type' => 'required|in:NILAI_RB,NILAI_SAKIP,IKM,JUMLAH_OPD',
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:' . (date('Y') + 5),
                Rule::unique('performance_metrics')->ignore($metric->id)->where(function ($query) use ($request) {
                    return $query->where('type', $request->type)
                                 ->where('year', $request->year);
                })
            ],
            'score' => 'required|numeric|min:0',
            'predicate' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $metric->update($validated);

        return redirect()->route('metrics.index')->with('success', 'Data Indikator Kinerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerformanceMetric $metric)
    {
        $metric->delete();
        return redirect()->route('metrics.index')->with('success', 'Data Indikator Kinerja berhasil dihapus.');
    }
}
