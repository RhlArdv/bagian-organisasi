<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class LiveChatController extends Controller
{
    /**
     * Memuat riwayat obrolan untuk tamu (dikunci oleh IP address dan token).
     */
    public function load(Request $request)
    {
        $session = ChatSession::findOrCreateForVisitor($request);

        // Jika widget sedang dibuka oleh visitor, tandai pesan admin sebagai sudah dibaca
        if ($request->boolean('mark_read')) {
            if ($session->unread_visitor > 0) {
                $session->update(['unread_visitor' => 0]);
            }
            $session->messages()
                ->where('sender_type', 'admin')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        $messages = $session->messages()->with('senderAdmin')->get()->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender_type' => $msg->sender_type,
                'sender_name' => $msg->sender_type === 'admin' ? ($msg->senderAdmin->name ?? 'Admin') : 'Anda',
                'message' => $msg->message,
                'time' => $msg->created_at ? $msg->created_at->format('H:i') : '',
            ];
        });

        $response = response()->json([
            'status' => 'success',
            'session_id' => $session->id,
            'ip_address' => $session->ip_address,
            'unread_count' => $session->unread_visitor,
            'messages' => $messages,
        ]);

        // Simpan cookie token selama 1 tahun (525600 menit) sebagai identitas sekunder bersama IP
        return $response->cookie('live_chat_token', $session->session_token, 525600);
    }

    /**
     * Mengirim pesan obrolan baru dari pengunjung.
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000', 'regex:/^[^<>=]+$/'],
        ], [
            'message.regex' => 'Pesan obrolan tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'message.required' => 'Pesan tidak boleh kosong.',
        ]);

        $session = ChatSession::findOrCreateForVisitor($request);

        // Pencegahan duplikasi pengiriman pesan dalam waktu 2 detik (Anti-Double Submit / Dual Alpine trigger)
        $existing = ChatMessage::where('chat_session_id', $session->id)
            ->where('sender_type', 'visitor')
            ->where('message', $request->message)
            ->where('created_at', '>=', now()->subSeconds(2))
            ->first();

        if (!$existing) {
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender_type' => 'visitor',
                'message' => $request->message,
                'is_read' => false,
            ]);

            // Perbarui waktu obrolan dan jumlah pesan belum dibaca untuk admin
            $session->increment('unread_admin');
            $session->update([
                'last_message_at' => now(),
                'status' => 'open',
            ]);
        }

        // Langsung kembalikan daftar pesan terbaru
        return $this->load($request);
    }
}
