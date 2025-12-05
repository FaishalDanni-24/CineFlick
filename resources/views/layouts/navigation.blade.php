{{--
    NAVIGATION BAR - NAVIGATION.BLADE.PHP
    
    Navigation bar default Laravel Breeze
    Digunakan untuk halaman dashboard, profile, dan halaman admin lainnya
    
    TIDAK digunakan untuk:
    - Homepage (home.blade.php) - karena pakai sidebar+navbar custom
    - Movies, Food & Drink pages - karena pakai sidebar+navbar custom
    
    Fitur:
    - Logo CineFlick
    - Navigation links (Dashboard)
    - User dropdown dengan null safety
    - Responsive hamburger menu
    - Logout functionality
    
    Keamanan:
    - Semua akses Auth::user() pakai null safety operator (?->)
    - Guard dengan @auth/@guest directives
--}}

<nav x-data="{ open: false }" class="bg-gray-800/95 backdrop-blur-sm border-b border-gray-700/50 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/Logo_CineFlick.png') }}" alt="CineFlick" class="h-9">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('home') }}" 
                       class="{{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="{{ request()->routeIs('profile.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ __('Profile') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- User sudah login - tampilkan dropdown dengan Alpine.js --}}
                    <div class="relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                type="button"
                                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700/50 transition-colors">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <span class="text-gray-300 font-medium text-sm">{{ Auth::user()?->name ?? 'User' }}</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" 
                                 :class="{ 'rotate-180': dropdownOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="dropdownOpen"
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile Settings
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
                    </div>
                @else
                    {{-- User belum login (guest) - tampilkan login/register buttons --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-300 hover:text-white font-medium text-sm transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm rounded-lg transition-all duration-200 shadow-lg shadow-red-600/20">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" 
               class="{{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-semibold">{{ __('Home') }}</span>
            </a>
            <a href="{{ route('profile.edit') }}" 
               class="{{ request()->routeIs('profile.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="font-semibold">{{ __('Profile') }}</span>
            </a>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            {{-- User sudah login --}}
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4">
                    {{-- Null safety dengan @if --}}
                    @if(Auth::user())
                        <div class="font-medium text-base text-gray-200">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="font-medium text-sm text-gray-400">
                            {{ Auth::user()->email }}
                        </div>
                    @else
                        <div class="font-medium text-base text-gray-400">
                            Guest User
                        </div>
                    @endif
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            {{-- User belum login (guest) --}}
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
