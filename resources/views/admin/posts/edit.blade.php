<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Edit Berita</h2>
    </x-slot>

    <div class="max-w-5xl space-y-6">
        <div>
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i> Kembali ke Daftar Berita
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Informasi Utama --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Berita</h3>
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="excerpt" class="block text-sm font-bold text-gray-700 mb-2">Ringkasan / Excerpt <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="excerpt" id="excerpt" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <select name="category_id" id="category_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                            <option value="">— Tanpa Kategori —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Isi Berita</h3>
                <div>
                    <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Konten Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="12" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            {{-- Media & Status --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Media & Penerbitan</h3>
                
                @if($post->thumbnail)
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail Saat Ini</label>
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="Thumbnail" class="h-32 object-cover rounded-xl border border-gray-200">
                    </div>
                @endif
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Thumbnail <span class="text-gray-400 font-normal">(biarkan kosong jika tidak ingin mengubah)</span></label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>✅ Published</option>
                            <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>🗄️ Archived</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('posts.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors bg-white shadow-sm">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
