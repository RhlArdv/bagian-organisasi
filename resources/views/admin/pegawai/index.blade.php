<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Daftar Pegawai
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div class="flex justify-end mb-4">
                <a href="{{ route('pegawai.create') }}" class="inline-flex items-center gap-2 bg-brand-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-brand-600 transition-colors shadow-lg shadow-brand-500/30 text-sm">
                    <i class="ph-bold ph-plus"></i> Tambah Pegawai
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest w-16">No</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Profil Pegawai</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Level</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pegawai as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0">
                                        @if($item->foto)
                                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="ph-bold ph-user text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $item->nama }}</div>
                                        <div class="text-xs text-gray-500 font-medium mt-0.5">{{ $item->jabatan }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">NIP: {{ $item->nip }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->level === 'kepala' ? 'bg-red-50 text-red-600' : ($item->level === 'kasubag' ? 'bg-blue-50 text-blue-600' : 'bg-gray-100 text-gray-600') }}">
                                    {{ strtoupper($item->level) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('pegawai.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?');">
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
                            <td colspan="4" class="py-8 text-center text-gray-400 font-medium">Belum ada data pegawai. Silakan tambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
