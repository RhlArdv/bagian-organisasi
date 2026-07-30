<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Edit Statistik</h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        <div>
            <a href="{{ route('statistics.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-brand-500 transition-colors">
                <i class="ph-bold ph-arrow-left text-lg"></i> Kembali ke Daftar Statistik
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('statistics.update', $statistic) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Statistik</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Statistik <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $statistic->name) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="value" class="block text-sm font-bold text-gray-700 mb-2">Nilai / Angka <span class="text-red-500">*</span></label>
                        <input type="text" name="value" id="value" value="{{ old('value', $statistic->value) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="icon" class="block text-sm font-bold text-gray-700 mb-2">Icon (Phosphor Icon Class) <span class="text-red-500">*</span></label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $statistic->icon) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-bold text-gray-700 mb-2">Warna (Tailwind Color) <span class="text-red-500">*</span></label>
                        <select name="color" id="color" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                            <option value="brand" {{ old('color', $statistic->color) == 'brand' ? 'selected' : '' }}>Brand (Orange)</option>
                            <option value="blue" {{ old('color', $statistic->color) == 'blue' ? 'selected' : '' }}>Blue</option>
                            <option value="green" {{ old('color', $statistic->color) == 'green' ? 'selected' : '' }}>Green</option>
                            <option value="purple" {{ old('color', $statistic->color) == 'purple' ? 'selected' : '' }}>Purple</option>
                            <option value="emerald" {{ old('color', $statistic->color) == 'emerald' ? 'selected' : '' }}>Emerald</option>
                            <option value="red" {{ old('color', $statistic->color) == 'red' ? 'selected' : '' }}>Red</option>
                            <option value="indigo" {{ old('color', $statistic->color) == 'indigo' ? 'selected' : '' }}>Indigo</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="order" class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil <span class="text-red-500">*</span></label>
                        <input type="number" name="order" id="order" value="{{ old('order', $statistic->order) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('statistics.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors bg-white shadow-sm">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
