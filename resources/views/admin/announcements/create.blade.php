<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Buat Pengumuman Baru</h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('announcements.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i> Kembali ke Daftar Pengumuman
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

        <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Informasi Utama --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Detail Pengumuman</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Pengumuman <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Contoh: Pengumuman Seleksi CPNS..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Pengumuman <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="content" id="content" rows="6" placeholder="Tulis rincian pengumuman jika diperlukan..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Waktu & Lampiran --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Masa Berlaku & Lampiran</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="published_at" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', date('Y-m-d')) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="expired_at" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Berakhir <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="date" name="expired_at" id="expired_at" value="{{ old('expired_at') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">File Lampiran <span class="text-gray-400 font-normal">(PDF/DOC/DOCX, opsional)</span></label>
                    <input type="file" name="attachment" accept=".pdf,.doc,.docx" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Gambar <span class="text-gray-400 font-normal">(JPG/PNG/WEBP, opsional)</span></label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                </div>

                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <div x-data="{ is_active: {{ old('is_active', true) ? 'true' : 'false' }} }" class="flex items-center gap-3 cursor-pointer group" @click="is_active = !is_active">
                        <input type="hidden" name="is_active" :value="is_active ? '1' : '0'">
                        <div class="relative flex items-center justify-start w-10 h-6 rounded-full transition-colors duration-200 ease-in-out" :class="is_active ? 'bg-green-500' : 'bg-gray-200'">
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-200 ease-in-out shadow-sm" :class="is_active ? 'translate-x-4' : 'translate-x-0'"></div>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-gray-900 transition-colors duration-200 group-hover:text-green-600" :class="is_active ? 'text-green-600' : ''">Status Aktif</span>
                            <span class="block text-xs text-gray-400 mt-0.5">Tampilkan pengumuman ini ke publik</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('announcements.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors bg-white shadow-sm">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-plus"></i> Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
