@php
    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $isKajian = $event->type === 'kajian';
@endphp

<x-layouts.app
    :title="$event->title"
    :description="'Informasi ' . ($isKajian ? 'kajian rutin' : 'event') . ' ' . $event->title . ' di Masjid Nurul Huda Ambulu.'"
    :image="$event->poster"
    keywords="{{ $event->title }}, kajian masjid nurul huda ambulu, event masjid ambulu">

    <section class="px-5 py-10 max-w-3xl mx-auto">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-[#1e79cc] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Jadwal Kajian & Event
        </a>

        @if ($event->poster)
            <div class="mt-5 aspect-[16/9] rounded-2xl overflow-hidden bg-slate-100">
                <img src="{{ $event->poster }}" alt="{{ $event->title }}"
                     class="w-full h-full object-cover" />
            </div>
        @endif

        <span class="mt-6 inline-block text-xs font-semibold px-2.5 py-1 rounded-full bg-[#1e79cc]/10 text-[#1e79cc]">
            {{ $isKajian ? 'Kajian Rutin' : 'Event Khusus' }}
        </span>
        <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">{{ $event->title }}</h1>

        <div class="mt-3 flex flex-wrap gap-4 text-sm text-slate-600">
            @if ($isKajian && $event->day_of_week !== null)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#1e79cc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Setiap {{ $dayNames[$event->day_of_week] ?? '-' }}
                </span>
            @endif
            @if ($event->time)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#1e79cc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ \Illuminate\Support\Carbon::parse($event->time)->format('H:i') }} WIB
                </span>
            @endif
            @if ($event->event_date)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#1e79cc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $event->event_date->translatedFormat('d F Y') }}
                </span>
            @endif
            @if ($event->speaker)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#1e79cc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    {{ $event->speaker }}
                </span>
            @endif
        </div>

        @if ($event->description)
            <div class="mt-4 text-slate-600 leading-relaxed [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                {!! $event->description !!}
            </div>
        @endif

        {{-- DOKUMENTASI KEGIATAN --}}
        @if ($event->photos->isNotEmpty())
            <div class="mt-10">
                <h2 class="text-lg font-bold text-[#2c368B]">Dokumentasi Kegiatan</h2>
                <x-photo-carousel
                    :photos="$event->photos"
                    :alt-fallback="$event->title"
                    class="mt-4" />
            </div>
        @endif
    </section>
</x-layouts.app>
