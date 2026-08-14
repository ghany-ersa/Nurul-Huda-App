@php
    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
@endphp

<x-layouts.app
    title="Masjid Nurul Huda Ambulu"
    description="Masjid Nurul Huda Ambulu — pusat ibadah dan kegiatan umat yang transparan dalam pengelolaan dana, aktif dalam kajian, dan terbuka untuk jamaah."
    keywords="masjid nurul huda ambulu, masjid ambulu, fasilitas masjid, donasi masjid, kajian masjid, suara muhammadiyah ambulu">

    {{-- HERO --}}
    <section class="relative min-h-[80svh] flex items-end overflow-hidden">
        <img src="{{ asset('images/NH Nabawi.png') }}"
             alt="Masjid Nurul Huda Ambulu"
             loading="eager"
             class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-b via-[#2c368B]/50 to-[#1e79cc]/55"></div>

        <div class="relative w-full px-5 pt-24 pb-16 max-w-3xl mx-auto text-white">
            <h1 class="text-3xl sm:text-5xl font-bold leading-tight tracking-tight">
                Masjid <span class="text-[#7ec1ee]">Nurul Huda</span> Ambulu
            </h1>
            <p class="mt-3 text-base sm:text-lg text-white/90 max-w-xl">
                Pusat ibadah dan kegiatan umat yang transparan dalam pengelolaan dana dan terbuka untuk seluruh jamaah.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('donation-programs.index') }}"
                   class="inline-flex items-center gap-2 bg-white text-[#2c368B] font-semibold py-3 px-6 rounded-xl shadow-lg hover:bg-slate-50 active:scale-[.98] transition">
                    Lihat Program Donasi
                </a>
                <a href="{{ route('committee-members.index') }}"
                   class="inline-flex items-center gap-2 bg-white/15 backdrop-blur border border-white/30 text-white font-semibold py-3 px-6 rounded-xl hover:bg-white/25 active:scale-[.98] transition">
                    Kenali Pengurus
                </a>
            </div>
        </div>
    </section>

    {{-- TENTANG MASJID --}}
    <section class="px-5 py-14 max-w-3xl mx-auto">
        <div class="text-center">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Tentang Masjid</span>
            <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Pusat Ibadah & Kegiatan Umat</h2>
            <p class="mt-4 text-slate-600 leading-relaxed">
                Masjid Nurul Huda Ambulu adalah rumah ibadah sekaligus pusat kegiatan keagamaan,
                pendidikan, dan sosial bagi masyarakat sekitar. Kami berkomitmen mengelola dana umat
                secara transparan dan menghadirkan kegiatan yang bermanfaat bagi jamaah.
            </p>
        </div>
    </section>

    {{-- FASILITAS --}}
    @if ($facilities->isNotEmpty())
        <section class="py-14 bg-slate-50/60">
            <div class="px-5 max-w-5xl mx-auto">
                <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Fasilitas</span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Fasilitas Masjid</h2>
                <p class="mt-2 text-slate-600">Sarana dan prasarana yang tersedia untuk jamaah.</p>

                <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6" data-photo-gallery>
                    @foreach ($facilities as $facility)
                        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-slate-100 flex flex-col">
                            @if ($facility->photo)
                                <div class="aspect-[4/3] bg-slate-100 overflow-hidden">
                                    <img src="{{ $facility->photo_url }}" alt="{{ $facility->name }}" loading="lazy"
                                         class="w-full h-full object-cover object-center hover:scale-105 transition duration-500 cursor-zoom-in" />
                                </div>
                            @endif
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="font-semibold text-slate-900">{{ $facility->name }}</h3>
                                @if ($facility->description)
                                    <div class="mt-2 text-sm text-slate-600 leading-relaxed [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                        {!! $facility->description !!}
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- GALERI --}}
    @if ($galleryPhotos->isNotEmpty())
        <section class="py-14">
            <div class="px-5 text-center">
                <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Galeri</span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Dokumentasi Kegiatan</h2>
            </div>

            <x-photo-carousel
                :photos="$galleryPhotos"
                alt-fallback="Dokumentasi kegiatan masjid"
                aspect="aspect-[4/3] sm:aspect-[21/9]"
                rounded=""
                class="mt-8" />
        </section>
    @endif

    {{-- DONASI AKTIF --}}
    @if ($activeDonationPrograms->isNotEmpty())
        <section class="px-5 py-14 max-w-5xl mx-auto">
            <div class="flex items-end justify-between flex-wrap gap-2">
                <div>
                    <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Donasi</span>
                    <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Program Donasi Aktif</h2>
                </div>
                <a href="{{ route('donation-programs.index') }}" class="text-[#1e79cc] font-semibold text-sm hover:underline">
                    Lihat semua &rarr;
                </a>
            </div>

            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6" data-photo-gallery>
                @foreach ($activeDonationPrograms as $program)
                    @php
                        $percent = $program->target_amount > 0
                            ? min(100, round($program->collected_amount / $program->target_amount * 100, 1))
                            : 0;
                    @endphp
                    <a href="{{ route('donation-programs.show', $program) }}"
                       class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-slate-100 flex flex-col">
                        @if ($program->cover_photo)
                            <div class="aspect-[16/9] bg-slate-100 overflow-hidden">
                                <img src="{{ $program->cover_photo_url }}" alt="{{ $program->name }}" loading="lazy"
                                     class="w-full h-full object-cover object-center hover:scale-105 transition duration-500 cursor-zoom-in" />
                            </div>
                        @endif
                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="font-semibold text-slate-900">{{ $program->name }}</h3>
                            <div class="mt-3 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-[#2c368B] to-[#1e79cc] rounded-full"
                                     style="width: {{ $percent }}%"></div>
                            </div>
                            <div class="mt-2 flex justify-between text-xs text-slate-500">
                                <span>Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                                <span>{{ $percent }}%</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- KAJIAN TERDEKAT --}}
    @if ($upcomingEvents->isNotEmpty())
        <section class="py-14 bg-slate-50/60">
            <div class="px-5 max-w-3xl mx-auto">
                <div class="flex items-end justify-between flex-wrap gap-2">
                    <div>
                        <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Kegiatan</span>
                        <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Kajian & Event Terdekat</h2>
                    </div>
                    <a href="{{ route('events.index') }}" class="text-[#1e79cc] font-semibold text-sm hover:underline">
                        Lihat semua &rarr;
                    </a>
                </div>

                <div class="mt-8 space-y-3" data-photo-gallery>
                    @foreach ($upcomingEvents as $event)
                        <a href="{{ route('events.show', $event) }}"
                           class="flex items-center gap-4 bg-white border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition">
                            <div class="w-14 h-14 shrink-0 rounded-xl bg-gradient-to-br from-[#2c368B] to-[#1e79cc] text-white flex flex-col items-center justify-center">
                                <span class="text-xs font-medium leading-none">{{ $event->event_date->translatedFormat('M') }}</span>
                                <span class="text-lg font-bold leading-tight">{{ $event->event_date->format('d') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900">{{ $event->title }}</p>
                                <p class="text-xs text-slate-500">{{ $event->event_date->translatedFormat('d F Y') }}</p>
                                @if ($event->description)
                                    <div class="mt-1 text-sm text-slate-600 [&_p]:mb-1 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                        {!! $event->description !!}
                                    </div>
                                @endif
                            </div>
                            @if ($event->poster)
                                <img src="{{ $event->poster_url }}" alt="{{ $event->title }}"
                                     class="w-14 h-20 sm:w-16 sm:h-24 shrink-0 object-cover rounded-lg cursor-zoom-in" loading="lazy" />
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- AJAKAN DONASI --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#2c368B] via-[#2c368B] to-[#1e79cc] text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px), radial-gradient(circle at 80% 60%, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative px-5 py-16 max-w-2xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold leading-tight">
                Mari Ambil Bagian dalam <span class="text-[#7ec1ee]">Kebaikan Bersama</span>
            </h2>
            <p class="mt-4 text-white/90 text-lg italic">
                "Setiap donasi adalah investasi akhirat."
            </p>
            <a href="{{ route('donation-programs.index') }}"
               class="mt-8 inline-flex items-center justify-center gap-2 bg-white text-[#2c368B] font-bold py-4 px-8 rounded-xl shadow-xl hover:bg-slate-50 active:scale-[.98] transition">
                Saya Ingin Berdonasi
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </section>
</x-layouts.app>
