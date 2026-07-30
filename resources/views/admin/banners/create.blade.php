<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Tambah Banner Baru
        </h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('banners.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i>
                Kembali ke Daftar Banner
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

        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
            @csrf

            <!-- SECTION 1: KONTEN BANNER -->
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Konten Banner</h3>
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Utama (Title)</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    
                    <div>
                        <label for="subtitle" class="block text-sm font-bold text-gray-700 mb-2">Sub Judul / Teks Deskripsi (Opsional)</label>
                        <textarea name="subtitle" id="subtitle" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('subtitle') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="button_text" class="block text-sm font-bold text-gray-700 mb-2">Teks Tombol (Opsional)</label>
                            <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" placeholder="Misal: Baca Selengkapnya" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                        </div>
                        <div>
                            <label for="button_link" class="block text-sm font-bold text-gray-700 mb-2">Link Tombol (Opsional)</label>
                            <input type="text" name="button_link" id="button_link" value="{{ old('button_link') }}" placeholder="Misal: /profil" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: PENGATURAN TAMPILAN -->
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Pengaturan Tampilan</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="order_index" class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil (Order)</label>
                            <input type="number" name="order_index" id="order_index" value="{{ old('order_index', 0) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                            <p class="text-[10px] text-gray-400 mt-1">Angka lebih kecil tampil lebih dulu (0, 1, 2...)</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Latar Banner (Background)</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer" required>
                            <p class="text-xs text-gray-400 mt-2 font-medium">Format: JPG/PNG, Maksimal: 3MB. Resolusi: 1920x1080.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-brand-500 bg-white border-gray-300 rounded focus:ring-brand-500 focus:ring-2">
                        <label for="is_active" class="text-sm font-bold text-gray-700">Tampilkan Banner ini di Beranda Publik (Aktif)</label>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('banners.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-plus"></i> Tambah Banner
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
