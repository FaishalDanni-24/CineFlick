<aside class="w-64 bg-gray-900 border-r border-gray-700 flex flex-col">
    <div class="p-6 border-b border-gray-700">
        <img src="{{ asset('images/Logo_CineFlick_Small.png') }}" alt="CineFlick Logo" class="h-11 w-auto mx-auto mb-4">
        @auth
            <p class="text-gray-300 text-sm mb-2">Hello, {{ Auth::user()->name }}!</p>
            <div class="flex items-center text-gray-400 text-sm">
                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                Cilegon
            </div>
        @else
            <p class="text-gray-300 text-sm mb-2">Hello, Guest!</p>
        @endauth
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            <span class="font-medium">Home</span>
        </a>
        
        <a href="{{ route('movies.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('movies.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Movie</span>
        </a>
        
        <a href="{{ route('fooddrink.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('fooddrink.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
            </svg>
            <span class="font-medium">Food & Drink</span>
        </a>
        
        @auth
            <a href="{{ route('booking.history') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('booking.history') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">History</span>
            </a>
        @endauth
    </nav>
    
    <div class="p-4 border-t border-gray-700 space-y-2">
        @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Setting</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 w-full">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">Log Out</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Login</span>
            </a>
        @endauth
    </div>
</aside>
