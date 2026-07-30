<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Indikator Kinerja Beranda
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <p class="text-sm text-gray-500 font-medium">Data di bawah ini akan ditampilkan sebagai angka capaian kinerja (SAKIP, RB, IKM, OPD) di halaman beranda utama.</p>
                <a href="{{ route('metrics.create') }}" class="inline-flex items-center gap-2 bg-brand-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-brand-600 transition-colors shadow-lg shadow-brand-500/30 text-sm shrink-0">
                    <i class="ph-bold ph-plus"></i> Tambah Data
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest w-16">No</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Tahun</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Jenis Indikator</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Nilai / Angka</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Predikat</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($metrics as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 font-black text-brand-600">{{ $item->year }}</td>
                            <td class="py-4 px-6 font-bold text-gray-900">
                                @if($item->type === 'NILAI_RB') Nilai Reformasi Birokrasi
                                @elseif($item->type === 'NILAI_SAKIP') Nilai SAKIP
                                @elseif($item->type === 'IKM') Indeks Kepuasan Masyarakat
                                @elseif($item->type === 'JUMLAH_OPD') Jumlah OPD Binaan
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right font-black text-xl text-gray-800">
                                {{ floatval($item->score) }}
                            </td>
                            <td class="py-4 px-6">
                                @if($item->predicate)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600">{{ $item->predicate }}</span>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('metrics.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <form action="{{ route('metrics.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data metrik ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                                        <i class="ph-bold ph-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 font-medium">Belum ada data indikator kinerja. Silakan tambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
