{{--
    NAVBAR COMPONENT
    
    Fitur:
    - Search bar
    - Notifications icon
    - User dropdown dengan conditional rendering:
      * Guest: Login & Register buttons
      * Authenticated: Username, Email, Settings, Logout
    - Hamburger menu button (untuk toggle sidebar di mobile)
    
    Note: Scroll dengan page (tidak fixed)
--}}

<nav class="bg-gray-800 border-b border-gray-700 px-4 py-4 lg:px-8">
    <div class="flex items-center justify-between gap-4">
        {{-- Left: Hamburger Menu (Mobile) + Search --}}
        <div class="flex items-center gap-4 flex-1">
            {{-- Hamburger Button (Mobile only) --}}
            <button id="sidebar-toggle" class="lg:hidden text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Search Bar --}}
            <div class="flex-1 max-w-2xl">
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Search Movie, Genre, and Others" 
                        class="w-full px-4 py-2 pl-10 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent"
                    >
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Right: Notifications + User Dropdown --}}
        <div class="flex items-center gap-4">
            {{-- Notifications Icon --}}
            <button class="relative text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                {{-- Badge notifikasi (optional) --}}
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-600 rounded-full text-xs flex items-center justify-center text-white">3</span>
            </button>

            {{-- User Dropdown --}}
            <div class="relative">
                @auth
                    {{-- Authenticated: Show User Avatar --}}
                    <button id="user-dropdown-btn" class="flex items-center gap-2 text-gray-300 hover:text-white">
                        <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu (Authenticated) --}}
                    <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-64 bg-gray-800 border border-gray-700 rounded-lg shadow-xl z-50">
                        <div class="p-4 border-b border-gray-700">
                            <p class="text-white font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-gray-300 hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-gray-300 hover:bg-red-600 hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Guest: Show Generic User Icon --}}
                    <button id="user-dropdown-btn" class="flex items-center gap-2 text-gray-300 hover:text-white">
                        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu (Guest) --}}
                    <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-xl z-50">
                        <div class="py-2 space-y-1">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">
                                Register
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
