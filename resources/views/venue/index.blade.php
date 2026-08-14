@php
    $waNumber = '6285335104803';
    $heroImage = $venue?->photo ?? 'https://picsum.photos/seed/aula-serbaguna-hero/1400/900';

    $fasilitas = [
        ['icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4 4 4 0 004 4z', 'label' => 'Hingga 150 Tamu'],
        ['icon' => 'M8 21h8m-4-4v4M3 5h18M5 5v10a2 2 0 002 2h10a2 2 0 002-2V5', 'label' => 'Pendingin Ruangan'],
        ['icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z', 'label' => 'Sound System'],
        ['icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2zM3 10h18', 'label' => 'Area Parkir Luas'],
        ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Wudhu Terpisah'],
        ['icon' => 'M5 13l4 4L19 7', 'label' => 'Suasana Khidmat'],
    ];
@endphp

<x-layouts.app
    title="Akad Venue"
    description="Sewa Aula Serbaguna Masjid Nurul Huda Ambulu untuk acara akad nikah Anda. Kapasitas 150 tamu, fasilitas lengkap, suasana teduh dan berkah."
    :image="$heroImage"
    keywords="sewa venue akad nikah ambulu, aula masjid nurul huda ambulu, tempat akad nikah jember">

    {{-- HERO --}}
    <section class="relative min-h-[65svh] flex items-end overflow-hidden">
        <img src="{{ $heroImage }}" alt="Aula Serbaguna Masjid Nurul Huda Ambulu"
             loading="eager" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-b via-[#2c368B]/50 to-[#1e79cc]/60"></div>

        <div class="relative w-full px-5 pt-24 pb-14 max-w-3xl mx-auto text-white">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 backdrop-blur border border-white/30 text-white text-xs font-medium mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Terbuka untuk Pemesanan
            </div>
            <h1 class="text-3xl sm:text-5xl font-bold leading-tight tracking-tight">
                Akad Nikah di <span class="text-[#7ec1ee]">Aula Serbaguna</span>
            </h1>
            <p class="mt-3 text-base sm:text-lg text-white/90 max-w-xl">
                Rayakan momen sakral Anda di tempat yang teduh, penuh berkah, dan siap menampung hingga 150 tamu undangan.
            </p>
            <a href="#ajukan"
               class="mt-6 inline-flex items-center gap-2 bg-white text-[#2c368B] font-semibold py-3 px-6 rounded-xl shadow-lg hover:bg-slate-50 active:scale-[.98] transition">
                Ajukan Sekarang
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <section class="px-5 py-14 max-w-3xl mx-auto">
        {{-- FASILITAS --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach ($fasilitas as $item)
                <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm text-center">
                    <div class="w-10 h-10 mx-auto rounded-xl bg-[#1e79cc]/10 text-[#1e79cc] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                        </svg>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-700">{{ $item['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- DESKRIPSI --}}
        <div class="mt-10">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Tentang Venue</span>
            <h2 class="mt-2 text-2xl font-bold text-[#2c368B]">Aula Serbaguna</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">
                Aula dengan kapasitas hingga 150 tamu, dilengkapi pendingin ruangan, sound system, area parkir luas,
                dan tempat wudhu terpisah untuk pria dan wanita. Cocok untuk resepsi akad nikah dalam suasana khidmat,
                dikelilingi kesejukan lingkungan masjid.
            </p>
        </div>

        {{-- GALERI DOKUMENTASI --}}
        @if ($venue && $venue->photos->isNotEmpty())
            <div class="mt-10">
                <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Dokumentasi</span>
                <h2 class="mt-2 text-2xl font-bold text-[#2c368B]">Suasana Aula Serbaguna</h2>
                <x-photo-carousel
                    :photos="$venue->photos"
                    alt-fallback="Aula Serbaguna Masjid Nurul Huda"
                    class="mt-4" />
            </div>
        @endif

        {{-- TESTIMONIAL / TRUST --}}
        <div class="mt-10 bg-gradient-to-br from-[#2c368B] to-[#1e79cc] rounded-2xl p-6 sm:p-8 text-white">
            <svg class="w-8 h-8 text-white/60 mb-3" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
            </svg>
            <p class="text-base sm:text-lg italic leading-relaxed">
                "Menikah di rumah Allah adalah awal yang penuh berkah — semoga setiap akad yang berlangsung di sini menjadi fondasi rumah tangga sakinah, mawaddah, wa rahmah."
            </p>
        </div>

        {{-- FORM PENGAJUAN --}}
        <div id="ajukan" class="mt-10 scroll-mt-6">
            <h2 class="text-lg font-bold text-[#2c368B]">Ajukan Rencana Akad</h2>
            <p class="mt-1 text-sm text-slate-500">
                Isi form berikut, Anda akan diarahkan ke WhatsApp admin untuk konfirmasi lebih lanjut.
            </p>

            <form
                x-data="{
                    name: '',
                    plannedDate: '',
                    note: '',
                    get waUrl() {
                        const tanggal = this.plannedDate
                            ? new Date(this.plannedDate).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
                            : '-';
                        let pesan = `Assalamualaikum, saya ${this.name || '-'} ingin mengajukan akad nikah di Aula Serbaguna Masjid Nurul Huda pada tanggal ${tanggal}.`;
                        if (this.note) {
                            pesan += ` Catatan: ${this.note}`;
                        }
                        return 'https://wa.me/{{ $waNumber }}?text=' + encodeURIComponent(pesan);
                    }
                }"
                @submit.prevent="window.open(waUrl, '_blank')"
                class="mt-6 bg-white border border-slate-100 rounded-2xl shadow-sm p-5 sm:p-6 space-y-4">

                <div>
                    <label class="text-xs text-slate-500 uppercase tracking-wide">Nama</label>
                    <input type="text" x-model="name" required placeholder="Nama calon pengantin"
                           class="mt-1 w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1e79cc]/40" />
                </div>

                <div>
                    <label class="text-xs text-slate-500 uppercase tracking-wide">Rencana Tanggal Akad</label>
                    <input type="date" x-model="plannedDate" required
                           class="mt-1 w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1e79cc]/40" />
                </div>

                <div>
                    <label class="text-xs text-slate-500 uppercase tracking-wide">Catatan (opsional)</label>
                    <textarea x-model="note" rows="3" placeholder="Perkiraan jumlah tamu, kebutuhan tambahan, dsb."
                              class="mt-1 w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1e79cc]/40"></textarea>
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 active:scale-[.98] text-white font-semibold py-4 rounded-xl shadow-lg shadow-green-500/30 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.978-1.607zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.173.198-.297.297-.495.099-.198.05-.372-.025-.521-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                    </svg>
                    Ajukan via WhatsApp
                </button>
            </form>
        </div>
    </section>
</x-layouts.app>
