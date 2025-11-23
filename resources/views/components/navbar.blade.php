<nav class="w-full bg-gray-800/95 backdrop-blur-sm border-b border-gray-700/50">
    <div class="flex items-center justify-between w-full px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex-1 mr-6">
            <div class="relative max-w-2xl">
                <input 
                    type="text" 
                    placeholder="Search Movie, Genre, and Others"
                    class="w-full bg-gray-700/80 text-white rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500"
                    x-data
                    @input.debounce.300ms="console.log('Search:', $event.target.value)"
                >
                <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            @auth
                <button class="relative text-gray-300 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                </button>
                
                <div x-data="{ open: false }" class="relative">
                    <button 
                        @click="open = !open"
                        class="flex items-center space-x-2 text-gray-300 hover:text-white"
                    >
                        <div class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center">
                            <span class="text-sm font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    </button>
                    
                    <div 
                        x-show="open" 
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg py-2 z-50"
                        style="display: none;"
                    >
                        <div class="px-4 py-2 border-b border-gray-700">
                            <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>
