@extends('layouts.app')

@php
    $showNavigation = false;
    $showPattern = true;
@endphp

@section('content')
{{-- Sidebar --}}
@include('components.sidebar')

{{-- Main Content Area --}}
<div class="lg:ml-64 transition-all duration-300">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Content Container --}}
    <div class="p-4 lg:p-6">
        
        {{-- Genre + Rating Filter --}}
        <div class="mb-6">
            @include('components.genre-rating-filter', [
                'genres' => $genres,
                'selectedGenre' => $selectedGenre,
                'selectedRating' => $selectedRating
            ])
        </div>

        {{-- Hero Slider --}}
        @if($heroFilms->count() > 0)
            <div class="mb-8">
                @include('components.hero-slider-movies', ['heroFilms' => $heroFilms])
            </div>
        @endif

        {{-- Movies Grid Container --}}
        <div id="movies-container">
            @include('components.movies-grid-infinite', ['films' => $films])
        </div>

        {{-- Loading Skeleton (Hidden by default) --}}
        <div id="loading-skeleton" class="hidden">
            @include('components.loading-skeleton')
        </div>

        {{-- Empty State (jika tidak ada film) --}}
        @if($films->count() === 0)
            @include('components.empty-state-movies')
        @endif

    </div>
</div>

{{-- Back to Top Button --}}
@include('components.back-to-top')

{{-- All JavaScript --}}
@push('scripts')
<script>
(function() {
    'use strict';
    
    // Wait for DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // ===== FILTER FUNCTION (GLOBAL) =====
        window.applyFilters = function(genre, rating) {
            const url = new URL(window.location.href);
            url.searchParams.set('genre', genre || 'all');
            url.searchParams.set('rating', rating || 'all');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        };
        
        // ===== SIDEBAR TOGGLE =====
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        if (closeSidebarBtn && sidebar) {
            closeSidebarBtn.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
            });
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (sidebar && !sidebar.contains(e.target) && sidebarToggle && !sidebarToggle.contains(e.target)) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // ===== USER DROPDOWN =====
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenuDropdown = document.getElementById('user-menu-dropdown');

        if (userMenuButton && userMenuDropdown) {
            userMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenuDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                    userMenuDropdown.classList.add('hidden');
                }
            });
        }

                // ===== SIDEBAR CLOSE BUTTON (UNIVERSAL FIX) =====
        // Find close button by any possible selector
        const possibleCloseSelectors = [
            '#close-sidebar',
            '[data-close-sidebar]',
            '.sidebar-close',
            '#sidebar button[type="button"]',
            '#sidebar .close-button'
        ];

        if (sidebar) {
            possibleCloseSelectors.forEach(function(selector) {
                const closeButton = document.querySelector(selector);
                if (closeButton) {
                    closeButton.addEventListener('click', function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        sidebar.classList.add('-translate-x-full');
                        console.log('✅ Sidebar closed via:', selector);
                    });
                }
            });

            // Fallback: Click on X icon directly
            const xIcon = sidebar.querySelector('svg');
            if (xIcon && xIcon.parentElement) {
                xIcon.parentElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    sidebar.classList.add('-translate-x-full');
                    console.log('✅ Sidebar closed via SVG icon');
                });
            }
        }

        // ===== INFINITE SCROLL =====
        let currentPage = {{ $films->currentPage() }};
        const lastPage = {{ $films->lastPage() }};
        let loading = false;

        const moviesContainer = document.getElementById('movies-container');
        const loadingSkeleton = document.getElementById('loading-skeleton');

        if (currentPage < lastPage && moviesContainer) {
            const sentinel = document.createElement('div');
            sentinel.id = 'scroll-sentinel';
            sentinel.style.height = '20px';
            moviesContainer.after(sentinel);

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting && !loading && currentPage < lastPage) {
                        loadMoreFilms();
                    }
                });
            }, {
                rootMargin: '100px'
            });

            observer.observe(sentinel);

            function loadMoreFilms() {
                if (loading || currentPage >= lastPage) return;

                loading = true;
                if (loadingSkeleton) {
                    loadingSkeleton.classList.remove('hidden');
                }

                const nextPage = currentPage + 1;
                const url = new URL(window.location.href);
                url.searchParams.set('page', nextPage);

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.html) {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = data.html;
                        const gridElement = tempDiv.querySelector('.grid');
                        
                        if (gridElement && moviesContainer) {
                            const existingGrid = moviesContainer.querySelector('.grid');
                            if (existingGrid) {
                                Array.from(gridElement.children).forEach(function(child) {
                                    existingGrid.appendChild(child);
                                });
                            }
                        }

                        currentPage = data.nextPage - 1;
                        
                        if (!data.hasMore) {
                            observer.disconnect();
                            sentinel.remove();
                        }
                    }
                })
                .catch(function(error) {
                    console.error('Error loading more films:', error);
                })
                .finally(function() {
                    loading = false;
                    if (loadingSkeleton) {
                        loadingSkeleton.classList.add('hidden');
                    }
                });
            }
        }
    });
})();
</script>
@endpush
@endsection
