@php
    $waNumber = '6285335104803';
    $address = 'Jl. Raya Suyitman No.178, Sumberan, Ambulu, Kec. Ambulu, Kabupaten Jember, Jawa Timur 68172';
    $mapsDirectionsUrl = 'https://www.google.com/maps/dir//Masjid+Nurul+Huda,+Jl.+Raya+Suyitman+No.178,+Sumberan,+Ambulu,+Kec.+Ambulu,+Kabupaten+Jember,+Jawa+Timur+68172/@-8.3405935,113.6070066,15z/data=!4m8!4m7!1m0!1m5!1m1!1s0x2dd69b6517e45ae3:0x829f0a64dafd48f8!2m2!1d113.6070445!2d-8.3425199';
    $mapsEmbedUrl = 'https://www.google.com/maps?q=Masjid+Nurul+Huda+Ambulu,'.$address.'&output=embed';
@endphp

<footer class="bg-[#2c368B] text-white/70">
    <div class="border-t border-white/10">
        <iframe
            src="{{ $mapsEmbedUrl }}"
            width="100%"
            height="360"
            style="border:0;"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi Masjid Nurul Huda Ambulu"
            class="grayscale-[30%]"></iframe>
    </div>
    <div class="max-w-5xl mx-auto px-5 py-12 grid sm:grid-cols-3 gap-8">
        <div>
            <p class="font-semibold text-white">Masjid Nurul Huda Ambulu</p>
            <p class="mt-2 text-sm leading-relaxed">
                Pusat ibadah dan kegiatan umat yang transparan dalam pengelolaan dana dan aktif dalam kegiatan dakwah.
            </p>
        </div>

        <div>
            <p class="font-semibold text-white text-sm uppercase tracking-wide">Halaman</p>
            <ul class="mt-3 space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                <li><a href="{{ route('committee-members.index') }}" class="hover:text-white transition">Pengurus</a></li>
                <li><a href="{{ route('donation-programs.index') }}" class="hover:text-white transition">Donasi</a></li>
                <li><a href="{{ route('financial-reports.index') }}" class="hover:text-white transition">Laporan Keuangan</a></li>
                <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Kajian & Event</a></li>
                <li><a href="{{ route('venue.index') }}" class="hover:text-white transition">Akad Venue</a></li>
            </ul>
        </div>

        <div>
            <p class="font-semibold text-white text-sm uppercase tracking-wide">Kontak</p>
            <ul class="mt-3 space-y-2 text-sm">
                <li>
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="hover:text-white transition">
                        WhatsApp Admin
                    </a>
                </li>
                <li>
                    <a href="{{ $mapsDirectionsUrl }}" target="_blank" rel="noopener" class="hover:text-white transition">
                        {{ $address }}
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="border-t border-white/10 py-6 px-5 text-center text-xs">
        &copy; {{ now()->year }} Masjid Nurul Huda Ambulu. All Rights Reserved.
    </div>
</footer>
