{{--
HERO SLIDER COMPONENT - MOVIES PAGE

Data props:
- $heroFilms: Collection (3 random films)

Fitur:
- Auto-slide setiap 5 detik
- Manual navigation (prev/next arrows)
- Indicator dots
- Responsive height
--}}

@if($heroFilms->count() > 0)
<div class="relative mb-8 overflow-hidden rounded-2xl" x-data="{ currentSlide: 0, totalSlides: {{ $heroFilms->count() }} }" x-init="
    setInterval(() => { 
        currentSlide = (currentSlide + 1) % totalSlides 
    }, 5000)
">
    {{-- Slides Container --}}
    <div class="relative h-[400px] md:h-[500px] lg:h-[600px]">
        @foreach($heroFilms as $index => $film)
        <div 
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full"
            class="absolute inset-0"
            style="display: none;"
        >
            {{-- Background Image with Overlay --}}
            <div class="absolute inset-0">
                <img 
                    src="{{ $film->poster_url ?? 'https://placehold.co/1920x1080?text=No+Image' }}" 
                    alt="{{ $film->title }}"
                    class="w-full h-full object-cover"
                >
                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
            </div>

            {{-- Content --}}
            <div class="relative h-full flex items-center">
                <div class="container mx-auto px-4 md:px-8 max-w-7xl">
                    <div class="max-w-2xl space-y-4">
                        {{-- Genre Badge --}}
                        <span class="inline-block px-4 py-1.5 bg-red-600 text-white text-sm font-semibold rounded-full">
                            {{ $film->genre }}
                        </span>

                        {{-- Title --}}
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                            {{ $film->title }}
                        </h1>

                        {{-- Meta Info --}}
                        <div class="flex items-center gap-4 text-gray-300">
                            {{-- Rating --}}
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="font-semibold">{{ $film->rating }}</span>
                            </div>

                            <span>•</span>

                            {{-- Duration --}}
                            <span>{{ $film->duration_mins }} mins</span>

                            <span>•</span>

                            {{-- Year --}}
                            <span>{{ $film->released_year }}</span>
                        </div>

                        {{-- Synopsis --}}
                        <p class="text-gray-300 text-base md:text-lg leading-relaxed line-clamp-3">
                            {{ $film->sinopsis ?? 'The movie description is not available.' }}
                        </p>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-4 pt-4">
                            <a 
                                href="{{ route('movies.show', $film) }}"
                                class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg shadow-red-600/50 hover:shadow-red-600/70 transform hover:scale-105"
                            >
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Navigation Arrows --}}
    <button 
        @click="currentSlide = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1"
        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition-all duration-200 backdrop-blur-sm z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <button 
        @click="currentSlide = (currentSlide + 1) % totalSlides"
        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition-all duration-200 backdrop-blur-sm z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Indicator Dots --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        @foreach($heroFilms as $index => $film)
        <button 
            @click="currentSlide = {{ $index }}"
            class="w-2 h-2 rounded-full transition-all duration-300"
            :class="currentSlide === {{ $index }} ? 'bg-red-600 w-8' : 'bg-white/50 hover:bg-white/70'"
        ></button>
        @endforeach
    </div>
</div>
@endif
