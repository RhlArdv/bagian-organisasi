<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            {{ $kategori->name }}
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
                <p class="text-sm text-gray-500 font-medium">Kelola daftar dokumen untuk {{ $kategori->name }}.</p>
                <a href="{{ route('documents.create', $kategori->slug) }}" class="inline-flex items-center gap-2 bg-brand-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-brand-600 transition-colors shadow-lg shadow-brand-500/30 text-sm shrink-0">
                    <i class="ph-bold ph-plus"></i> Tambah Dokumen
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest w-16">No</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Judul Dokumen</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Tahun / Nomor</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">File Dokumen</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($documents as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900">{{ $item->title }}</div>
                                <div class="text-xs text-gray-500 font-medium mt-1">{{ Str::limit($item->description, 60) }}</div>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-700 font-medium">
                                {{ $item->year ?: '-' }} <br>
                                <span class="text-xs text-gray-400">{{ $item->document_number ?: '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($item->file_path)
                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full">
                                        <i class="ph-bold ph-download-simple"></i> Unduh PDF
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400 font-medium">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('documents.edit', ['kategori_slug' => $kategori->slug, 'id' => $item->id]) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </a>
                                <form action="{{ route('documents.destroy', ['kategori_slug' => $kategori->slug, 'id' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
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
                            <td colspan="5" class="py-8 text-center text-gray-400 font-medium">Belum ada dokumen untuk kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
