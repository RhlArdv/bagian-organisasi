<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Kelola FAQ</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <i class="ph-bold ph-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-lg text-gray-900">Daftar FAQ</h3>
                <a href="{{ route('faqs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-500 text-white text-sm font-bold rounded-xl hover:bg-brand-600 transition-colors shadow-lg shadow-brand-500/30">
                    <i class="ph-bold ph-plus"></i> Tambah FAQ
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-16">Urutan</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Pertanyaan & Jawaban</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-28">Status</th>
                            <th class="text-right px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg font-bold text-gray-700">
                                    {{ $faq->order_index }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 mb-1">{{ $faq->question }}</p>
                                <p class="text-gray-500 text-xs line-clamp-2">{{ $faq->answer }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($faq->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full"><i class="ph-bold ph-check-circle"></i> Aktif</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-50 text-red-600 text-xs font-bold rounded-full"><i class="ph-bold ph-x-circle"></i> Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('faqs.edit', $faq) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-50 text-brand-500 hover:bg-brand-100 transition-colors">
                                        <i class="ph-bold ph-pencil text-sm"></i>
                                    </a>
                                    <form action="{{ route('faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                                            <i class="ph-bold ph-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="ph-bold ph-question text-4xl mb-3"></i>
                                    <p class="font-medium text-sm">Belum ada FAQ</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
