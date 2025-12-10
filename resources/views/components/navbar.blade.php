{{--
NAVBAR COMPONENT

Fitur:
- Search bar dengan AJAX search functionality
- Dropdown hasil pencarian (movies by title & genre)
- Notifications icon
- User dropdown dengan Alpine.js
- Hamburger menu button (untuk toggle sidebar di mobile)

Note: Scroll dengan page (tidak fixed)
--}}

<nav class="bg-gray-800/95 backdrop-blur-sm border-b border-gray-700/50 sticky top-0 z-40">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            
            {{-- Left: Hamburger Menu (Mobile) + Search --}}
            <div class="flex items-center gap-4 flex-1">
                {{-- Hamburger Button (Mobile only) - menggunakan @click dari Alpine --}}
                <button 
                    @click="window.dispatchEvent(new CustomEvent('toggle-sidebar'))"
                    class="lg:hidden p-2 rounded-lg hover:bg-white/5 transition-colors">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- Search Bar with Dropdown --}}
                <div class="flex-1 max-w-2xl" x-data="searchHandler()" @click.away="open = false">
                    <div class="relative">
                        {{-- Search Input --}}
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input 
                            type="text"
                            x-model="searchQuery"
                            @input="handleSearch()"
                            @focus="open = true"
                            @keydown.escape="open = false"
                            @keydown.enter="handleEnter()"
                            placeholder="Search Movie, Genre..."
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-700/50 text-white placeholder-gray-400 
                                   border border-gray-600 rounded-lg 
                                   focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent
                                   transition-all">
                        
                        {{-- Loading Spinner --}}
                        <div x-show="loading" class="absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Search Results Dropdown --}}
                    <div 
                        x-show="open && (results.length > 0 || (searchQuery && !loading))"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                        class="absolute top-full left-0 right-0 mt-2 bg-gray-800 rounded-lg shadow-2xl border border-gray-700 max-h-96 overflow-y-auto z-50"
                        style="display: none;">
                        
                        {{-- Results found --}}
                        <template x-if="results.length > 0">
                            <div>
                                <div class="px-4 py-2 text-xs text-gray-400 border-b border-gray-700 sticky top-0 bg-gray-800">
                                    Found <span x-text="results.length"></span> result(s)
                                </div>
                                <template x-for="(result, index) in results" :key="index">
                                    <a 
                                        :href="result.url"
                                        class="flex items-center gap-3 px-4 py-3 hover:bg-gray-700 transition-colors border-b border-gray-700/50 last:border-b-0">
                                        {{-- Poster Thumbnail --}}
                                        <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0 bg-gray-700">
                                            <img 
                                                :src="result.poster_url" 
                                                :alt="result.title"
                                                class="w-full h-full object-cover">
                                        </div>
                                        
                                        {{-- Movie Info --}}
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-semibold text-white truncate" x-text="result.title"></h4>
                                            <p class="text-xs text-gray-400 truncate" x-text="result.genre"></p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    <span class="text-xs text-gray-300" x-text="result.rating"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Arrow Icon --}}
                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </template>
                            </div>
                        </template>
                        
                        {{-- No results message --}}
                        <template x-if="searchQuery && results.length === 0 && !loading">
                            <div class="px-4 py-8 text-center">
                                <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <p class="text-sm text-gray-400">No movies found</p>
                                <p class="text-xs text-gray-500 mt-1">Try searching with different keywords</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Right: Notifications + User Dropdown --}}
            <div class="flex items-center gap-4">
                {{-- Notifications Icon --}}
                <button class="relative p-2 rounded-lg hover:bg-white/5 transition-colors">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    {{-- Badge notifikasi (optional) --}}
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- User Dropdown (FIXED with Alpine.js) --}}
                <div class="relative" x-data="{ userDropdownOpen: false }" @click.away="userDropdownOpen = false">
                    @auth
                        {{-- Authenticated: Show User Avatar --}}
                        <button @click="userDropdownOpen = !userDropdownOpen" 
                                type="button"
                                class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/5 transition-colors">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" 
                                 :class="{ 'rotate-180': userDropdownOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown Menu (Authenticated) --}}
                        <div x-show="userDropdownOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-gray-800 rounded-lg shadow-xl border border-gray-700 py-2 z-50"
                             style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-gray-700">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Guest: Show Generic User Icon --}}
                        <button @click="userDropdownOpen = !userDropdownOpen"
                                type="button" 
                                class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/5 transition-colors">
                            <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform"
                                 :class="{ 'rotate-180': userDropdownOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown Menu (Guest) --}}
                        <div x-show="userDropdownOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-xl border border-gray-700 py-2 z-50"
                             style="display: none;">
                            
                            <a href="{{ route('login') }}" 
                               class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                               class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Alpine.js Search Handler --}}
<script defer>
    function searchHandler() {
        return {
            searchQuery: '',
            results: [],
            open: false,
            loading: false,
            debounceTimer: null,
            
            handleSearch() {
                // Clear previous timer
                clearTimeout(this.debounceTimer);
                
                // Reset results jika query kosong
                if (this.searchQuery.trim().length === 0) {
                    this.results = [];
                    this.loading = false;
                    return;
                }
                
                // Set loading state
                this.loading = true;
                
                // Debounce search (300ms)
                this.debounceTimer = setTimeout(() => {
                    fetch(`/api/search?q=${encodeURIComponent(this.searchQuery)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.results = data.results;
                            } else {
                                this.results = [];
                            }
                            this.loading = false;
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            this.results = [];
                            this.loading = false;
                        });
                }, 300);
            },
            
            handleEnter() {
                if (this.results.length > 0) {
                    // Redirect ke first result
                    window.location.href = this.results[0].url;
                }
            }
        };
    }
</script>
