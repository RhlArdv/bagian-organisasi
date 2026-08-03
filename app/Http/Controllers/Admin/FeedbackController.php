<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback (kritik/saran & pengaduan).
     */
    public function index(Request $request)
    {
        $query = Feedback::with('repliedBy')->orderBy('created_at', 'desc');

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $feedbacks = $query->paginate(15)->withQueryString();

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        $feedback->load('repliedBy');
        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Update status or reply notes for feedback.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'reply_message' => ['nullable', 'string', 'max:2500', 'regex:/^[^<>=]+$/'],
        ], [
            'reply_message.regex' => 'Catatan/tanggapan tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        $data = [
            'status' => $validated['status'],
            'reply_message' => $validated['reply_message'] ?? null,
        ];

        if (!empty($validated['reply_message']) && !$feedback->replied_at) {
            $data['replied_by'] = Auth::id();
            $data['replied_at'] = now();
        } elseif (!empty($validated['reply_message'])) {
            $data['replied_by'] = Auth::id();
        }

        $feedback->update($data);

        return redirect()->route('feedbacks.show', $feedback)->with('success', 'Status dan tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Data masukan berhasil dihapus.');
    }
}
