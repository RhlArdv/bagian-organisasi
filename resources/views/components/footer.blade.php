{{-- ═══ MEGA FOOTER (Connected to Database) ═══ --}}
@php
    $footerDesc = \App\Models\SiteSetting::getValue('site_description', 'Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik.');
    $footerAddress = \App\Models\SiteSetting::getValue('address', 'Balaikota Padang, Jl. Bagindo Aziz Chan No.1, Aie Pacah, Kec. Koto Tangah');
    $footerHours = \App\Models\SiteSetting::getValue('working_hours', "Senin - Jumat\n08:00 - 16:00 WIB");
    $footerPhone = \App\Models\SiteSetting::getValue('phone', '(0751) 4640800');
    $footerEmail = \App\Models\SiteSetting::getValue('email', 'bag.organisasi@padang.go.id');
    
    $footerInstagram = \App\Models\SiteSetting::getValue('instagram');
    $footerFacebook = \App\Models\SiteSetting::getValue('facebook');
    $footerYoutube = \App\Models\SiteSetting::getValue('youtube');
    $footerTwitter = \App\Models\SiteSetting::getValue('twitter');

    $defaultFooterMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2683976643275!2d100.35692807531795!3d-0.9512986353524716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b948c7c72e11%3A0x6771787fa612c99f!2sSekretariat%20Daerah%20Kota%20Padang!5e0!3m2!1sid!2sid!4v1785310213215!5m2!1sid!2sid';
    $rawFooterMap = \App\Models\SiteSetting::getValue('google_maps_embed');
    if ($rawFooterMap && preg_match('/src=["\']([^"\']+)["\']/', $rawFooterMap, $matches)) {
        $footerMap = $matches[1];
    } elseif ($rawFooterMap) {
        $footerMap = $rawFooterMap;
    } else {
        $footerMap = $defaultFooterMap;
    }
@endphp

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
                    {{ $footerDesc }}
                </p>
                <div class="flex gap-3">
                    @if($footerInstagram)
                    <a href="{{ $footerInstagram }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-instagram-logo text-lg"></i></a>
                    @endif
                    @if($footerFacebook)
                    <a href="{{ $footerFacebook }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-facebook-logo text-lg"></i></a>
                    @endif
                    @if($footerYoutube)
                    <a href="{{ $footerYoutube }}" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-brand-500 hover:text-white transition-all border border-white/10"><i
                            class="ph-fill ph-youtube-logo text-lg"></i></a>
                    @endif
                    @if($footerTwitter)
                    <a href="{{ $footerTwitter }}" target="_blank"
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

            {{-- Contact & Lokasi Column --}}
            <div class="lg:col-span-2">
                <h4 class="text-white font-bold mb-6 flex items-center gap-2"><i
                        class="ph-fill ph-map-pin text-brand-500"></i> Hubungi & Lokasi Kami</h4>
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:p-8 backdrop-blur-sm">
                    <div class="grid sm:grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-map-pin text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Alamat Kantor</p>
                                    <p class="text-xs text-gray-400 leading-relaxed">{!! nl2br(e($footerAddress)) !!}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-clock text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Jam Pelayanan</p>
                                    <p class="text-xs text-gray-400">{!! nl2br(e($footerHours)) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start gap-4 mb-6">
                                <i class="ph-fill ph-phone text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Telepon</p>
                                    <p class="text-xs text-gray-400">{{ $footerPhone }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="ph-fill ph-envelope-simple text-brand-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-white mb-1.5">Email Resmi</p>
                                    <p class="text-xs text-gray-400 break-all">{{ $footerEmail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mini Interactive Map in Footer --}}
                    <div class="mt-6 pt-6 border-t border-white/10">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                                <i class="ph-fill ph-navigation-arrow text-brand-400"></i> Lokasi Kantor di Google Maps
                            </span>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($footerAddress) }}" target="_blank" class="text-[11px] font-extrabold text-brand-400 hover:text-brand-300 transition-colors flex items-center gap-1">
                                <span>Buka di Maps</span> <i class="ph-bold ph-arrow-square-out"></i>
                            </a>
                        </div>
                        <div class="w-full h-44 rounded-2xl overflow-hidden border border-white/10 relative bg-gray-900/50 shadow-inner">
                            <iframe 
                                src="{{ $footerMap }}" 
                                class="w-full h-full absolute inset-0 filter invert-[0.9] hue-rotate-180 brightness-95 contrast-[0.9] hover:filter-none transition-all duration-500" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
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