<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Detail Masukan Masyarakat</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">
        <div>
            <a href="{{ route('feedbacks.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar Masukan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 font-bold text-sm">
                <i class="ph-bold ph-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Column: Feedback Details --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)] space-y-6">
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-6 border-b border-gray-100">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nomor Tiket</span>
                            <span class="text-xl font-black text-gray-900">{{ $feedback->ticket_number ?? 'N/A' }}</span>
                        </div>
                        <div>
                            @if($feedback->type === 'kritik_saran')
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-purple-50 text-purple-600 text-xs font-bold rounded-full"><i class="ph-bold ph-lightbulb"></i> Kritik & Saran (Landing Page)</span>
                            @elseif($feedback->type === 'pengaduan')
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-amber-50 text-amber-600 text-xs font-bold rounded-full"><i class="ph-bold ph-megaphone"></i> Pengaduan Layanan</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-full"><i class="ph-bold ph-file-text"></i> {{ ucfirst($feedback->type) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gray-50/70 rounded-2xl p-4 border border-gray-100/80">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Pengirim</span>
                            <span class="font-bold text-gray-900 block mt-1 text-base">{{ $feedback->name }}</span>
                            <div class="mt-2 text-xs text-gray-600 space-y-1">
                                @if($feedback->email && $feedback->email !== '-')
                                    <p class="flex items-center gap-1.5"><i class="ph-bold ph-envelope text-brand-500"></i> {{ $feedback->email }}</p>
                                @endif
                                @if($feedback->phone && $feedback->phone !== '-')
                                    <p class="flex items-center gap-1.5"><i class="ph-bold ph-phone text-brand-500"></i> {{ $feedback->phone }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-50/70 rounded-2xl p-4 border border-gray-100/80 flex flex-col justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Tanggal Masuk</span>
                                <span class="font-bold text-gray-800 block mt-1 text-sm">{{ $feedback->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 font-medium"><i class="ph-bold ph-clock"></i> Dikirim {{ $feedback->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Isi Pesan / Masukan</h4>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 text-gray-800 leading-relaxed font-medium whitespace-pre-wrap text-base">{{ $feedback->message }}</div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Status & Action --}}
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                    <h3 class="font-black text-base text-gray-900 mb-4 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <i class="ph-bold ph-gear text-brand-500"></i> Tindak Lanjut & Status
                    </h3>

                    <form action="{{ route('feedbacks.update', $feedback) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Status Masukan</label>
                            <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 text-gray-900">
                                <option value="pending" {{ old('status', $feedback->status) === 'pending' ? 'selected' : '' }}>⏳ Pending (Menunggu)</option>
                                <option value="in_progress" {{ old('status', $feedback->status) === 'in_progress' ? 'selected' : '' }}>🔄 In Progress (Dikerjakan)</option>
                                <option value="resolved" {{ old('status', $feedback->status) === 'resolved' ? 'selected' : '' }}>✅ Resolved (Selesai/Diterima)</option>
                                <option value="closed" {{ old('status', $feedback->status) === 'closed' ? 'selected' : '' }}>📦 Closed (Ditutup)</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Catatan / Tanggapan Admin</label>
                            <textarea name="reply_message" rows="5" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 placeholder-gray-400" placeholder="Tulis catatan internal atau tindak lanjut atas saran ini...">{{ old('reply_message', $feedback->reply_message) }}</textarea>
                            <p class="text-[11px] text-gray-400 mt-1">Catatan ini sebagai dokumentasi tindak lanjut pengelola web.</p>
                            @error('reply_message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center justify-center gap-2">
                            <i class="ph-bold ph-floppy-disk"></i> Simpan Status
                        </button>
                    </form>

                    @if($feedback->replied_at)
                        <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500 font-medium space-y-1">
                            <p class="flex items-center gap-1.5"><i class="ph-bold ph-user-check text-green-500"></i> Ditangani: <span class="font-bold text-gray-800">{{ $feedback->repliedBy->name ?? 'Admin' }}</span></p>
                            <p class="flex items-center gap-1.5"><i class="ph-bold ph-calendar text-green-500"></i> Pada: {{ $feedback->replied_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif
                </div>

                <div class="bg-red-50/50 rounded-3xl p-6 border border-red-100">
                    <h4 class="font-bold text-red-600 text-sm mb-1">Hapus Data Ini?</h4>
                    <p class="text-xs text-gray-500 mb-4">Jika masukan ini mengandung spam atau konten tidak relevan, Anda dapat menghapusnya permanen.</p>
                    <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus masukan ini permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2.5 bg-white border border-red-200 text-red-600 text-xs font-bold rounded-xl hover:bg-red-600 hover:text-white transition-all flex items-center justify-center gap-1.5 shadow-sm">
                            <i class="ph-bold ph-trash"></i> Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
