<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order_index')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        // Mendapatkan order_index terakhir
        $lastOrder = Faq::max('order_index') ?? 0;
        $nextOrder = $lastOrder + 1;

        return view('admin.faqs.create', compact('nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order_index' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'order_index' => $request->order_index,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order_index' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'order_index' => $request->order_index,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
