<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Manajemen Pengumuman</h2>
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
                    <h3 class="font-black text-gray-900">Daftar Pengumuman</h3>
                    <p class="text-sm text-gray-500 font-medium mt-0.5">Total {{ $announcements->total() }} pengumuman terdaftar</p>
                </div>
                <a href="{{ route('announcements.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors">
                    <i class="ph-bold ph-plus"></i> Tambah Pengumuman
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] overflow-hidden">
            @if($announcements->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-12">Pin</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Judul Pengumuman</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Masa Berlaku</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-right px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($announcements as $announcement)
                        <tr class="hover:bg-gray-50/50 transition-colors {{ $announcement->is_pinned ? 'bg-brand-50/30' : '' }}">
                            <td class="px-6 py-4">
                                @if($announcement->is_pinned)
                                    <i class="ph-fill ph-push-pin text-brand-500 text-lg"></i>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 line-clamp-1">{{ $announcement->title }}</p>
                                <div class="flex items-center gap-3 mt-1">
                                    @if($announcement->attachment)
                                        <a href="{{ Storage::url($announcement->attachment) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-brand-600 hover:text-brand-700 font-medium hover:underline">
                                            <i class="ph-bold ph-paperclip"></i> Lihat Lampiran
                                        </a>
                                    @endif
                                    @if($announcement->image)
                                        <a href="{{ Storage::url($announcement->image) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                            <i class="ph-bold ph-image"></i> Lihat Gambar
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-xs font-medium">
                                {{ $announcement->published_at->format('d M Y') }}
                                @if($announcement->expired_at)
                                    <span class="text-gray-400 mx-1">-</span>
                                    <span class="{{ $announcement->expired_at->isPast() ? 'text-red-500' : '' }}">
                                        {{ $announcement->expired_at->format('d M Y') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($announcement->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full"><i class="ph-bold ph-check-circle"></i> Aktif</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-50 text-red-600 text-xs font-bold rounded-full"><i class="ph-bold ph-x-circle"></i> Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('announcements.edit', $announcement) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-50 text-brand-500 hover:bg-brand-100 transition-colors">
                                        <i class="ph-bold ph-pencil text-sm"></i>
                                    </a>
                                    <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
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
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $announcements->links() }}
                </div>
            @else
                <div class="py-16 text-center">
                    <i class="ph-bold ph-megaphone text-gray-200 text-5xl"></i>
                    <p class="font-bold text-gray-400 mt-3">Belum ada pengumuman</p>
                    <a href="{{ route('announcements.create') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-brand-500 text-white font-bold text-sm rounded-xl hover:bg-brand-600 transition-colors">
                        <i class="ph-bold ph-plus"></i> Buat Pengumuman Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
