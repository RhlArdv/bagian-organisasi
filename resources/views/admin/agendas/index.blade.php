<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Agenda & Aktivitas</h2>
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
                    <h3 class="font-black text-gray-900">Daftar Agenda</h3>
                    <p class="text-sm text-gray-500 font-medium mt-0.5">Kelola agenda kegiatan Bagian Organisasi</p>
                </div>
                <a href="{{ route('agendas.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors">
                    <i class="ph-bold ph-plus"></i> Tambah Agenda
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] overflow-hidden">
            @if($agendas->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Judul Agenda</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Lokasi</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Waktu</th>
                            <th class="text-right px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($agendas as $agenda)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 line-clamp-1">{{ $agenda->title }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600">{{ $agenda->location }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col text-xs text-gray-600">
                                    <span class="font-bold text-brand-600">{{ $agenda->date->translatedFormat('d F Y') }}</span>
                                    @if($agenda->time)<span>{{ $agenda->time }}</span>@endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('agendas.edit', $agenda) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-50 text-brand-500 hover:bg-brand-100 transition-colors">
                                        <i class="ph-bold ph-pencil text-sm"></i>
                                    </a>
                                    <form action="{{ route('agendas.destroy', $agenda) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?')">
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
                <div class="p-4 border-t border-gray-50">
                    {{ $agendas->links() }}
                </div>
            @else
                <div class="py-16 text-center">
                    <i class="ph-bold ph-calendar text-gray-200 text-5xl"></i>
                    <p class="font-bold text-gray-400 mt-3">Belum ada agenda</p>
                    <a href="{{ route('agendas.create') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl hover:bg-brand-600 transition-colors">
                        <i class="ph-bold ph-plus"></i> Tambah Agenda
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
