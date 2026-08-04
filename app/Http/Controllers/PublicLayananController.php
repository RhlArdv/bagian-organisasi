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
    public function sop(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'sop-pelayanan')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.sop', compact('documents', 'kategori', 'years'));
    }

    /**
     * Peta Proses Bisnis (Tata Laksana)
     */
    public function petaProsesBisnis(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'peta-proses-bisnis')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.peta-proses-bisnis', compact('documents', 'kategori', 'years'));
    }

    /**
     * Tata Naskah Dinas (Tata Laksana)
     */
    public function tataNaskahDinas(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'tata-naskah-dinas')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.tata-naskah-dinas', compact('documents', 'kategori', 'years'));
    }

    /**
     * 3. Anjab & ABK
     * Displays documents grouped by sub-categories under 'anjab_abk' with search and year filter support.
     */
    public function anjabAbk(Request $request)
    {
        $slugs = ['informasi-anjab', 'informasi-abk', 'pedoman-anjab-abk', 'pedoman', 'formulir-permohonan'];
        $categories = DocumentCategory::where('group', 'anjab_abk')
            ->orWhereIn('slug', $slugs)
            ->orderBy('order_index')
            ->get()
            ->unique('slug');

        $years = Document::active()
            ->whereIn('category_id', $categories->pluck('id'))
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $groupedDocuments = [];
        foreach ($categories as $category) {
            $query = Document::active()->where('category_id', $category->id);

            if ($request->filled('year') && $request->year != 'all') {
                $query->where('year', $request->year);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('document_number', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            $groupedDocuments[$category->slug] = [
                'name' => $category->name,
                'documents' => $query->latest()->get(),
            ];
        }

        return view('public.layanan.anjab-abk', compact('groupedDocuments', 'categories', 'years'));
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
        $layanans = Layanan::whereIn('kategori', ['penataan-kelembagaan', 'evaluasi-kelembagaan', 'nomenklatur-opd'])->latest()->get()->groupBy('kategori');

        $docCategories = DocumentCategory::byGroup('kelembagaan')->get();
        $documents = Document::active()
            ->whereIn('category_id', $docCategories->pluck('id'))
            ->latest()
            ->get()
            ->groupBy(fn ($doc) => $doc->category->slug);

        return view('public.layanan.kelembagaan', compact('layanans', 'documents', 'docCategories'));
    }

    /**
     * Evaluasi Kelembagaan
     * Displays layanan evaluasi kelembagaan + related documents.
     */
    public function evaluasiKelembagaan()
    {
        $layanans = Layanan::where('kategori', 'evaluasi-kelembagaan')->latest()->get();

        $docCategories = DocumentCategory::byGroup('kelembagaan')->get();
        $documents = Document::active()
            ->whereIn('category_id', $docCategories->pluck('id'))
            ->latest()
            ->get()
            ->groupBy(fn ($doc) => $doc->category->slug);

        return view('public.layanan.evaluasi-kelembagaan', compact('layanans', 'documents', 'docCategories'));
    }

    /**
     * Nomenklatur OPD
     * Displays layanan nomenklatur opd + related documents.
     */
    public function nomenklaturOpd()
    {
        $layanans = Layanan::where('kategori', 'nomenklatur-opd')->latest()->get();

        $docCategories = DocumentCategory::byGroup('kelembagaan')->get();
        $documents = Document::active()
            ->whereIn('category_id', $docCategories->pluck('id'))
            ->latest()
            ->get()
            ->groupBy(fn ($doc) => $doc->category->slug);

        return view('public.layanan.nomenklatur-opd', compact('layanans', 'documents', 'docCategories'));
    }

    /**
     * Peta Jabatan
     */
    public function petaJabatan(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'peta-jabatan')->first();
        
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();

        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }

        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $documents = $query ? $query->latest()->get() : collect();

        return view('public.layanan.peta-jabatan', compact('documents', 'kategori', 'years'));
    }

    /**
     * Produk Hukum
     */
    public function produkHukum(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'produk-hukum')->first();
        
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();

        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }

        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $documents = $query ? $query->latest()->get() : collect();

        return view('public.layanan.produk-hukum', compact('documents', 'kategori', 'years'));
    }

    /**
     * Display the specified document detail page.
     */
    public function showDocument($id)
    {
        $document = Document::with(['category', 'uploader'])->findOrFail($id);

        $relatedDocuments = Document::active()
            ->where('category_id', $document->category_id)
            ->where('id', '!=', $document->id)
            ->latest()
            ->limit(5)
            ->get();

        $namaKategori = $document->category->name ?? 'Dokumen';
        $slug = $document->category?->slug ?? '';
        $backRoute = match(true) {
            $slug === 'peta-jabatan' => route('public.peta-jabatan'),
            $slug === 'produk-hukum' => route('public.produk-hukum'),
            $slug === 'maklumat-pelayanan' => route('public.maklumat-pelayanan'),
            $slug === 'skm' => route('public.skm'),
            $slug === 'pengelolaan-pengaduan' => route('public.pengelolaan-pengaduan'),
            $slug === 'dokumen-pelayanan-publik' => route('public.dokumen-pelayanan-publik'),
            $slug === 'sop-pelayanan' => route('public.sop'),
            $slug === 'peta-proses-bisnis' => route('public.peta-proses-bisnis'),
            $slug === 'tata-naskah-dinas' => route('public.tata-naskah-dinas'),
            in_array($slug, ['informasi-anjab', 'informasi-abk', 'pedoman-anjab-abk', 'formulir-permohonan']) || str_contains($slug, 'anjab') || str_contains($slug, 'abk') => route('public.anjab-abk', ['tab' => $slug ?: 'informasi-anjab']),
            default => url('/'),
        };
        $isAnjab = in_array($slug, ['informasi-anjab', 'informasi-abk', 'pedoman-anjab-abk', 'formulir-permohonan']) || str_contains($slug, 'anjab') || str_contains($slug, 'abk') || str_contains(strtolower($namaKategori), 'anjab') || str_contains(strtolower($namaKategori), 'abk');
        $isTataLaksana = in_array($slug, ['sop-pelayanan', 'peta-proses-bisnis', 'tata-naskah-dinas']) || str_contains(strtolower($namaKategori), 'tata laksana') || str_contains(strtolower($namaKategori), 'sop') || str_contains(strtolower($namaKategori), 'peta proses') || str_contains(strtolower($namaKategori), 'tata naskah');

        return view('public.layanan.show-document', compact('document', 'relatedDocuments', 'namaKategori', 'backRoute', 'isAnjab', 'isTataLaksana'));
    }

    /**
     * Display the specified layanan detail page.
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);

        $relatedLayanans = Layanan::where('kategori', $layanan->kategori)
            ->where('id', '!=', $layanan->id)
            ->latest()
            ->limit(5)
            ->get();

        $categories = [
            'penataan-kelembagaan' => 'Penataan Kelembagaan',
            'evaluasi-kelembagaan' => 'Evaluasi Kelembagaan',
            'nomenklatur-opd' => 'Nomenklatur OPD',
            'standar-pelayanan' => 'Standar Pelayanan',
            'forum-konsultasi-publik' => 'Forum Konsultasi Publik',
        ];

        $namaKategori = $categories[$layanan->kategori] ?? 'Layanan Bagian Organisasi';
        $backRoute = match($layanan->kategori) {
            'penataan-kelembagaan' => route('public.kelembagaan'),
            'evaluasi-kelembagaan' => route('public.evaluasi-kelembagaan'),
            'nomenklatur-opd' => route('public.nomenklatur-opd'),
            'standar-pelayanan' => route('public.standar-pelayanan'),
            'forum-konsultasi-publik' => route('public.forum-konsultasi-publik'),
            default => url('/'),
        };

        return view('public.layanan.show', compact('layanan', 'relatedLayanans', 'namaKategori', 'backRoute'));
    }

    /**
     * 6. Standar Pelayanan
     * Displays standar pelayanan items with full details.
     */
    public function standarPelayanan()
    {
        $layanans = Layanan::where('kategori', 'standar-pelayanan')->latest()->get();

        return view('public.layanan.standar-pelayanan', compact('layanans'));
    }

    /**
     * Maklumat Pelayanan (Documents)
     */
    public function maklumatPelayanan(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'maklumat-pelayanan')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.maklumat-pelayanan', compact('documents', 'kategori', 'years'));
    }

    /**
     * Survei Kepuasan Masyarakat / SKM (Documents & Survey link)
     */
    public function skm(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'skm')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.skm', compact('documents', 'kategori', 'years'));
    }

    /**
     * Forum Konsultasi Publik (Layanan model)
     */
    public function forumKonsultasiPublik()
    {
        $layanans = Layanan::where('kategori', 'forum-konsultasi-publik')->latest()->get();
        return view('public.layanan.forum-konsultasi-publik', compact('layanans'));
    }

    /**
     * Pengelolaan Pengaduan (Documents)
     */
    public function pengelolaanPengaduan(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'pengelolaan-pengaduan')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.pengelolaan-pengaduan', compact('documents', 'kategori', 'years'));
    }

    /**
     * Dokumen Pelayanan Publik (Documents)
     */
    public function dokumenPelayananPublik(Request $request)
    {
        $kategori = DocumentCategory::where('slug', 'dokumen-pelayanan-publik')->first();
        $years = $kategori ? Document::active()->where('category_id', $kategori->id)->whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year') : collect();
        $query = $kategori ? Document::active()->where('category_id', $kategori->id) : null;

        if ($query && $request->filled('year') && $request->year != 'all') {
            $query->where('year', $request->year);
        }
        if ($query && $request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query ? $query->latest()->get() : collect();
        return view('public.layanan.dokumen-pelayanan-publik', compact('documents', 'kategori', 'years'));
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

    /**
     * 7. Regulasi
     * Displays documents grouped by sub-categories under 'regulasi'.
     */
    public function regulasi()
    {
        $categories = DocumentCategory::byGroup('regulasi')->get();

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

        return view('public.layanan.regulasi', compact('groupedDocuments', 'categories'));
    }
}
