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

    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    
    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
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

    {{-- Accessibility Widget --}}
    <script src="https://cdn.jsdelivr.net/npm/sienna-accessibility/dist/sienna-accessibility.umd.js" async></script>
</body>
</html>
