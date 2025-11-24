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

<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/Logo_CineFlick.png') }}" alt="CineFlick" class="h-8">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- User sudah login - tampilkan dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                {{-- Null safety: pakai ?-> operator --}}
                                <div>{{ Auth::user()?->name ?? 'User' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Profile Link --}}
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Logout Form --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- User belum login (guest) - tampilkan login/register buttons --}}
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition">
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
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
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
