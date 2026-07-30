<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Edit Dokumen: {{ $kategori->name }}
        </h2>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div>
            <a href="{{ route('documents.index', $kategori->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i>
                Kembali ke Daftar
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('documents.update', ['kategori_slug' => $kategori->slug, 'id' => $document->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Dokumen</label>
                <input type="text" name="title" id="title" value="{{ old('title', $document->title) }}" placeholder="Masukkan judul dokumen" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="document_number" class="block text-sm font-bold text-gray-700 mb-2">Nomor Dokumen (Opsional)</label>
                    <input type="text" name="document_number" id="document_number" value="{{ old('document_number', $document->document_number) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
                <div>
                    <label for="year" class="block text-sm font-bold text-gray-700 mb-2">Tahun</label>
                    <input type="number" name="year" id="year" value="{{ old('year', $document->year) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Keterangan / Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('description', $document->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">File Dokumen (PDF, Maks 20MB)</label>
                @if($document->file_path)
                    <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="block text-sm text-blue-600 mb-2 font-bold hover:underline">Lihat Dokumen Saat Ini</a>
                @endif
                <input type="file" name="file" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah file dokumen.</p>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('documents.index', $kategori->slug) }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
