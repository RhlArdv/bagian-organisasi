<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Edit {{ $page->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('pages.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i>
                Kembali ke Daftar Halaman
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

        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Halaman</label>
                <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
            </div>

            <div>
                <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Konten</label>
                <textarea name="content" id="content" rows="12" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium leading-relaxed">{{ old('content', $page->content) }}</textarea>
                <p class="text-xs text-gray-400 mt-2 font-medium">Gunakan tag HTML (seperti &lt;br&gt;, &lt;p&gt;, &lt;b&gt;, atau &lt;ul&gt;&lt;li&gt;) untuk memformat paragraf dan daftar poin jika diperlukan.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Gambar Utama (Opsional)</label>
                
                @if($page->featured_image)
                    <div class="mb-4">
                        <span class="block text-xs font-bold text-gray-400 mb-2">Gambar Saat Ini:</span>
                        <img src="{{ Storage::url($page->featured_image) }}" alt="Featured Image" class="w-48 h-auto rounded-xl border border-gray-200 shadow-sm">
                    </div>
                @endif
                
                <input type="file" name="featured_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                <p class="text-xs text-gray-400 mt-2 font-medium">Unggah gambar baru untuk mengganti gambar sebelumnya. (Format: JPG/PNG, Maks. 2MB)</p>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('pages.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
