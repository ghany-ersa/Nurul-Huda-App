@props([
    'title' => 'Masjid Nurul Huda Ambulu',
    'description' => 'Wakaf pembangunan Masjid Nurul Huda Ambulu. Setiap donasi adalah investasi akhirat — mari ambil bagian dalam pembangunan rumah Allah.',
    'image' => null,
    'keywords' => 'wakaf masjid, donasi masjid, masjid nurul huda ambulu, pembangunan masjid, wakaf pembangunan, suara muhammadiyah ambulu, infaq masjid',
])

@php
    $siteName = 'Masjid Nurul Huda Ambulu';
    $fullTitle = $title === $siteName ? $title : $title . ' | ' . $siteName;
    $heroImage = rtrim(config('filesystems.disks.r2.url'), '/') . '/venue-page/NH.jpg';
    $ogImage = $image ?: asset('images/og-image.jpg');
    $isFallbackOgImage = ! $image;
    $canonical = url()->current();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Primary SEO --}}
    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="author" content="Suara Muhammadiyah Ambulu">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#2c368B">
    <link rel="canonical" href="{{ $canonical }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ $heroImage }}">

    {{-- Open Graph (Facebook, WhatsApp, LinkedIn) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:secure_url" content="{{ $ogImage }}">
    <meta property="og:image:type" content="image/jpeg">
    @if ($isFallbackOgImage)
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="654">
    @endif
    <meta property="og:image:alt" content="{{ $siteName }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Performance hints --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://fonts.bunny.net">

    {{-- Structured Data (Schema.org) --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'NGO',
        'name' => $siteName,
        'alternateName' => 'Wakaf Masjid Nurul Huda',
        'url' => url('/'),
        'logo' => $heroImage,
        'image' => $ogImage,
        'description' => $description,
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Ambulu',
            'addressRegion' => 'Jawa Timur',
            'addressCountry' => 'ID',
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => '+62-853-3510-4803',
            'contactType' => 'donations',
            'name' => 'Ferry',
        ],
        'sameAs' => [],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>

<body class="antialiased bg-white text-slate-900 pb-16 lg:pb-0">
    <x-layouts.partials.navbar />

    {{ $slot }}

    <x-layouts.partials.footer />

    <x-layouts.partials.bottom-nav />

    @stack('scripts')
    @livewireScripts
</body>

</html>
