@props(['pegawais', 'columns' => '5'])

@php
    $gridCols = match((string) $columns) {
        '3' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        '4' => 'grid-cols-2 sm:grid-cols-2 lg:grid-cols-4',
        '5' => 'grid-cols-2 md:grid-cols-3 lg:grid-cols-5',
        default => 'grid-cols-2 md:grid-cols-3 lg:grid-cols-5'
    };
@endphp

<div x-data="pegawaiCards()" class="w-full">
    {{-- Grid Kartu Pejabat & Pegawai --}}
    <div class="grid {{ $gridCols }} gap-5 lg:gap-6">
        @foreach($pegawais as $staff)
            @php
                $fotoUrl = $staff->foto 
                    ? (\Illuminate\Support\Str::startsWith($staff->foto, ['http', '/']) ? $staff->foto : Storage::url($staff->foto))
                    : asset('assets/img/staff/kepala_pejabat_khaki_1785375439464.png');

                $fotoOriginal = $staff->foto_original
                    ? (\Illuminate\Support\Str::startsWith($staff->foto_original, ['http', '/']) ? $staff->foto_original : Storage::url($staff->foto_original))
                    : $fotoUrl;
                
                $levelBadge = match($staff->level) {
                    'kepala' => 'KEPALA BAGIAN',
                    'kasubag' => 'KASUBAG / KATIM',
                    'staff' => 'STAF BINA ILMIAH',
                    default => strtoupper($staff->level ?? 'STAF')
                };
            @endphp

            <div @click="openModal({{ json_encode([
                    'nama' => $staff->nama,
                    'jabatan' => $staff->jabatan,
                    'keterangan_singkat' => $staff->keterangan_singkat ?? 'Berkomitmen memberikan pelayanan publik terbaik dan berinovasi dalam reformasi birokrasi Kota Padang.',
                    'nip' => $staff->nip ?? '-',
                    'pangkat_golongan' => $staff->pangkat_golongan ?? '-',
                    'pendidikan' => $staff->pendidikan ?? '-',
                    'email' => $staff->email ?? '',
                    'phone' => $staff->phone ?? '',
                    'facebook' => $staff->facebook ?? '',
                    'instagram' => $staff->instagram ?? '',
                    'foto' => $fotoOriginal,
                    'level_badge' => $levelBadge
                ]) }})"
                 class="group relative bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-[0_10px_35px_rgba(0,0,0,0.04)] hover:shadow-[0_15px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 transition-all duration-500 cursor-pointer flex flex-col justify-between">

                {{-- Image Container (Rasio 4:5) --}}
                <div class="relative w-full aspect-[4/5] bg-gradient-to-t from-slate-900 via-slate-800 to-slate-200 overflow-hidden">
                    <img src="{{ $fotoUrl }}" alt="{{ $staff->nama }}" 
                         class="w-full h-full object-cover {{ $staff->titik_fokus ?? 'object-center' }} group-hover:scale-105 transition-transform duration-700 ease-out">
                    
                    {{-- Overlay Gradient Gelap Khas Premium --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>

                    {{-- Badge Jabatan di Pojok Atas --}}
                    <div class="absolute top-3 right-3 z-10">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black tracking-wider uppercase shadow-sm bg-orange-500/90 text-white backdrop-blur-md border border-white/20">
                            {{ $levelBadge }}
                        </span>
                    </div>

                    {{-- Indikator Klik & Motto di Overlay Atas --}}
                    <div class="absolute top-3 left-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white">
                            <i class="ph-bold ph-eye text-sm"></i>
                        </span>
                    </div>

                    {{-- Konten Informasi di Bawah Kartu (Di atas gambar) --}}
                    <div class="absolute bottom-0 inset-x-0 p-4 sm:p-5 z-20 flex flex-col justify-end text-left text-white">
                        <h4 class="font-extrabold text-base sm:text-lg leading-tight mb-1 group-hover:text-brand-300 transition-colors line-clamp-2" title="{{ $staff->nama }}">
                            {{ $staff->nama }}
                        </h4>
                        <p class="text-xs text-gray-300 font-medium line-clamp-1 mb-2">
                            {{ $staff->jabatan }}
                        </p>

                        @if($staff->keterangan_singkat)
                        <div class="pt-2 border-t border-white/15 flex items-start gap-1.5 opacity-90 group-hover:opacity-100 transition-opacity">
                            <span class="text-amber-400 font-serif font-black text-sm leading-none">“</span>
                            <p class="text-[11px] text-amber-200 font-normal italic line-clamp-2 leading-relaxed">
                                {{ $staff->keterangan_singkat }}
                            </p>
                        </div>
                        @else
                        <div class="pt-2 border-t border-white/10 flex items-center justify-between text-[10px] text-gray-400">
                            <span>Klik untuk detail profil</span>
                            <i class="ph-bold ph-arrow-right text-amber-400 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- MODAL DETAIL PEJABAT (Glassmorphic Dark Theme, Gambar 5) --}}
    <div x-show="modalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
         style="display: none;"
         @keydown.escape.window="closeModal()"
         @click.self="closeModal()">

        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative w-full max-w-4xl bg-slate-900 border border-slate-700/80 rounded-3xl overflow-hidden shadow-2xl shadow-black/50 text-white my-8">

            {{-- Tombol Tutup Silang Pojok Kanan Atas --}}
            <button @click="closeModal()" 
                    class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-all shadow-md border border-slate-600">
                <i class="ph-bold ph-x text-lg"></i>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-12">
                {{-- Kiri: Foto Pejabat Asli --}}
                <div class="md:col-span-5 relative bg-slate-950 flex items-center justify-center p-6 border-b md:border-b-0 md:border-r border-slate-800 min-h-[300px] sm:min-h-[400px]">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent z-10"></div>
                    <img :src="activeStaff.foto" :alt="activeStaff.nama" class="w-full h-full object-cover object-center max-h-[480px] rounded-2xl border border-slate-800 shadow-lg relative z-0">
                    <div class="absolute bottom-4 left-6 z-20">
                        <span class="inline-block px-3 py-1 bg-amber-500/20 border border-amber-500 text-amber-400 rounded-full text-xs font-bold uppercase tracking-wider" x-text="activeStaff.level_badge"></span>
                    </div>
                </div>

                {{-- Kanan: Detail Informasi Profil Pejabat --}}
                <div class="md:col-span-7 p-6 sm:p-8 md:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-amber-400 text-xs font-extrabold uppercase tracking-widest mb-2">
                            <i class="ph-fill ph-check-circle text-base"></i> Profil Pejabat / Pegawai
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white mb-1" x-text="activeStaff.nama"></h3>
                        <p class="text-base font-bold text-brand-400 mb-6 pb-4 border-b border-slate-800" x-text="activeStaff.jabatan"></p>

                        {{-- Motto / Keterangan Singkat --}}
                        <div class="bg-slate-800/60 rounded-2xl p-5 border border-slate-700/60 mb-6 relative overflow-hidden">
                            <div class="flex items-start gap-3 relative z-10">
                                <span class="text-amber-400 font-serif font-black text-4xl leading-none -mt-1 shrink-0">“</span>
                                <p class="text-slate-300 italic text-sm leading-relaxed font-medium" x-text="activeStaff.keterangan_singkat"></p>
                            </div>
                        </div>

                        {{-- Tabel Informasi --}}
                        <div class="space-y-3.5 mb-8">
                            <div class="flex items-center justify-between text-sm py-2 border-b border-slate-800/80">
                                <span class="text-slate-400 font-medium">NIP</span>
                                <span class="font-extrabold text-slate-200" x-text="activeStaff.nip"></span>
                            </div>
                            <div class="flex items-center justify-between text-sm py-2 border-b border-slate-800/80">
                                <span class="text-slate-400 font-medium">Pangkat / Golongan</span>
                                <span class="font-extrabold text-slate-200" x-text="activeStaff.pangkat_golongan"></span>
                            </div>
                            <div class="flex items-center justify-between text-sm py-2 border-b border-slate-800/80">
                                <span class="text-slate-400 font-medium">Pendidikan Terakhir</span>
                                <span class="font-extrabold text-slate-200" x-text="activeStaff.pendidikan"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Modal: Sosial Media & Tombol --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-slate-800">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Media Sosial:</span>
                            <template x-if="activeStaff.email">
                                <a :href="'mailto:' + activeStaff.email" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-brand-500 hover:text-white text-slate-300 flex items-center justify-center transition-colors">
                                    <i class="ph-bold ph-envelope"></i>
                                </a>
                            </template>
                            <template x-if="activeStaff.instagram">
                                <a :href="activeStaff.instagram" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-gradient-to-br hover:from-purple-500 hover:to-orange-500 text-slate-300 hover:text-white flex items-center justify-center transition-all">
                                    <i class="ph-bold ph-instagram-logo"></i>
                                </a>
                            </template>
                            <template x-if="activeStaff.facebook">
                                <a :href="activeStaff.facebook" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-blue-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                                    <i class="ph-bold ph-facebook-logo"></i>
                                </a>
                            </template>
                            <template x-if="!activeStaff.email && !activeStaff.instagram && !activeStaff.facebook">
                                <span class="text-xs text-slate-500 font-medium">Tidak tersedia</span>
                            </template>
                        </div>

                        <button @click="closeModal()" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-extrabold tracking-wide uppercase transition-all shadow">
                            Tutup Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pegawaiCards', () => ({
                modalOpen: false,
                activeStaff: {
                    nama: '',
                    jabatan: '',
                    keterangan_singkat: '',
                    nip: '',
                    pangkat_golongan: '',
                    pendidikan: '',
                    email: '',
                    phone: '',
                    facebook: '',
                    instagram: '',
                    foto: '',
                    level_badge: ''
                },
                openModal(staffData) {
                    this.activeStaff = staffData;
                    this.modalOpen = true;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.modalOpen = false;
                    document.body.style.overflow = 'auto';
                }
            }));
        });
    </script>
    @endonce
</div>
