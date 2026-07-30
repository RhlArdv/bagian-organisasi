<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Tambah Data: {{ $nama_kategori }}
        </h2>
    </x-slot>

    <div class="max-w-5xl space-y-6">
        <div>
            <a href="{{ route('layanan.index', $kategori) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
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

        <form action="{{ route('layanan.store', $kategori) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- SECTION 1: INFORMASI DASAR -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Dasar</h3>
                <div class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-bold text-gray-700 mb-2">Judul Pelayanan</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Misal: Fasilitasi Pembentukan UPTD" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div>
                        <label for="dasar_hukum" class="block text-sm font-bold text-gray-700 mb-2">Dasar Hukum</label>
                        <textarea name="dasar_hukum" id="dasar_hukum" rows="4" placeholder="Gunakan format poin (1., 2., dst)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('dasar_hukum') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Maklumat Pelayanan (Opsional)</label>
                        <input type="file" name="maklumat_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: MEKANISME & PROSEDUR -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Standar Pelayanan</h3>
                <div class="space-y-4">
                    <div>
                        <label for="persyaratan" class="block text-sm font-bold text-gray-700 mb-2">Persyaratan Pelayanan</label>
                        <textarea name="persyaratan" id="persyaratan" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('persyaratan') }}</textarea>
                    </div>
                    <div>
                        <label for="sistem_mekanisme" class="block text-sm font-bold text-gray-700 mb-2">Sistem, Mekanisme, dan Prosedur</label>
                        <textarea name="sistem_mekanisme" id="sistem_mekanisme" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('sistem_mekanisme') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Bagan Alir / Flowchart (Opsional)</label>
                        <input type="file" name="flowchart_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: WAKTU & BIAYA -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Waktu, Biaya & Produk</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jangka_waktu" class="block text-sm font-bold text-gray-700 mb-2">Jangka Waktu Penyelesaian</label>
                        <input type="text" name="jangka_waktu" id="jangka_waktu" value="{{ old('jangka_waktu') }}" placeholder="Contoh: 14 Hari Kerja" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                    </div>
                    <div>
                        <label for="biaya" class="block text-sm font-bold text-gray-700 mb-2">Biaya / Tarif</label>
                        <input type="text" name="biaya" id="biaya" value="{{ old('biaya') }}" placeholder="Contoh: Rp. 0 (Gratis)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                    </div>
                    <div class="md:col-span-2">
                        <label for="produk_pelayanan" class="block text-sm font-bold text-gray-700 mb-2">Produk Pelayanan</label>
                        <input type="text" name="produk_pelayanan" id="produk_pelayanan" value="{{ old('produk_pelayanan') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                    </div>
                </div>
            </div>

            <!-- SECTION 4: INFORMASI LAINNYA -->
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Tambahan & Lampiran</h3>
                <div class="space-y-4">
                    <div>
                        <label for="pengaduan" class="block text-sm font-bold text-gray-700 mb-2">Penanganan Pengaduan</label>
                        <textarea name="pengaduan" id="pengaduan" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('pengaduan') }}</textarea>
                    </div>
                    <div>
                        <label for="informasi_tambahan" class="block text-sm font-bold text-gray-700 mb-2">Informasi Tambahan</label>
                        <textarea name="informasi_tambahan" id="informasi_tambahan" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('informasi_tambahan') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="link_sippn" class="block text-sm font-bold text-gray-700 mb-2">Tautan SIPPN (Opsional)</label>
                            <input type="url" name="link_sippn" id="link_sippn" value="{{ old('link_sippn') }}" placeholder="https://sippn.menpan.go.id/..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">File Dokumen Standar Pelayanan (PDF)</label>
                            <input type="file" name="file_download" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('layanan.index', $kategori) }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors bg-white shadow-sm">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-plus"></i> Simpan Data Baru
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
