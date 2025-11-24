{{-- 
    HOMEPAGE CINEFLICK
    
    Fitur:
    - Sidebar collapsible (desktop) / hamburger menu (mobile)
    - Navbar dengan user dropdown (auth/guest)
    - Hero slider auto + manual
    - Genre filter AJAX (smooth tanpa reload)
    - Movie grid 4 kolom responsive
    - Pattern background geometric
    
    Data dari HomeController:
    - $featuredFilms: Collection (2 films untuk hero)
    - $genres: Collection (semua genre unik)
    - $films: Collection (films, bisa filtered by genre)
    - $selectedGenre: string|null (genre yang dipilih)
    
    PENTING:
    - Set $showNavigation = false agar tidak pakai navigation.blade.php
    - Homepage pakai sidebar dan navbar custom sendiri
--}}


@extends('layouts.app')

{{-- Konfigurasi halaman --}}
@php
    $showNavigation = false;  // Tidak pakai navigation.blade.php
    // $showPattern tidak perlu di-set karena default TRUE di app.blade.php
@endphp

@section('content')
{{-- Container utama - background pattern sudah ada dari layout --}}
<div class="min-h-screen">
    <div class="flex">
        {{-- Sidebar - Collapsible --}}
        @include('components.sidebar')

        {{-- Main Content Area --}}
        <div id="main-content" class="flex-1 transition-all duration-300 lg:ml-64">
            {{-- Navbar --}}
            @include('components.navbar')

            {{-- Hero Slider Section --}}
            <section class="px-4 py-6 lg:px-8">
                @include('components.hero-slider', ['featuredFilms' => $featuredFilms])
            </section>

            {{-- Genre Filter Section --}}
            <section class="px-4 py-4 lg:px-8">
                <div class="flex items-center gap-3 overflow-x-auto scrollbar-hide pb-2">
                    {{-- Button All (untuk reset filter) --}}
                    <button 
                        data-genre="all" 
                        class="genre-filter-btn px-6 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-all duration-300
                               {{ $selectedGenre ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-red-600 text-white' }}"
                    >
                        All
                    </button>

                    {{-- Loop Genre dari Database --}}
                    @foreach($genres as $genre)
                        <button 
                            data-genre="{{ $genre }}" 
                            class="genre-filter-btn px-6 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-all duration-300
                                   {{ $selectedGenre === $genre ? 'bg-red-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}"
                        >
                            {{ $genre }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Movies Grid Section --}}
            <section class="px-4 py-6 lg:px-8">
                <div id="movies-container">
                    @if($films->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
                            @foreach($films as $film)
                                @include('components.movie-card', ['film' => $film])
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <p class="text-gray-400 text-lg">There are no movies for this genre.</p>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>

{{-- JavaScript untuk Interactivity --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ===== SIDEBAR TOGGLE (Collapsible) =====
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('lg:translate-x-0');
        });
    }
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
        });
    }

    // Auto-close sidebar on mobile when clicking outside
    document.addEventListener('click', function(e) {
        const isClickInside = sidebar?.contains(e.target) || sidebarToggle?.contains(e.target);
        if (!isClickInside && window.innerWidth < 1024) {
            sidebar?.classList.add('-translate-x-full');
        }
    });

    
    // ===== GENRE FILTER (AJAX) =====
    const genreButtons = document.querySelectorAll('.genre-filter-btn');
    const moviesContainer = document.getElementById('movies-container');
    
    genreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const genre = this.getAttribute('data-genre');
            
            // Update active state semua buttons
            genreButtons.forEach(btn => {
                btn.classList.remove('bg-red-600', 'text-white');
                btn.classList.add('bg-gray-700', 'text-gray-300');
            });
            this.classList.remove('bg-gray-700', 'text-gray-300');
            this.classList.add('bg-red-600', 'text-white');
            
            // AJAX request untuk filter genre
            const url = genre === 'all' 
                ? '{{ route('home') }}' 
                : '{{ route('home') }}?genre=' + encodeURIComponent(genre);
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                moviesContainer.innerHTML = html;
                
                // Smooth scroll animation
                moviesContainer.style.opacity = '0';
                setTimeout(() => {
                    moviesContainer.style.transition = 'opacity 0.3s';
                    moviesContainer.style.opacity = '1';
                }, 50);
            })
            .catch(error => {
                console.error('Error fetching movies:', error);
                moviesContainer.innerHTML = '<div class="text-center py-16"><p class="text-red-500">Terjadi kesalahan. Silakan coba lagi.</p></div>';
            });
        });
    });

    
    // ===== USER DROPDOWN NAVBAR =====
    const userDropdownBtn = document.getElementById('user-dropdown-btn');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');
    
    if (userDropdownBtn && userDropdownMenu) {
        userDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdownBtn.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }
});
</script>
@endpush
@endsection