<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Tambah FAQ</h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('faqs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar FAQ
            </a>
        </div>

        <form action="{{ route('faqs.store') }}" method="POST" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                    <input type="text" name="question" value="{{ old('question') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="Tuliskan pertanyaan" required>
                    @error('question')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban <span class="text-red-500">*</span></label>
                    <textarea name="answer" rows="5" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="Tuliskan jawaban dari pertanyaan di atas" required>{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Urut <span class="text-red-500">*</span></label>
                        <input type="number" name="order_index" value="{{ old('order_index', $nextOrder) }}" min="1" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                        <p class="text-xs text-gray-400 mt-1">FAQ akan diurutkan dari nomor terkecil ke terbesar.</p>
                        @error('order_index')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pt-8 border-t border-gray-100 md:border-t-0 md:pt-0">
                        <div x-data="{ is_active: {{ old('is_active', true) ? 'true' : 'false' }} }" class="flex items-center gap-3 cursor-pointer group h-full md:mt-4" @click="is_active = !is_active">
                            <input type="hidden" name="is_active" :value="is_active ? '1' : '0'">
                            <div class="relative flex items-center justify-start w-10 h-6 rounded-full transition-colors duration-200 ease-in-out" :class="is_active ? 'bg-green-500' : 'bg-gray-200'">
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-200 ease-in-out shadow-sm" :class="is_active ? 'translate-x-4' : 'translate-x-0'"></div>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-900 transition-colors duration-200 group-hover:text-green-600" :class="is_active ? 'text-green-600' : ''">Status Aktif</span>
                                <span class="block text-xs text-gray-400 mt-0.5">Tampilkan FAQ ini ke publik</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                        <i class="ph-bold ph-floppy-disk"></i> Simpan FAQ
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
