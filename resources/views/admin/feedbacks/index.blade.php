<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Kritik, Saran & Pengaduan</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <i class="ph-bold ph-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-900">Daftar Masukan Masyarakat</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Menampung seluruh kritik, saran dari landing page dan pengaduan layanan</p>
                </div>
                
                {{-- Filter --}}
                <form action="{{ route('feedbacks.index') }}" method="GET" class="flex flex-wrap items-center gap-2 text-sm">
                    <select name="type" class="bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold rounded-xl px-3 py-2 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500" onchange="this.form.submit()">
                        <option value="all">Semua Jenis</option>
                        <option value="kritik_saran" {{ request('type') == 'kritik_saran' ? 'selected' : '' }}>Kritik & Saran (HIT US)</option>
                        <option value="pengaduan" {{ request('type') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                        <option value="permohonan" {{ request('type') == 'permohonan' ? 'selected' : '' }}>Permohonan</option>
                    </select>
                    <select name="status" class="bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold rounded-xl px-3 py-2 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500" onchange="this.form.submit()">
                        <option value="all">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress (Dipayung)</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved (Selesai)</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed (Ditutup)</option>
                    </select>
                    @if(request('type') != 'all' || request('status') != 'all')
                        <a href="{{ route('feedbacks.index') }}" class="text-xs font-bold text-red-500 hover:underline ml-1">Reset Filter</a>
                    @endif
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-40">Tiket & Tanggal</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-48">Pengirim</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-32">Jenis</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Isi Masukan</th>
                            <th class="text-left px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-32">Status</th>
                            <th class="text-right px-6 py-4 font-bold text-gray-500 text-xs uppercase tracking-wider w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($feedbacks as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900 block">{{ $item->ticket_number ?? 'N/A' }}</span>
                                <span class="text-gray-400 text-xs">{{ $item->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900">{{ $item->name }}</p>
                                <p class="text-gray-500 text-xs font-medium">{{ $item->email !== '-' ? $item->email : ($item->phone ?? '-') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->type === 'kritik_saran')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-50 text-purple-600 text-xs font-bold rounded-full"><i class="ph-bold ph-lightbulb"></i> Kritik & Saran</span>
                                @elseif($item->type === 'pengaduan')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-full"><i class="ph-bold ph-megaphone"></i> Pengaduan</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full"><i class="ph-bold ph-file-text"></i> {{ ucfirst($item->type) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700 text-xs leading-relaxed line-clamp-2">{{ $item->message }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-full"><i class="ph-bold ph-clock"></i> Pending</span>
                                @elseif($item->status === 'in_progress')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full"><i class="ph-bold ph-spinner"></i> In Progress</span>
                                @elseif($item->status === 'resolved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full"><i class="ph-bold ph-check-circle"></i> Selesai</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full"><i class="ph-bold ph-archive"></i> Ditutup</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('feedbacks.show', $item) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-50 text-brand-500 hover:bg-brand-100 transition-colors" title="Lihat Detail & Tanggapi">
                                        <i class="ph-bold ph-eye text-sm"></i>
                                    </a>
                                    <form action="{{ route('feedbacks.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data masukan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors" title="Hapus">
                                            <i class="ph-bold ph-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="ph-bold ph-chat-text text-5xl mb-3"></i>
                                    <p class="font-bold text-gray-600 text-sm">Belum ada kritik & saran atau pengaduan</p>
                                    <p class="text-xs text-gray-400 mt-1">Data dari kolom HIT US (Landing Page) akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($feedbacks->hasPages())
                <div class="p-6 border-t border-gray-100">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
