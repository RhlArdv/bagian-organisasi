<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">Pengaturan Kontak & Lokasi</h2>
    </x-slot>

    <div class="max-w-4xl space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <i class="ph-bold ph-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('settings.contact.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-6 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i class="ph-bold ph-address-book text-brand-500"></i> Informasi Kontak
                </h3>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jam Kerja <span class="text-red-500">*</span></label>
                        <input type="text" name="working_hours" value="{{ old('working_hours', $settings['working_hours'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="Contoh: Senin - Jumat, 08.00 - 16.00 WIB" required>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-6 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i class="ph-bold ph-map-pin text-brand-500"></i> Integrasi Lokasi & Layanan
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">URL Google Maps (Embed) <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="google_maps_embed" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="Paste kode iframe Google Maps atau URL lokasi di sini">{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}</textarea>
                        
                        <div class="mt-2 text-[11px] text-gray-500 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <span class="font-bold block mb-1">Cara mengambil kode embed:</span>
                            Buka Google Maps > Cari lokasi > Klik "Bagikan" > "Sematkan peta" > "SALIN HTML" > Paste di sini.
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Link SP4N-LAPOR! <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="url" name="sp4n_lapor_link" value="{{ old('sp4n_lapor_link', $settings['sp4n_lapor_link'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="https://www.lapor.go.id/">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_4px_25px_rgb(0,0,0,0.03)]">
                <h3 class="text-lg font-black text-gray-900 mb-6 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i class="ph-bold ph-share-network text-brand-500"></i> Tautan Media Sosial
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2"><i class="ph-fill ph-instagram-logo text-pink-600"></i> Instagram <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="https://instagram.com/akun_anda">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2"><i class="ph-fill ph-facebook-logo text-blue-600"></i> Facebook <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="url" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="https://facebook.com/akun_anda">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2"><i class="ph-fill ph-twitter-logo text-sky-500"></i> Twitter / X <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="url" name="twitter" value="{{ old('twitter', $settings['twitter'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="https://twitter.com/akun_anda">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2"><i class="ph-fill ph-youtube-logo text-red-600"></i> YouTube <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="url" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium" placeholder="https://youtube.com/@akun_anda">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="px-6 py-3 bg-brand-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
