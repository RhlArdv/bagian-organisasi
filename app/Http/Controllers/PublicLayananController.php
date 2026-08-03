<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Feedback;
use App\Models\Layanan;
use App\Models\RbDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Public-facing controller for Layanan Unggulan pages.
 *
 * Each method corresponds to one of the 6 "Bento Grid" cards
 * on the landing page. All data is pulled from the database
 * and displayed on read-only public pages (no auth required).
 */
class PublicLayananController extends Controller
{
    /**
     * 1. Reformasi Birokrasi
     * Displays RB index scores, SAKIP documents, and related reform documents.
     */
    public function reformasiBirokrasi()
    {
        $indeksRb = RbDocument::where('type', 'indeks_rb')
            ->orderByDesc('year')
            ->get();

        $sakip = RbDocument::where('type', 'sakip')
            ->orderByDesc('year')
            ->get();

        // Also grab documents from 'indeks-rb' and 'sakip' document categories
        $docCategories = DocumentCategory::whereIn('slug', ['indeks-rb', 'sakip'])->get();
        $documents = Document::active()
            ->whereIn('category_id', $docCategories->pluck('id'))
            ->latest()
            ->get();

        return view('public.layanan.reformasi-birokrasi', compact('indeksRb', 'sakip', 'documents'));
    }

    /**
     * 2. SOP (Standar Operasional Prosedur)
     * Displays all SOP documents from the 'sop-pelayanan' category.
     */
    public function sop()
    {
        $kategori = DocumentCategory::where('slug', 'sop-pelayanan')->first();

        $documents = collect();
        if ($kategori) {
            $documents = Document::active()
                ->where('category_id', $kategori->id)
                ->latest()
                ->get();
        }

        return view('public.layanan.sop', compact('documents'));
    }

    /**
     * 3. Anjab & ABK
     * Displays documents grouped by 4 sub-categories under 'anjab_abk'.
     */
    public function anjabAbk()
    {
        $categories = DocumentCategory::byGroup('anjab_abk')->get();

        $groupedDocuments = [];
        foreach ($categories as $category) {
            $groupedDocuments[$category->slug] = [
                'name' => $category->name,
                'documents' => Document::active()
                    ->where('category_id', $category->id)
                    ->latest()
                    ->get(),
            ];
        }

        return view('public.layanan.anjab-abk', compact('groupedDocuments', 'categories'));
    }

    /**
     * 4. Layanan Pengaduan
     * Shows complaint procedure information and a submission form.
     * Since admin doesn't have a dedicated feedback management page yet,
     * this page provides informational content + form submission.
     */
    public function pengaduan()
    {
        return view('public.layanan.pengaduan');
    }

    /**
     * Handle pengaduan form submission.
     */
    public function storePengaduan(Request $request)
    {
        $correlationId = uniqid('pengaduan_', true);
        Log::info('Pengaduan submission started', [
            'correlationId' => $correlationId,
            'operation' => 'store_pengaduan',
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\+\-\s\(\)]+$/'],
            'subject' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'name.regex' => 'Nama tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'phone.regex' => 'Nomor telepon hanya boleh berisi angka dan simbol dasar (+, -, atau spasi).',
            'subject.regex' => 'Subjek tidak boleh memuat karakter khusus HTML (<, >, atau =).',
        ]);

        $ticketNumber = Feedback::generateTicketNumber('pengaduan');

        Feedback::create([
            'type' => 'pengaduan',
            'ticket_number' => $ticketNumber,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        Log::info('Pengaduan submitted successfully', [
            'correlationId' => $correlationId,
            'operation' => 'store_pengaduan',
            'ticketNumber' => $ticketNumber,
        ]);

        return redirect()
            ->route('public.pengaduan')
            ->with('success', 'Pengaduan berhasil dikirim! Nomor tiket Anda: ' . $ticketNumber);
    }

    /**
     * 5. Penataan Kelembagaan
     * Displays layanan penataan kelembagaan + related documents.
     */
    public function kelembagaan()
    {
        $layanans = Layanan::where('kategori', 'penataan-kelembagaan')->latest()->get();

        $docCategories = DocumentCategory::byGroup('kelembagaan')->get();
        $documents = Document::active()
            ->whereIn('category_id', $docCategories->pluck('id'))
            ->latest()
            ->get()
            ->groupBy(fn ($doc) => $doc->category->slug);

        return view('public.layanan.kelembagaan', compact('layanans', 'documents', 'docCategories'));
    }

    /**
     * 6. Standar Pelayanan
     * Displays standar pelayanan items with full details.
     */
    public function standarPelayanan()
    {
        $layanans = Layanan::where('kategori', 'standar-pelayanan')->latest()->get();

        $kategori = DocumentCategory::where('slug', 'standar-pelayanan')->first();
        $documents = collect();
        if ($kategori) {
            $documents = Document::active()
                ->where('category_id', $kategori->id)
                ->latest()
                ->get();
        }

        return view('public.layanan.standar-pelayanan', compact('layanans', 'documents'));
    }

    /**
     * Handle kritik & saran form submission from landing page.
     */
    public function storeKritikSaran(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'contact' => ['required', 'string', 'max:255', 'regex:/^[^<>=]+$/'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'name.regex' => 'Nama tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'contact.regex' => 'Kontak tidak boleh memuat karakter khusus HTML (<, >, atau =).',
            'name.required' => 'Nama wajib diisi.',
            'contact.required' => 'Nomor WA atau Email wajib diisi.',
            'message.required' => 'Pesan atau masukan wajib diisi.',
        ]);

        $ticketNumber = Feedback::generateTicketNumber('kritik_saran');
        $isEmail = filter_var($validated['contact'], FILTER_VALIDATE_EMAIL);

        Feedback::create([
            'type' => 'kritik_saran',
            'ticket_number' => $ticketNumber,
            'name' => $validated['name'],
            'email' => $isEmail ? $validated['contact'] : '-',
            'phone' => !$isEmail ? $validated['contact'] : $validated['contact'],
            'subject' => 'Masukan dari Landing Page (HIT US)',
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()->to(url()->previous() . '#kontak')
            ->with('success_feedback', 'Terima kasih! Pesan dan masukan Anda berhasil dikirimkan kepada kami.');
    }
}
