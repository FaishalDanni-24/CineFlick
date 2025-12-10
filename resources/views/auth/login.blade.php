<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center w-full">

        <div class="w-full max-w-md bg-black/10 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/20">
            
            <h2 class="text-center text-2xl font-bold text-white mb-6">
                Hai Ketemu Lagi Di <span class="text-red-500">CineFlick!</span>
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="text-white text-sm">Email</label>
                    <input id="email" type="email" name="email"
                           class="w-full mt-1 px-3 py-2 bg-white/10 text-white rounded-lg placeholder-gray-300 
                                  focus:ring-2 focus:ring-red-500 border border-white/20"
                           required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="text-white text-sm">Password</label>
                    <input id="password" type="password" name="password"
                           class="w-full mt-1 px-3 py-2 bg-white/10 text-white rounded-lg placeholder-gray-300 
                                  focus:ring-2 focus:ring-red-500 border border-white/20"
                           required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox"
                           class="mr-2 bg-white/20 border-white/30 text-red-500 rounded focus:ring-red-500"
                           name="remember">
                    <label for="remember_me" class="text-white text-sm">Ingat Saya</label>
                </div>

                <!-- Tombol Masuk -->
<button
    class="w-full bg-white text-red-600 border border-red-600 hover:bg-red-600 hover:text-white 
           py-2 rounded-lg transition-all font-semibold">
    Masuk
</button>

<!-- Tombol Daftar -->
<div class="mt-4">
    <a href="{{ route('register') }}"
       class="block w-full text-center bg-white text-red-600 border border-red-600 
              hover:bg-red-600 hover:text-white py-2 rounded-lg transition-all font-semibold">
        Daftar
    </a>
</div>
</x-guest-layout>
