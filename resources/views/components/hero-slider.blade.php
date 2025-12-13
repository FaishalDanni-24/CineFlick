{{--
    HERO SLIDER COMPONENT
    
    Data props:
    - $featuredFilms: Collection (2 films)
    
    Fitur:
    - Auto-slide setiap 5 detik
    - Manual navigation (prev/next arrows)
    - Indicator dots
    - Watch Trailer button (jika ada trailer_url)
--}}

@if($featuredFilms->count() > 0)
<div class="relative rounded-xl overflow-hidden" id="hero-slider">
    {{-- Slides Container --}}
    <div class="relative h-64 md:h-96 lg:h-[500px]">
        @foreach($featuredFilms as $index => $film)
        <div class="slide absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
            {{-- Background Image with Overlay --}}
            <div class="absolute inset-0">
                <img 
                    src="{{ asset('storage/' . $film->poster_path) }}" 
                    alt="{{ $film->title }}"
                    class="w-full h-full object-cover"
                    onerror="this.src='{{ asset('images/bg.jpeg') }}'"
                >
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-10 h-full flex items-center px-8 lg:px-16">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-1 bg-red-600 text-white text-sm font-semibold rounded-full mb-4">
                        {{ $film->genre }}
                    </span>
                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        {{ $film->title }}
                    </h2>
                    <p class="text-gray-300 text-sm md:text-base mb-6 line-clamp-3">
                        {{ $film->sinopsis ?? 'The movie description is not available.' }}
                    </p>
                    <div class="flex items-center gap-4">
                        @if($film->trailer_url)
                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/>
                            </svg>
                            Watch Trailer
                        </button>
                        @endif
                        <a href="{{ route('movies.show', $film) }}" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition">
                            More Info
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Navigation Arrows --}}
    @if($featuredFilms->count() > 1)
    <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Indicator Dots --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        @foreach($featuredFilms as $index => $film)
        <button class="slide-indicator w-3 h-3 rounded-full transition {{ $index === 0 ? 'bg-red-600' : 'bg-gray-400' }}" data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const prevBtn = document.getElementById('prev-slide');
    const nextBtn = document.getElementById('next-slide');
    let currentSlide = 0;
    let autoSlideInterval;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('opacity-100'));
        slides.forEach(slide => slide.classList.add('opacity-0'));
        
        // Show target slide
        slides[index].classList.remove('opacity-0');
        slides[index].classList.add('opacity-100');
        
        // Update indicators
        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.remove('bg-gray-400');
                indicator.classList.add('bg-red-600');
            } else {
                indicator.classList.remove('bg-red-600');
                indicator.classList.add('bg-gray-400');
            }
        });
        
        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    // Auto-slide setiap 5 detik
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Event Listeners
    if (prevBtn) prevBtn.addEventListener('click', () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            stopAutoSlide();
            showSlide(index);
            startAutoSlide();
        });
    });

    // Start auto-slide
    if (slides.length > 1) {
        startAutoSlide();
    }

    // Pause on hover
    const slider = document.getElementById('hero-slider');
    if (slider) {
        slider.addEventListener('mouseenter', stopAutoSlide);
        slider.addEventListener('mouseleave', startAutoSlide);
    }
});
</script>
@endpush
@endif
