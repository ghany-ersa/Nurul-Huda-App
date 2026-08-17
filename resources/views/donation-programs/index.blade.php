@php
    $goldPricePerGram = 1_500_000;
    $nisabGrams = 85;
    $nisabAmount = $goldPricePerGram * $nisabGrams;
    $zakatRate = 0.025;
    $lazismuWaNumber = '628XXXXXXXXXX';
@endphp

<x-layouts.app
    title="Donasi"
    description="Salurkan donasi Anda untuk program-program Masjid Nurul Huda Ambulu secara transparan. Lihat progres, riwayat transaksi, dan hitung zakat Anda."
    keywords="donasi masjid nurul huda ambulu, program donasi masjid, zakat, infaq, wakaf masjid ambulu">

    <section class="px-5 py-14 max-w-5xl mx-auto">
        <div class="text-center">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Donasi</span>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Program Donasi</h1>
            <p class="mt-4 text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Setiap donasi yang masuk dapat dilihat riwayat dan peruntukannya secara transparan.
            </p>
        </div>

        @if ($donationPrograms->isEmpty())
            <p class="mt-12 text-center text-slate-500">Belum ada program donasi.</p>
        @else
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($donationPrograms as $program)
                    @php
                        $percent = $program->target_amount > 0
                            ? min(100, round($program->collected_amount / $program->target_amount * 100, 1))
                            : 0;

                        $statusLabel = match ($program->status) {
                            'upcoming' => 'Akan Datang',
                            'active' => 'Aktif',
                            'completed' => 'Selesai',
                            'expired' => 'Berakhir',
                            default => $program->status,
                        };

                        $statusClass = match ($program->status) {
                            'upcoming' => 'bg-slate-100 text-slate-600',
                            'active' => 'bg-emerald-100 text-emerald-700',
                            'completed' => 'bg-sky-100 text-sky-700',
                            'expired' => 'bg-red-100 text-red-700',
                            default => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <a href="{{ route('donation-programs.show', $program) }}"
                       class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-slate-100 flex flex-col">
                        @if ($program->cover_photo)
                            <div class="aspect-[16/9] bg-slate-100 overflow-hidden">
                                <img src="{{ $program->cover_photo_url }}" alt="{{ $program->name }}" loading="lazy"
                                     class="w-full h-full object-cover object-center hover:scale-105 transition duration-500" />
                            </div>
                        @endif
                        <div class="p-5 flex-1 flex flex-col">
                            <span class="inline-block self-start text-xs font-semibold px-2.5 py-1 rounded-full {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                            <h3 class="mt-2 font-semibold text-slate-900">{{ $program->name }}</h3>

                            <div class="mt-3 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-[#2c368B] to-[#1e79cc] rounded-full"
                                     style="width: {{ $percent }}%"></div>
                            </div>
                            <div class="mt-2 flex justify-between text-xs text-slate-500">
                                <span>Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                                <span>{{ $percent }}% dari Rp {{ number_format($program->target_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- KALKULATOR ZAKAT --}}
    <section class="py-14 bg-slate-50/60">
        <div class="px-5 max-w-2xl mx-auto">
            <div class="text-center">
                <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Zakat & Infaq</span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Kalkulator Zakat</h2>
                <p class="mt-2 text-slate-600 text-sm">
                    Nisab dihitung setara {{ $nisabGrams }} gram emas (estimasi Rp {{ number_format($goldPricePerGram, 0, ',', '.') }}/gram).
                </p>
            </div>

            <div x-data="{
                    tab: 'maal',
                    hartaMaal: '',
                    penghasilanBulanan: '',
                    nisabAmount: {{ $nisabAmount }},
                    zakatRate: {{ $zakatRate }},
                    parseRupiah(value) {
                        return Number(String(value).replace(/\D/g, '')) || 0;
                    },
                    get zakatMaal() {
                        const harta = this.parseRupiah(this.hartaMaal);
                        return harta >= this.nisabAmount ? Math.round(harta * this.zakatRate) : 0;
                    },
                    get zakatPenghasilan() {
                        const penghasilan = this.parseRupiah(this.penghasilanBulanan);
                        const penghasilanTahunan = penghasilan * 12;
                        return penghasilanTahunan >= this.nisabAmount ? Math.round(penghasilan * this.zakatRate) : 0;
                    },
                    formatRupiah(value) {
                        return 'Rp ' + Math.round(value).toLocaleString('id-ID');
                    },
                    formatInput(field) {
                        const digits = this.parseRupiah(this[field]);
                        this[field] = digits === 0 ? '' : digits.toLocaleString('id-ID');
                    }
                 }"
                 class="mt-8 bg-white border border-slate-100 rounded-2xl shadow-md overflow-hidden">

                <div class="flex border-b border-slate-100">
                    <button @click="tab = 'maal'"
                            :class="tab === 'maal' ? 'text-[#1e79cc] border-[#1e79cc]' : 'text-slate-500 border-transparent'"
                            class="flex-1 py-3 text-sm font-semibold border-b-2 transition">
                        Zakat Maal
                    </button>
                    <button @click="tab = 'penghasilan'"
                            :class="tab === 'penghasilan' ? 'text-[#1e79cc] border-[#1e79cc]' : 'text-slate-500 border-transparent'"
                            class="flex-1 py-3 text-sm font-semibold border-b-2 transition">
                        Zakat Penghasilan
                    </button>
                </div>

                <div class="p-5 sm:p-6" x-show="tab === 'maal'">
                    <label class="text-xs text-slate-500 uppercase tracking-wide">Total Harta (tersimpan &ge; 1 tahun)</label>
                    <div class="mt-1 flex items-stretch border border-slate-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#1e79cc]/40">
                        <span class="inline-flex items-center px-4 bg-slate-50 text-slate-500 font-medium border-r border-slate-200">Rp</span>
                        <input type="text" inputmode="numeric" x-model="hartaMaal" @input="formatInput('hartaMaal')" placeholder="0"
                               class="w-full px-4 py-3 text-slate-900 focus:outline-none" />
                    </div>

                    <div class="mt-4 p-4 rounded-xl bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Zakat yang wajib dibayar (2.5%)</p>
                        <p class="mt-1 text-2xl font-bold text-[#2c368B]" x-text="formatRupiah(zakatMaal)"></p>
                        <p class="mt-1 text-xs text-slate-500" x-show="hartaMaal && zakatMaal === 0">
                            Harta belum mencapai nisab, belum wajib zakat.
                        </p>
                    </div>
                </div>

                <div class="p-5 sm:p-6" x-show="tab === 'penghasilan'" x-cloak>
                    <label class="text-xs text-slate-500 uppercase tracking-wide">Penghasilan per Bulan</label>
                    <div class="mt-1 flex items-stretch border border-slate-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#1e79cc]/40">
                        <span class="inline-flex items-center px-4 bg-slate-50 text-slate-500 font-medium border-r border-slate-200">Rp</span>
                        <input type="text" inputmode="numeric" x-model="penghasilanBulanan" @input="formatInput('penghasilanBulanan')" placeholder="0"
                               class="w-full px-4 py-3 text-slate-900 focus:outline-none" />
                    </div>

                    <div class="mt-4 p-4 rounded-xl bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Zakat yang wajib dibayar per bulan (2.5%)</p>
                        <p class="mt-1 text-2xl font-bold text-[#2c368B]" x-text="formatRupiah(zakatPenghasilan)"></p>
                        <p class="mt-1 text-xs text-slate-500" x-show="penghasilanBulanan && zakatPenghasilan === 0">
                            Penghasilan setahun belum mencapai nisab, belum wajib zakat.
                        </p>
                    </div>
                </div>

                <div class="p-5 sm:p-6 pt-0">
                    <a href="https://wa.me/{{ $lazismuWaNumber }}?text={{ rawurlencode('Assalamualaikum, saya ingin bertanya seputar zakat.') }}"
                       target="_blank" rel="noopener"
                       class="w-full inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 active:scale-[.98] text-white font-semibold py-4 rounded-xl shadow-lg shadow-green-500/30 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.978-1.607zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.173.198-.297.297-.495.099-.198.05-.372-.025-.521-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                        </svg>
                        Hubungi Lazismu
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
