<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Tambah Indikator Kinerja
        </h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('metrics.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i>
                Kembali ke Daftar Indikator
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

        <form action="{{ route('metrics.store') }}" method="POST" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
            @csrf

            <!-- SECTION 1: INFORMASI INDIKATOR -->
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Indikator</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="type" class="block text-sm font-bold text-gray-700 mb-2">Jenis Indikator</label>
                            <select name="type" id="type" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                                <option value="NILAI_RB" {{ old('type') == 'NILAI_RB' ? 'selected' : '' }}>Nilai Reformasi Birokrasi</option>
                                <option value="NILAI_SAKIP" {{ old('type') == 'NILAI_SAKIP' ? 'selected' : '' }}>Nilai SAKIP</option>
                                <option value="IKM" {{ old('type') == 'IKM' ? 'selected' : '' }}>Indeks Kepuasan Masyarakat (IKM)</option>
                                <option value="JUMLAH_OPD" {{ old('type') == 'JUMLAH_OPD' ? 'selected' : '' }}>Jumlah OPD Binaan</option>
                            </select>
                        </div>
                        <div>
                            <label for="year" class="block text-sm font-bold text-gray-700 mb-2">Tahun</label>
                            <input type="number" name="year" id="year" value="{{ old('year', date('Y')) }}" min="2000" max="{{ date('Y') + 5 }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="score" class="block text-sm font-bold text-gray-700 mb-2">Nilai / Angka</label>
                            <input type="number" step="0.01" name="score" id="score" value="{{ old('score') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium font-black text-brand-600" required>
                            <p class="text-[10px] text-gray-400 mt-1">Gunakan titik (.) untuk desimal. Contoh: 85.50</p>
                        </div>
                        <div>
                            <label for="predicate" class="block text-sm font-bold text-gray-700 mb-2">Predikat (Opsional)</label>
                            <input type="text" name="predicate" id="predicate" value="{{ old('predicate') }}" placeholder="Misal: A, BB, Sangat Baik" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- SECTION 2: DETAIL -->
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Detail</h3>
                <div class="space-y-4">
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Keterangan Singkat (Opsional)</label>
                        <textarea name="description" id="description" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('metrics.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-plus"></i> Tambah Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
