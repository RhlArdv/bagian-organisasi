<x-guest-layout>
    <div class="flex flex-row-reverse min-h-screen bg-white">
        
        {{-- LEFT COLUMN: LOGIN FORM --}}
        <div class="w-full lg:w-1/2 flex flex-col px-8 py-10 sm:px-16 md:px-24 justify-center relative">
            
            {{-- Logo Top Left --}}
            <a href="/" class="absolute top-10 left-8 sm:left-16 md:left-24 flex items-center gap-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-10 h-12 object-contain">
                <div>
                    <span class="block text-[9px] font-bold text-gray-500 uppercase tracking-widest">Pemerintah Kota Padang</span>
                    <span class="block text-xs font-extrabold text-gray-900">BAGIAN ORGANISASI</span>
                </div>
            </a>

            <div class="max-w-md w-full mx-auto mt-20">
                <h2 class="text-3xl font-black text-gray-900 mb-2">Selamat Datang</h2>
                <p class="text-gray-500 font-medium mb-10 text-sm">Silakan masuk ke akun Anda untuk mengelola konten dan sistem Bagian Organisasi.</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-sm font-medium text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph-bold ph-envelope-simple text-gray-400 text-lg"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition-all font-medium placeholder:text-gray-400"
                                placeholder="nama@padang.go.id" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-gray-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-brand-500 hover:text-brand-600 transition-colors">Lupa sandi?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph-bold ph-lock-key text-gray-400 text-lg"></i>
                            </div>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                                class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition-all font-medium placeholder:text-gray-400"
                                placeholder="••••••••" />
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-brand-500 focus:outline-none transition-colors" title="Tampilkan/Sembunyikan Kata Sandi">
                                <i class="ph-bold text-lg" :class="show ? 'ph-eye-slash' : 'ph-eye'"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label for="remember_me" class="flex items-center cursor-pointer">
                            <div class="relative flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" class="peer sr-only">
                                <div class="w-5 h-5 bg-gray-100 border border-gray-300 rounded peer-checked:bg-brand-500 peer-checked:border-brand-500 transition-colors flex items-center justify-center">
                                    <i class="ph-bold ph-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                                </div>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-600">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#1a202c] hover:bg-brand-500 text-white font-bold py-4 px-8 rounded-2xl transition-colors duration-300 shadow-xl shadow-brand-500/20">
                        <span>Masuk ke Dashboard</span>
                        <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </form>
            </div>
            
            <div class="mt-auto pt-10 pb-4 text-center">
                <p class="text-xs font-medium text-gray-400">&copy; {{ date('Y') }} Bagian Organisasi Setda Kota Padang.</p>
            </div>
        </div>

        {{-- RIGHT COLUMN: BRANDING (Hidden on Mobile) --}}
        <div class="hidden lg:flex w-1/2 bg-[#0a0f1c] relative overflow-hidden items-center justify-center p-12">
            {{-- Decorative glow --}}
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-brand-500/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-[120px]"></div>
            
            <div class="relative z-10 max-w-lg text-center">
                <div class="w-24 h-24 bg-white/10 rounded-3xl backdrop-blur-xl border border-white/20 flex items-center justify-center mx-auto mb-8 shadow-2xl">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Padang" class="w-16 h-16 object-contain drop-shadow-xl">
                </div>
                <h1 class="text-4xl font-black text-white mb-4 leading-tight">
                    Sistem Informasi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-brand-300">Bagian Organisasi</span>
                </h1>
                <p class="text-gray-400 text-sm font-medium leading-relaxed mb-10 px-8">
                    Portal terpadu untuk mengelola konten website, layanan perizinan, dan informasi tata kelola organisasi secara efisien, transparan, dan terukur.
                </p>
                
                <div class="flex items-center justify-center gap-4">
                    <div class="flex -space-x-4">
                        <div class="w-10 h-10 rounded-full border-2 border-[#0a0f1c] bg-gray-200 flex items-center justify-center overflow-hidden"><img src="{{ asset('assets/img/staff/kepala_pejabat_1785375141153.png') }}" class="w-full h-full object-cover"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#0a0f1c] bg-gray-200 flex items-center justify-center overflow-hidden"><img src="{{ asset('assets/img/staff/hendra_putra_1785375385658.png') }}" class="w-full h-full object-cover"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#0a0f1c] bg-gray-200 flex items-center justify-center overflow-hidden"><img src="{{ asset('assets/img/staff/yeni_martina_1785375402271.png') }}" class="w-full h-full object-cover"></div>
                    </div>
                    <div class="text-left">
                        <div class="flex items-center gap-1 text-brand-400">
                            <i class="ph-fill ph-star text-xs"></i>
                            <i class="ph-fill ph-star text-xs"></i>
                            <i class="ph-fill ph-star text-xs"></i>
                            <i class="ph-fill ph-star text-xs"></i>
                            <i class="ph-fill ph-star text-xs"></i>
                        </div>
                        <p class="text-[10px] font-bold text-gray-300 mt-0.5 uppercase tracking-wide">Tim Pengelola Terpadu</p>
                    </div>
                </div>
            </div>
            
            {{-- Abstract Pattern Overlay --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

    </div>
</x-guest-layout>
