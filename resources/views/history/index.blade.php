{{-- HISTORY PAGE - BOOKING HISTORY
Features:
- Tab filter: All / Movies (with F&D) / Food & Drink Only
- Infinite scroll pagination (10 items per load)
- Full width horizontal cards
- Sidebar + Navbar like movies page
- Empty state with CTA button
--}}

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
        {{-- Page Header --}}
        <div class="mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">Booking History</h1>
            <p class="text-gray-400 text-sm">View all your past and upcoming bookings</p>
        </div>

        {{-- Tab Filter --}}
        <div class="mb-6 flex gap-3 border-b border-gray-700">
            <button 
                data-tab="all" 
                class="tab-btn px-6 py-3 text-sm font-semibold transition-all duration-300 border-b-2 {{ request('tab', 'all') === 'all' ? 'border-red-600 text-white' : 'border-transparent text-gray-400 hover:text-gray-300' }}"
            >
                All Bookings
            </button>
            <button 
                data-tab="movies" 
                class="tab-btn px-6 py-3 text-sm font-semibold transition-all duration-300 border-b-2 {{ request('tab') === 'movies' ? 'border-red-600 text-white' : 'border-transparent text-gray-400 hover:text-gray-300' }}"
            >
                Movies
            </button>
            <button 
                data-tab="fooddrink" 
                class="tab-btn px-6 py-3 text-sm font-semibold transition-all duration-300 border-b-2 {{ request('tab') === 'fooddrink' ? 'border-red-600 text-white' : 'border-transparent text-gray-400 hover:text-gray-300' }}"
            >
                Food & Drink
            </button>
        </div>

        {{-- Bookings Container --}}
        <div id="bookings-container">
            @if($bookings->count() > 0)
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                        @include('components.history-card', ['booking' => $booking])
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 mx-auto mb-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">No Booking History</h3>
                        <p class="text-gray-400 mb-6">You haven't made any bookings yet.</p>
                        <a 
                            href="{{ route('movies.index') }}" 
                            class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-300"
                        >
                            Start Booking Now
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Loading Skeleton (Hidden by default) --}}
        <div id="loading-skeleton" class="hidden mt-4">
            <div class="space-y-4">
                @for($i = 0; $i < 3; $i++)
                    <div class="bg-gray-800/50 rounded-lg p-6 animate-pulse">
                        <div class="flex gap-6">
                            <div class="w-32 h-48 bg-gray-700 rounded"></div>
                            <div class="flex-1 space-y-3">
                                <div class="h-6 bg-gray-700 rounded w-1/3"></div>
                                <div class="h-4 bg-gray-700 rounded w-1/2"></div>
                                <div class="h-4 bg-gray-700 rounded w-2/3"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

{{-- Back to Top Button --}}
@include('components.back-to-top')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ========================================
    // TAB FILTER FUNCTIONALITY
    // ========================================
    const tabButtons = document.querySelectorAll('.tab-btn');
    const bookingsContainer = document.getElementById('bookings-container');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tab = this.getAttribute('data-tab');
            
            // Update active state
            tabButtons.forEach(btn => {
                btn.classList.remove('border-red-600', 'text-white');
                btn.classList.add('border-transparent', 'text-gray-400');
            });
            this.classList.remove('border-transparent', 'text-gray-400');
            this.classList.add('border-red-600', 'text-white');

            // Update URL and reload
            const url = new URL(window.location.href);
            if (tab === 'all') {
                url.searchParams.delete('tab');
            } else {
                url.searchParams.set('tab', tab);
            }
            url.searchParams.delete('page'); // Reset pagination
            window.location.href = url.toString();
        });
    });

    // ========================================
    // INFINITE SCROLL
    // ========================================
    let currentPage = {{ $bookings->currentPage() }};
    const lastPage = {{ $bookings->lastPage() }};
    let loading = false;
    const loadingSkeleton = document.getElementById('loading-skeleton');

    if (currentPage < lastPage && bookingsContainer) {
        // Create sentinel element for intersection observer
        const sentinel = document.createElement('div');
        sentinel.id = 'scroll-sentinel';
        sentinel.style.height = '20px';
        bookingsContainer.after(sentinel);

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !loading && currentPage < lastPage) {
                    loadMoreBookings();
                }
            });
        }, {
            rootMargin: '100px'
        });

        observer.observe(sentinel);

        function loadMoreBookings() {
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
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.html) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    
                    const bookingsSpace = bookingsContainer.querySelector('.space-y-4');
                    if (bookingsSpace) {
                        const newCards = tempDiv.querySelectorAll('[data-booking-card]');
                        newCards.forEach(function(card) {
                            bookingsSpace.appendChild(card);
                        });
                    }

                    currentPage = data.nextPage - 1;

                    if (!data.hasMore) {
                        observer.disconnect();
                        sentinel.remove();
                    }
                }
            })
            .catch(function(error) {
                console.error('Error loading more bookings:', error);
            })
            .finally(function() {
                loading = false;
                if (loadingSkeleton) {
                    loadingSkeleton.classList.add('hidden');
                }
            });
        }
    }

    // ========================================
    // SIDEBAR TOGGLE (same as movies page)
    // ========================================
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

    // ========================================
    // USER DROPDOWN
    // ========================================
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
});
</script>
@endpush
