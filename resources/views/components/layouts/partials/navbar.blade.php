@php
    $navLinks = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Pengurus', 'route' => 'committee-members.index'],
        ['label' => 'Donasi', 'route' => 'donation-programs.index'],
        ['label' => 'Laporan Keuangan', 'route' => 'financial-reports.index'],
        ['label' => 'Kajian & Event', 'route' => 'events.index'],
        ['label' => 'Akad Venue', 'route' => 'venue.index'],
    ];
@endphp

<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
    <nav class="max-w-5xl mx-auto px-5 h-16 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-[#2c368B]">
            <span class="text-lg">Masjid Nurul Huda</span>
        </a>

        {{-- Desktop nav --}}
        <div class="hidden lg:flex items-center gap-6">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   @class([
                       'text-sm font-medium transition whitespace-nowrap',
                       'text-[#1e79cc]' => request()->routeIs($link['route'].'*'),
                       'text-slate-600 hover:text-[#1e79cc]' => ! request()->routeIs($link['route'].'*'),
                   ])>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </nav>
</header>
