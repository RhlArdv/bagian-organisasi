<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Edit Pegawai: {{ $pegawai->nama }}
        </h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
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

        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $pegawai->nama) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                </div>
                <div>
                    <label for="nip" class="block text-sm font-bold text-gray-700 mb-2">NIP</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip', $pegawai->nip) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="jabatan" class="block text-sm font-bold text-gray-700 mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                </div>
                <div>
                    <label for="level" class="block text-sm font-bold text-gray-700 mb-2">Tingkatan (Level)</label>
                    <select name="level" id="level" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                        <option value="staf" {{ old('level', $pegawai->level) == 'staf' ? 'selected' : '' }}>Staf</option>
                        <option value="kasubag" {{ old('level', $pegawai->level) == 'kasubag' ? 'selected' : '' }}>Kepala Sub Bagian (Kasubag)</option>
                        <option value="kepala" {{ old('level', $pegawai->level) == 'kepala' ? 'selected' : '' }}>Kepala Bagian</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="pangkat_golongan" class="block text-sm font-bold text-gray-700 mb-2">Pangkat / Golongan</label>
                    <input type="text" name="pangkat_golongan" id="pangkat_golongan" value="{{ old('pangkat_golongan', $pegawai->pangkat_golongan) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
                <div>
                    <label for="pendidikan" class="block text-sm font-bold text-gray-700 mb-2">Pendidikan</label>
                    <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan', $pegawai->pendidikan) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email (Opsional)</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pegawai->email) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon (Opsional)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $pegawai->phone) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="order_index" class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil (Order)</label>
                    <input type="number" name="order_index" id="order_index" value="{{ old('order_index', $pegawai->order_index) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    <p class="text-[10px] text-gray-400 mt-1">Angka lebih kecil tampil lebih dulu (0, 1, 2, 3...)</p>
                </div>
                <div>
                    <label for="parent_id" class="block text-sm font-bold text-gray-700 mb-2">Atasan Langsung (Untuk Struktur)</label>
                    <select name="parent_id" id="parent_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                        <option value="">-- Tidak Ada --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $pegawai->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->nama }} ({{ $parent->jabatan }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Pegawai</label>
                
                @if($pegawai->foto)
                    <div class="mb-4">
                        <span class="block text-xs font-bold text-gray-400 mb-2">Foto Saat Ini:</span>
                        <img src="{{ Storage::url($pegawai->foto) }}" alt="Foto Pegawai" class="w-32 h-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                    </div>
                @endif

                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-colors cursor-pointer">
                <p class="text-xs text-gray-400 mt-2 font-medium">Format: JPG/PNG, Maksimal: 2MB. Disarankan foto berlatar biru/merah dengan pakaian dinas rasio 3:4.</p>
            </div>
            
            <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-xl border border-gray-200">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $pegawai->is_active) ? 'checked' : '' }} class="w-5 h-5 text-brand-500 bg-white border-gray-300 rounded focus:ring-brand-500 focus:ring-2">
                <label for="is_active" class="text-sm font-bold text-gray-700">Tampilkan Profil ini secara Publik (Aktif)</label>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('pegawai.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
