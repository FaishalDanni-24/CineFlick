{{--
    SIDEBAR COMPONENT
    
    Fitur:
    - Collapsible (desktop) dengan smooth transition
    - Hamburger menu (mobile)
    - Logo CineFlick di header
    - User info (jika authenticated)
    - Navigation menu: Home, Movies, Food & Drink, History
    - Login/Register buttons (guest)
    - Settings & Logout (authenticated)
    
    Responsive:
    - Desktop (lg): Fixed left, width 256px
    - Mobile: Overlay dengan backdrop
--}}

<aside 
    id="sidebar" 
    class="fixed top-0 left-0 z-40 h-screen w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out bg-gray-800 border-r border-gray-700"
>
    {{-- Mobile Backdrop --}}
    <div class="lg:hidden fixed inset-0 bg-black bg-opacity-50 -z-10" id="sidebar-backdrop"></div>

    <div class="flex flex-col h-full">
        {{-- Header: Logo + Close Button --}}
        <div class="flex items-center justify-between px-6 pt-6 pb-3">
            <img src="{{ asset('images/Logo_CineFlick.png') }}" alt="CineFlick" class="h-8">
            
            {{-- Close button (mobile only) --}}
            <button id="sidebar-close" class="lg:hidden text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- User Info / Greeting Section --}}
        <div class="px-6 pb-4">
            @auth
                {{-- Authenticated User --}}
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-semibold">Hello, {{ Auth::user()->name }}!</p>
                        <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            @else
                {{-- Guest User --}}
                <div class="text-left">
                    <p class="text-gray-300 font-semibold">Welcome to CineFlick!</p>
                </div>
            @endauth
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 overflow-y-auto p-4 border-t border-gray-700">
            <ul class="space-y-2">
                {{-- Home --}}
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-semibold">Home</span>
                    </a>
                </li>

                {{-- Movies --}}
                <li>
                    <a href="{{ route('movies.index') }}" class="{{ request()->routeIs('movies.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                        </svg>
                        <span class="font-semibold">Movies</span>
                    </a>
                </li>

                {{-- Food & Drink --}}
                <li>
                    <a href="{{ route('fooddrink.index') }}" class="{{ request()->routeIs('fooddrink.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-semibold">Food & Drink</span>
                    </a>
                </li>

                {{-- History (hanya untuk authenticated) --}}
                @auth
                <li>
                    <a href="{{ route('history.index') }}" class="{{ request()->routeIs('history.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">History</span>
                    </a>
                </li>
                @endauth
            </ul>
        </nav>

        {{-- Bottom Actions - TOMBOL LOGIN/REGISTER --}}
        @guest
            {{-- Guest User: Login & Register Buttons --}}
            <div class="p-4 border-t border-gray-700">
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-center font-semibold transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block w-full px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-center font-semibold transition">
                        Register
                    </a>
                </div>
            </div>
        @else
            {{-- Authenticated User: Settings & Logout --}}
            <div class="p-4 border-t border-gray-700 space-y-2">
                {{-- Settings --}}
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="font-semibold">Settings</span>
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-red-600 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-semibold">Log Out</span>
                    </button>
                </form>
            </div>
        @endguest
    </div>
</aside>