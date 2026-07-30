<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            Manajemen Konten Profil
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <p class="text-gray-500 font-medium mb-6">Pilih halaman profil yang ingin Anda perbarui.</p>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Judul Halaman</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Terakhir Diperbarui</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pages as $page)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900">{{ $page->title }}</div>
                                <div class="text-xs text-gray-500 mt-1">/{{ $page->slug }}</div>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                                {{ $page->updated_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('pages.edit', $page->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-50 text-brand-600 rounded-xl hover:bg-brand-500 hover:text-white transition-colors text-sm font-bold">
                                    <i class="ph-bold ph-pencil-simple"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-gray-400 font-medium">Belum ada halaman yang ditambahkan. Silakan jalankan seeder.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
