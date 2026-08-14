@php
    $percent = $donationProgram->target_amount > 0
        ? min(100, round($donationProgram->collected_amount / $donationProgram->target_amount * 100, 1))
        : 0;

    $statusLabel = match ($donationProgram->status) {
        'upcoming' => 'Akan Datang',
        'active' => 'Aktif',
        'completed' => 'Selesai',
        'expired' => 'Berakhir',
        default => $donationProgram->status,
    };

    $statusClass = match ($donationProgram->status) {
        'upcoming' => 'bg-slate-100 text-slate-600',
        'active' => 'bg-emerald-100 text-emerald-700',
        'completed' => 'bg-sky-100 text-sky-700',
        'expired' => 'bg-red-100 text-red-700',
        default => 'bg-slate-100 text-slate-600',
    };

    $waNumber = '6285335104803';
    $waText = rawurlencode("Assalamualaikum, saya ingin berdonasi untuk program {$donationProgram->name}.");
@endphp

<x-layouts.app
    :title="$donationProgram->name"
    :description="'Salurkan donasi untuk program ' . $donationProgram->name . ' di Masjid Nurul Huda Ambulu.'"
    :image="$donationProgram->cover_photo_url"
    keywords="donasi masjid nurul huda ambulu, {{ $donationProgram->name }}">

    <section class="px-5 py-10 max-w-3xl mx-auto">
        <a href="{{ route('donation-programs.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-[#1e79cc] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Program Donasi
        </a>

        @if ($donationProgram->cover_photo)
            <div class="mt-5 aspect-[16/9] rounded-2xl overflow-hidden bg-slate-100" data-photo-gallery>
                <img src="{{ $donationProgram->cover_photo_url }}" alt="{{ $donationProgram->name }}"
                     class="w-full h-full object-cover cursor-zoom-in" />
            </div>
        @endif

        <span class="mt-6 inline-block text-xs font-semibold px-2.5 py-1 rounded-full {{ $statusClass }}">
            {{ $statusLabel }}
        </span>
        <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">{{ $donationProgram->name }}</h1>

        @if ($donationProgram->description)
            <div class="mt-4 text-slate-600 leading-relaxed [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                {!! $donationProgram->description !!}
            </div>
        @endif

        {{-- PROGRESS --}}
        <div class="mt-8 bg-white border border-slate-100 rounded-2xl shadow-sm p-5 sm:p-6">
            <div class="flex items-baseline justify-between">
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Terkumpul</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#1e79cc]">Rp {{ number_format($donationProgram->collected_amount, 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Target</p>
                    <p class="text-sm sm:text-base font-semibold text-slate-700">Rp {{ number_format($donationProgram->target_amount, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mt-4 h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-[#2c368B] to-[#1e79cc] rounded-full transition-all duration-1000"
                     style="width: {{ $percent }}%"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-500">
                <span>{{ $percent }}% tercapai</span>
                @if ($donationProgram->ends_at)
                    <span>Berakhir {{ $donationProgram->ends_at->translatedFormat('d M Y') }}</span>
                @endif
            </div>

            @if ($donationProgram->status === 'active')
                <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" rel="noopener"
                   class="mt-5 w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#2c368B] to-[#1e79cc] hover:opacity-95 active:scale-[.98] text-white font-semibold py-4 rounded-xl shadow-lg shadow-[#2c368B]/30 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                    </svg>
                    Donasi Sekarang
                </a>
            @endif
        </div>

         {{-- DOKUMENTASI KEGIATAN --}}
        @if ($donationProgram->photos->isNotEmpty())
            <div class="mt-10">
                <h2 class="text-lg font-bold text-[#2c368B]">Dokumentasi Kegiatan</h2>
                <x-photo-carousel
                    :photos="$donationProgram->photos"
                    :alt-fallback="$donationProgram->name"
                    class="mt-4" />
            </div>
        @endif

        {{-- RIWAYAT TRANSAKSI --}}
        <div class="mt-10">
            <h2 class="text-lg font-bold text-[#2c368B]">Riwayat Donasi</h2>

            @if ($donationProgram->transactions->isEmpty())
                <p class="mt-4 text-sm text-slate-500">Belum ada transaksi donasi untuk program ini.</p>
            @else
                <ul class="mt-4 divide-y divide-slate-100 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                    @foreach ($donationProgram->transactions as $transaction)
                        <li class="flex items-center justify-between px-5 py-4">
                            <div>
                                <p class="font-medium text-slate-900 text-sm">{{ $transaction->donor_name ?? 'Hamba Allah' }}</p>
                                <p class="text-xs text-slate-500">{{ $transaction->donated_at->translatedFormat('d M Y') }}</p>
                            </div>
                            <p class="font-semibold text-[#1e79cc] text-sm">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


    </section>
</x-layouts.app>
