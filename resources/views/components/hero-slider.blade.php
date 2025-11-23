@props(['films'])

<div 
    x-data="{
        currentSlide: 0,
        slides: {{ $films->count() }},
        autoplay: null,
        init() {
            this.startAutoplay();
        },
        startAutoplay() {
            this.autoplay = setInterval(() => {
                this.next();
            }, 5000);
        },
        stopAutoplay() {
            clearInterval(this.autoplay);
        },
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides;
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()"
    class="relative h-96 rounded-xl overflow-hidden shadow-2xl w-full"
>
    @foreach($films as $index => $film)
        <div 
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="absolute inset-0"
        >
            <img 
                src="{{ $film->poster_url ?? asset('images/pattern-3.png') }}" 
                alt="{{ $film->title }}"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent flex items-end">
                <div class="p-8 max-w-2xl">
                    <span class="inline-block px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full mb-2">
                        OFFICIAL TRAILER
                    </span>
                    <h2 class="text-4xl font-bold text-white mb-2">{{ $film->title }}</h2>
                    <p class="text-gray-300 text-sm mb-4 line-clamp-2">{{ $film->synopsis }}</p>
                    <button 
                        @click="$dispatch('open-trailer', { url: '{{ $film->trailer_url ?? '#' }}' })"
                        class="inline-flex items-center px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                        Watch Trailer
                    </button>
                </div>
            </div>
        </div>
    @endforeach
    
    <button 
        @click="prev()"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition"
    >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button 
        @click="next()"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition"
    >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
        @foreach($films as $index => $film)
            <button 
                @click="currentSlide = {{ $index }}"
                class="h-2 rounded-full transition-all"
                :class="currentSlide === {{ $index }} ? 'w-8 bg-red-600' : 'w-2 bg-white/50'"
            ></button>
        @endforeach
    </div>
</div>
