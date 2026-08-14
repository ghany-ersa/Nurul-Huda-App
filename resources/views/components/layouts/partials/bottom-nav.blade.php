@php
    $bottomNavItems = [
        [
            'label' => 'Beranda',
            'route' => 'home',
            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        ],
        [
            'label' => 'Donasi',
            'route' => 'donation-programs.index',
            'icon' => 'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z',
        ],
        [
            'label' => 'Kajian',
            'route' => 'events.index',
            'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
        ],
        [
            'label' => 'Venue',
            'route' => 'venue.index',
            'icon' => 'M9 21V10l7-5 7 5v11M9 21h12M9 21v-6h4v6',
        ],
    ];

    $moreLinks = [
        ['label' => 'Pengurus', 'route' => 'committee-members.index'],
        ['label' => 'Laporan Keuangan', 'route' => 'financial-reports.index'],
    ];

    $isMoreActive = collect($moreLinks)->contains(fn ($link) => request()->routeIs($link['route'].'*'));
@endphp

<div x-data="{ moreOpen: false }" class="lg:hidden">
    <nav class="fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-100"
         style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="grid grid-cols-5">
            @foreach ($bottomNavItems as $item)
                @php $isActive = request()->routeIs($item['route'].'*'); @endphp
                <a href="{{ route($item['route']) }}"
                   class="relative flex flex-col items-center justify-center gap-1 py-2.5 transition-colors"
                   :class="'{{ $isActive ? 'text-[#1e79cc]' : 'text-slate-500' }}'">
                    <span @class([
                        'absolute top-0 h-0.5 w-8 rounded-full bg-[#1e79cc] transition-all duration-300',
                        'opacity-100 scale-x-100' => $isActive,
                        'opacity-0 scale-x-0' => ! $isActive,
                    ])></span>
                    <svg class="w-5 h-5 transition-transform duration-300 {{ $isActive ? '-translate-y-0.5 scale-110' : '' }}"
                         fill="none" stroke="currentColor" stroke-width="{{ $isActive ? 2.2 : 1.8 }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                    </svg>
                    <span class="text-[10px] font-medium leading-none transition-transform duration-300 {{ $isActive ? '-translate-y-0.5' : '' }}">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endforeach

            <button @click="moreOpen = true"
                    class="relative flex flex-col items-center justify-center gap-1 py-2.5 transition-colors"
                    :class="'{{ $isMoreActive ? 'text-[#1e79cc]' : 'text-slate-500' }}'">
                <span @class([
                    'absolute top-0 h-0.5 w-8 rounded-full bg-[#1e79cc] transition-all duration-300',
                    'opacity-100 scale-x-100' => $isMoreActive,
                    'opacity-0 scale-x-0' => ! $isMoreActive,
                ])></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-[10px] font-medium leading-none">Lainnya</span>
            </button>
        </div>
    </nav>

    {{-- Sheet "Lainnya" --}}
    <div x-show="moreOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="moreOpen = false"
         class="fixed inset-0 z-50 bg-slate-900/40"></div>

    <div x-show="moreOpen" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 inset-x-0 z-50 bg-white rounded-t-3xl shadow-2xl"
         style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="flex justify-center pt-3">
            <span class="w-10 h-1 rounded-full bg-slate-200"></span>
        </div>
        <div class="px-5 pt-3 pb-6">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Halaman Lainnya</p>
            <div class="mt-3 space-y-1">
                @foreach ($moreLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       @click="moreOpen = false"
                       @class([
                           'flex items-center justify-between px-4 py-3.5 rounded-xl text-sm font-medium transition',
                           'bg-[#1e79cc]/10 text-[#1e79cc]' => request()->routeIs($link['route'].'*'),
                           'text-slate-700 hover:bg-slate-50' => ! request()->routeIs($link['route'].'*'),
                       ])>
                        {{ $link['label'] }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
