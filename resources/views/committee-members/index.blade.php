<x-layouts.app
    title="Pengurus Masjid"
    description="Kenali para pengurus dan takmir Masjid Nurul Huda Ambulu yang mengelola kegiatan dan dana umat secara amanah."
    keywords="pengurus masjid nurul huda ambulu, takmir masjid, struktur organisasi masjid">

    <section class="px-5 py-14 max-w-5xl mx-auto">
        <div class="text-center">
            <span class="text-[#1e79cc] font-semibold text-sm uppercase tracking-widest">Pengurus</span>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#2c368B]">Pengurus Masjid Nurul Huda</h1>
            <p class="mt-4 text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Para takmir yang mengelola kegiatan ibadah, dakwah, dan pengelolaan dana masjid secara amanah.
            </p>
        </div>

        @if ($committeeMembers->isEmpty())
            <p class="mt-12 text-center text-slate-500">Data pengurus belum tersedia.</p>
        @else
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($committeeMembers as $member)
                    <article class="text-center">
                        <div class="aspect-square rounded-2xl bg-slate-100 overflow-hidden shadow-sm">
                            @if ($member->photo)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy"
                                     class="w-full h-full object-cover object-center" />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-3 font-semibold text-slate-900 text-sm sm:text-base">{{ $member->name }}</h3>
                        <p class="text-[#1e79cc] text-xs sm:text-sm font-medium">{{ $member->position }}</p>
                        @if ($member->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}"
                               target="_blank" rel="noopener"
                               class="mt-1 inline-block text-xs text-slate-500 hover:text-[#1e79cc] transition">
                                {{ $member->phone }}
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.app>
