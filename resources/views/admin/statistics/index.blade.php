<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Manajemen Statistik</h2>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-medium text-sm">
                <i class="ph-bold ph-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Header Bar --}}
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h3 class="font-black text-gray-900">Daftar Statistik</h3>
                    <p class="text-sm text-gray-500 font-medium mt-0.5">Angka yang akan ditampilkan di halaman landing</p>
                </div>
                <a href="{{ route('statistics.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors">
                    <i class="ph-bold ph-plus"></i> Tambah Statistik
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] overflow-hidden">
            @if($statistics->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Icon & Nilai</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Nama Statistik</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Urutan</th>
                            <th class="text-right px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($statistics as $stat)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-{{ $stat->color }}-50 text-{{ $stat->color }}-500 flex items-center justify-center">
                                        <i class="ph-duotone {{ $stat->icon }} text-xl"></i>
                                    </div>
                                    <span class="text-lg font-black text-gray-900">{{ $stat->value }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-700">{{ $stat->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-500">{{ $stat->order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('statistics.edit', $stat) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-50 text-brand-500 hover:bg-brand-100 transition-colors">
                                        <i class="ph-bold ph-pencil text-sm"></i>
                                    </a>
                                    <form action="{{ route('statistics.destroy', $stat) }}" method="POST" onsubmit="return confirm('Hapus statistik ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                                            <i class="ph-bold ph-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-16 text-center">
                    <i class="ph-bold ph-chart-line-up text-gray-200 text-5xl"></i>
                    <p class="font-bold text-gray-400 mt-3">Belum ada data statistik</p>
                    <a href="{{ route('statistics.create') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl hover:bg-brand-600 transition-colors">
                        <i class="ph-bold ph-plus"></i> Tambah Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
