<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Portal resmi Bagian Organisasi Sekretariat Daerah Kota Padang.' }}">
    <title>{{ $title ?? 'Bagian Organisasi' }} — Setda Kota Padang</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" integrity="sha384-/rJKQnzOkEo+daG0jMjU1IwwY9unxt1NBw3Ef2fmOJ3PW/TfAg2KXVoWwMZQZtw9" crossorigin="anonymous">

    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1" integrity="sha384-cPFV+/abYd3INVFHPmSKpBmcnH+Q+bTZW7dv/EiuShUNPkHyFmRF8PsL7Ibfvunk" crossorigin="anonymous"></script>
    
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" integrity="sha384-wziAfh6b/qT+3LrqebF9WeK4+J5sehS6FA10J1t3a866kJ/fvU5UwofWnQyzLtwu" crossorigin="anonymous"></script>
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
