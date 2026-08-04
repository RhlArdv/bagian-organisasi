<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Portal resmi Bagian Organisasi Sekretariat Daerah Kota Padang.' }}">
    <title>{{ $title ?? 'Bagian Organisasi' }} — Setda Kota Padang</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}?v=1.0">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Phosphor Icons (jsDelivr Fast CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/index.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/duotone/style.css">
    
    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    <style>
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
            position: relative;
        }
    </style>
</head>
<body class="bg-[#f4f7f6] text-gray-900 antialiased overflow-x-hidden min-h-screen flex flex-col"
      x-data="{ scrolled: false, mobileOpen: false }"
      @scroll.window.passive="scrolled = (window.pageYOffset > 30)">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 w-full pt-28 lg:pt-32 pb-20">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    @stack('scripts')

    
    {{-- AOS Scroll Animations --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dynamically add data-aos to section containers to avoid hardcoding everywhere
            const sections = document.querySelectorAll('section, main > div');
            sections.forEach((sec, index) => {
                const children = sec.children;
                for (let i = 0; i < children.length; i++) {
                    // Skip decorative absolute backgrounds
                    if (!children[i].classList.contains('absolute') && !children[i].classList.contains('pointer-events-none')) {
                        children[i].setAttribute('data-aos', 'fade-up');
                    }
                }
            });
            AOS.init({
                once: true,
                offset: 100,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>

    {{-- Widget Aksesibilitas Disabilitas (Ramah Inklusi) --}}
    <x-accessibility-widget />

    {{-- Widget Live Chat Pengguna (IP Locked System) --}}
    <x-live-chat />
</body>
</html>
