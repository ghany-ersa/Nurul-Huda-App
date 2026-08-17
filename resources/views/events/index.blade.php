@php
    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
@endphp

<x-layouts.app title="Jadwal Kajian & Event"
    description="Jadwal kajian rutin dan event khusus Masjid Nurul Huda Ambulu — ikuti kegiatan dakwah dan kebersamaan jamaah."
    keywords="jadwal kajian masjid nurul huda ambulu, kajian rutin, event masjid ambulu">

    <section class="px-5 py-14 max-w-3xl mx-auto">
        <div class="text-center">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Kegiatan</span>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Jadwal Kajian & Event</h1>
            <p class="mt-4 text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Ikuti kajian rutin dan event khusus yang diselenggarakan Masjid Nurul Huda Ambulu.
            </p>
        </div>

        {{-- KAJIAN RUTIN --}}
        <div class="mt-12">
            <h2 class="text-lg font-bold text-[#2c368B]">Kajian Rutin</h2>

            @if ($kajianRutin->isEmpty())
                <p class="mt-4 text-sm text-slate-500">Belum ada jadwal kajian rutin.</p>
            @else
                <div class="mt-4 space-y-3">
                    @foreach ($kajianRutin as $kajian)
                        <a href="{{ route('events.show', $kajian) }}"
                            class="flex items-center gap-4 bg-white border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition">
                            <div
                                class="w-16 h-16 shrink-0 rounded-xl bg-gradient-to-br from-[#2c368B] to-[#1e79cc] text-white flex flex-col items-center justify-center text-center">
                                <span
                                    class="text-xs font-medium leading-tight px-1">{{ $dayNames[$kajian->day_of_week] ?? '-' }}</span>
                                @if ($kajian->time)
                                    <span
                                        class="text-sm font-bold leading-tight">{{ \Illuminate\Support\Carbon::parse($kajian->time)->format('H:i') }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900">{{ $kajian->title }}</p>
                                @if ($kajian->speaker)
                                    <p class="text-sm text-slate-500">Bersama {{ $kajian->speaker }}</p>
                                @endif
                                @if ($kajian->description)
                                    <div
                                        class="hidden md:block mt-1 text-sm text-slate-600 [&_p]:mb-1 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                        {!! $kajian->description !!}
                                    </div>
                                @endif
                            </div>
                            @if ($kajian->poster)
                                <img src="{{ $kajian->poster_url }}" alt="{{ $kajian->title }}"
                                    class="w-24 h-16 sm:w-28 sm:h-20 shrink-0 object-cover rounded-lg" loading="lazy" />
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- EVENT KHUSUS --}}
        <div class="mt-12">
            <h2 class="text-lg font-bold text-[#2c368B]">Event Khusus</h2>

            @if ($eventKhusus->isEmpty())
                <p class="mt-4 text-sm text-slate-500">Belum ada event khusus yang dijadwalkan.</p>
            @else
                <div class="mt-4 space-y-3">
                    @foreach ($eventKhusus as $event)
                        <a href="{{ route('events.show', $event) }}"
                            class="flex items-center gap-4 bg-white border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition">
                            <div
                                class="w-14 h-14 shrink-0 rounded-xl bg-gradient-to-br from-[#2c368B] to-[#1e79cc] text-white flex flex-col items-center justify-center">
                                <span
                                    class="text-xs font-medium leading-none">{{ $event->event_date->translatedFormat('M') }}</span>
                                <span
                                    class="text-lg font-bold leading-tight">{{ $event->event_date->format('d') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900">{{ $event->title }}</p>
                                <p class="text-xs text-slate-500">{{ $event->event_date->translatedFormat('d F Y') }}
                                </p>
                                @if ($event->description)
                                    <div
                                        class="mt-1 text-sm text-slate-600 [&_p]:mb-1 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                        {!! $event->description !!}
                                    </div>
                                @endif
                            </div>
                            @if ($event->poster)
                                <img src="{{ $event->poster_url }}" alt="{{ $event->title }}"
                                    class="w-24 h-16 sm:w-28 sm:h-20 shrink-0 object-cover rounded-lg" loading="lazy" />
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
