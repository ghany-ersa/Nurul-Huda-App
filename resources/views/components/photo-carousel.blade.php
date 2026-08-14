@props([
    'photos',
    'altFallback' => 'Dokumentasi',
    'aspect' => 'aspect-[4/3] sm:aspect-[16/9]',
    'rounded' => 'rounded-2xl',
])

@if ($photos->isNotEmpty())
    <div x-data="{
            slides: {{ $photos->count() }},
            current: 0,
            autoplay: null,
            next() { this.current = (this.current + 1) % this.slides },
            prev() { this.current = (this.current - 1 + this.slides) % this.slides },
            startAutoplay() { this.autoplay = setInterval(() => this.next(), 5000) },
            stopAutoplay() { clearInterval(this.autoplay) }
         }"
         x-init="startAutoplay()"
         @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
         {{ $attributes->class(['relative']) }}>

        <div class="relative w-full {{ $aspect }} {{ $rounded }} bg-slate-100 overflow-hidden">
            @foreach ($photos as $index => $photo)
                <div x-show="current === {{ $index }}"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="absolute inset-0">
                    <img src="{{ $photo->photo }}" alt="{{ $photo->caption ?? $altFallback }}"
                         loading="lazy" class="w-full h-full object-cover" />
                    @if ($photo->caption)
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4 sm:p-6">
                            <p class="text-white text-sm sm:text-base font-medium">{{ $photo->caption }}</p>
                        </div>
                    @endif
                </div>
            @endforeach

            @if ($photos->count() > 1)
                {{-- Arrows --}}
                <button @click="prev()"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 hover:bg-white flex items-center justify-center text-[#2c368B] shadow-md transition"
                        aria-label="Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 hover:bg-white flex items-center justify-center text-[#2c368B] shadow-md transition"
                        aria-label="Selanjutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        </div>

        @if ($photos->count() > 1)
            {{-- Dots --}}
            <div class="mt-4 flex justify-center gap-2">
                @foreach ($photos as $index => $photo)
                    <button @click="current = {{ $index }}"
                            :class="current === {{ $index }} ? 'bg-[#1e79cc] w-6' : 'bg-slate-300 w-2'"
                            class="h-2 rounded-full transition-all"
                            aria-label="Ke foto {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
    </div>
@endif
