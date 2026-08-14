@php
    $monthNames = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $categoryLabels = [
        'income' => 'Pemasukan',
        'expense' => 'Pengeluaran',
    ];
@endphp

<x-layouts.app
    title="Laporan Keuangan"
    description="Laporan keuangan kas Masjid Nurul Huda Ambulu secara transparan — pemasukan dan pengeluaran per bulan."
    keywords="laporan keuangan masjid nurul huda ambulu, transparansi kas masjid, laporan kas masjid">

    <section class="px-5 py-14 max-w-4xl mx-auto">
        <div class="text-center">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Transparansi</span>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Laporan Keuangan</h1>
            <p class="mt-4 text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Rekapitulasi pemasukan dan pengeluaran kas masjid, dilaporkan secara terbuka setiap bulan.
            </p>
        </div>

        @if ($availableYears->isEmpty())
            <p class="mt-12 text-center text-slate-500">Laporan keuangan belum tersedia.</p>
        @else
            {{-- Filter tahun --}}
            <div class="mt-8 flex justify-center gap-2 flex-wrap">
                @foreach ($availableYears as $year)
                    <a href="{{ route('financial-reports.index', ['year' => $year]) }}"
                       @class([
                           'px-4 py-2 rounded-full text-sm font-semibold transition',
                           'bg-[#1e79cc] text-white' => $year === $selectedYear,
                           'bg-white text-slate-600 border border-slate-200 hover:border-[#1e79cc]' => $year !== $selectedYear,
                       ])>
                        {{ $year }}
                    </a>
                @endforeach
            </div>

            {{-- Ringkasan tahunan --}}
            <div class="mt-8 grid grid-cols-3 gap-3 sm:gap-4">
                <div class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-5 shadow-sm text-center">
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Pemasukan</p>
                    <p class="mt-1 text-sm sm:text-lg font-bold text-emerald-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-5 shadow-sm text-center">
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Pengeluaran</p>
                    <p class="mt-1 text-sm sm:text-lg font-bold text-red-600">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-5 shadow-sm text-center">
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Saldo</p>
                    <p class="mt-1 text-sm sm:text-lg font-bold text-[#2c368B]">Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Detail per bulan --}}
            <div class="mt-10 space-y-4" x-data="{ openMonth: null }">
                @foreach ($monthlySummary as $month => $summary)
                    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                        <button @click="openMonth = openMonth === {{ $month }} ? null : {{ $month }}"
                                class="w-full flex items-center justify-between p-5 text-left">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $monthNames[$month] }} {{ $selectedYear }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Saldo bulan ini:
                                    <span class="font-semibold {{ $summary['balance'] >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                        Rp {{ number_format($summary['balance'], 0, ',', '.') }}
                                    </span>
                                </p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 transition-transform shrink-0"
                                 :class="openMonth === {{ $month }} ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openMonth === {{ $month }}"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-cloak class="border-t border-slate-100 px-5 py-4">
                            <div class="grid sm:grid-cols-2 gap-6">
                                @foreach (['income', 'expense'] as $type)
                                    @php $categoryReports = $summary['categories']->where('type', $type); @endphp
                                    @if ($categoryReports->isNotEmpty())
                                        <div>
                                            <p class="text-xs font-semibold uppercase tracking-wide {{ $type === 'income' ? 'text-emerald-600' : 'text-red-600' }}">
                                                {{ $categoryLabels[$type] }}
                                            </p>
                                            <ul class="mt-2 space-y-1.5">
                                                @foreach ($categoryReports as $report)
                                                    <li class="flex justify-between text-sm">
                                                        <span class="text-slate-600">{{ $report->category }}</span>
                                                        <span class="font-medium text-slate-900">Rp {{ number_format($report->amount, 0, ',', '.') }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.app>
