{{-- ═══ MEGA FOOTER ═══ --}}
<footer class="bg-[#0f172a] text-white pt-20 pb-10 relative overflow-hidden mt-auto">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-1/2 h-full opacity-5 pointer-events-none z-0">
        <img src="{{ asset('assets/img/logo.png') }}"
            class="w-full h-full object-contain object-right-top mix-blend-luminosity" alt="">
    </div>

    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">

        {{-- Footer Main Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shrink-0">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-full h-auto">
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-brand-400 tracking-widest uppercase">Pemerintah
                            Kota Padang</span>
                        <span class="block text-base font-extrabold text-white leading-tight">BAGIAN ORGANISASI</span>
                    </div>
                </div>
                <p class="text-sm text-gray-400 font-medium leading-relaxed mb-6">
                    {{ \App\Models\SiteSetting::getValue('site_description', 'Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik.') }}
                </p>
                <div class="flex gap-3">
                    @if($instagram = \App\Models\SiteSetting::getValue('instagram'))
                    <a href="{{ $instagram }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-instagram-logo text-lg"></i></a>
                    @endif
                    @if($facebook = \App\Models\SiteSetting::getValue('facebook'))
                    <a href="{{ $facebook }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-facebook-logo text-lg"></i></a>
                    @endif
                    @if($youtube = \App\Models\SiteSetting::getValue('youtube'))
                    <a href="{{ $youtube }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-youtube-logo text-lg"></i></a>
                    @endif
                    @if($twitter = \App\Models\SiteSetting::getValue('twitter'))
                    <a href="{{ $twitter }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-twitter-logo text-lg"></i></a>
                    @endif
                </div>
            </div>

            {{-- Links Column --}}
            <div>
                <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i
                        class="ph-fill ph-link text-brand-500"></i> Tautan Cepat</h4>
                <ul class="space-y-4">
                    <li><a href="/profil"
                            class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i
                                class="ph-bold ph-caret-right text-[10px]"></i> Profil Organisasi</a></li>
                    <li><a href="/#kelembagaan"
                            class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i
                                class="ph-bold ph-caret-right text-[10px]"></i> Layanan Kelembagaan</a></li>
                    <li><a href="/#regulasi"
                            class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i
                                class="ph-bold ph-caret-right text-[10px]"></i> Regulasi & Aturan</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-400 font-medium hover:text-brand-400 transition-colors inline-flex items-center gap-2"><i
                                class="ph-bold ph-caret-right text-[10px]"></i> PPID</a></li>
                </ul>
            </div>

            {{-- Contact Column --}}
            <div class="lg:col-span-2">
                <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i
                        class="ph-fill ph-map-pin text-brand-500"></i> Hubungi Kami</h4>
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:p-8 backdrop-blur-sm">
                    <div class="grid sm:grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-map-pin text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Alamat Kantor</p>
                                    <p class="text-xs text-gray-400 leading-relaxed">{{ \App\Models\SiteSetting::getValue('address', 'Balaikota Padang, Jl. Bagindo Aziz Chan No.1, Aie Pacah, Kec. Koto Tangah') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-clock text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Jam Pelayanan</p>
                                    <p class="text-xs text-gray-400">{!! nl2br(e(\App\Models\SiteSetting::getValue('working_hours', "Senin - Jumat\n08:00 - 16:00 WIB"))) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-phone text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Telepon</p>
                                    <p class="text-xs text-gray-400">{{ \App\Models\SiteSetting::getValue('phone', '(0751) 4640800') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-envelope-simple text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Email Resmi</p>
                                    <p class="text-xs text-gray-400 break-all">{{ \App\Models\SiteSetting::getValue('email', 'bag.organisasi@padang.go.id') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-500 font-medium">
                &copy; {{ date('Y') }} Bagian Organisasi Sekretariat Daerah Kota Padang. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-xs text-gray-500 font-medium hover:text-white transition-colors">Kebijakan
                    Privasi</a>
                <a href="#" class="text-xs text-gray-500 font-medium hover:text-white transition-colors">Syarat &
                    Ketentuan</a>
            </div>
        </div>
    </div>
</footer>