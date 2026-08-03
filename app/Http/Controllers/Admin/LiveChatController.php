<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveChatController extends Controller
{
    /**
     * Menampilkan antarmuka pengelola pesan obrolan (Live Chat).
     */
    public function index(Request $request)
    {
        $query = ChatSession::with(['latestMessage'])
            ->orderByDesc('unread_admin')
            ->orderByDesc('last_message_at');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $sessions = $query->get();

        $activeSession = null;
        if ($request->filled('active')) {
            $activeSession = ChatSession::with(['messages.senderAdmin'])->find($request->active);
        } elseif ($sessions->isNotEmpty()) {
            $activeSession = ChatSession::with(['messages.senderAdmin'])->find($sessions->first()->id);
        }

        if ($activeSession && $activeSession->unread_admin > 0) {
            $activeSession->update(['unread_admin' => 0]);
            $activeSession->messages()
                ->where('sender_type', 'visitor')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return view('admin.live_chat.index', compact('sessions', 'activeSession'));
    }

    /**
     * Endpoint polling JSON untuk mengambil pesan di sisi admin (tanpa refresh).
     */
    public function messages(ChatSession $session)
    {
        if ($session->unread_admin > 0) {
            $session->update(['unread_admin' => 0]);
            $session->messages()
                ->where('sender_type', 'visitor')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        $messages = $session->messages()->with('senderAdmin')->get()->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender_type' => $msg->sender_type,
                'sender_name' => $msg->sender_type === 'admin' ? ($msg->senderAdmin->name ?? 'Admin') : 'Pengunjung',
                'message' => $msg->message,
                'time' => $msg->created_at ? $msg->created_at->format('H:i') : '',
            ];
        });

        return response()->json([
            'status' => 'success',
            'session' => [
                'id' => $session->id,
                'ip_address' => $session->ip_address,
                'visitor_name' => $session->visitor_name,
                'status' => $session->status,
            ],
            'messages' => $messages,
        ]);
    }

    /**
     * Admin membalas obrolan ke pengunjung (via JSON/AJAX atau form konvensional).
     */
    public function reply(Request $request, ChatSession $session)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:2000', 'regex:/^[^<>=]+$/'],
        ], [
            'message.regex' => 'Balasan tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'message.required' => 'Pesan balasan wajib diisi.',
        ]);

        // Pencegahan duplikasi pengiriman balasan admin dalam waktu 2 detik
        $existing = ChatMessage::where('chat_session_id', $session->id)
            ->where('sender_type', 'admin')
            ->where('message', $request->message)
            ->where('created_at', '>=', now()->subSeconds(2))
            ->first();

        if (!$existing) {
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender_type' => 'admin',
                'user_id' => Auth::id(),
                'message' => $request->message,
                'is_read' => false,
            ]);

            $session->increment('unread_visitor');
            $session->update([
                'last_message_at' => now(),
                'unread_admin' => 0,
            ]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return $this->messages($session);
        }

        return redirect()->route('admin.live-chat.index', ['active' => $session->id]);
    }

    /**
     * Menutup atau mengaktifkan kembali sesi obrolan.
     */
    public function updateStatus(Request $request, ChatSession $session)
    {
        $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $session->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status obrolan diperbarui menjadi ' . strtoupper($request->status));
    }

    /**
     * Hapus riwayat obrolan tertentu.
     */
    public function destroy(ChatSession $session)
    {
        $session->delete();
        return redirect()->route('admin.live-chat.index')->with('success', 'Sesi obrolan berhasil dihapus.');
    }
}
