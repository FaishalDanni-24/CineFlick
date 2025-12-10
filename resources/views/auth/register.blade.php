<x-guest-layout>

    <!-- 🔥 Overlay background gelap -->
    <style>
        .cine-bg {
            position: fixed;
            inset: 0;
            background: url('/images/bg-cineflick.jpg') center/cover no-repeat fixed;
            z-index: -2;
        }

        .cine-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.13); /* ubah kalo mau lebih gelap */
            z-index: -1;
        }
    </style>

    <div class="cine-bg"></div>
    <div class="cine-overlay"></div>

    
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex min-h-screen items-center justify-center w-full px-4">
            <!-- 🔥 FORM TRANSPARAN (tidak hitam) -->
            <div class="w-full max-w-md bg-black/10 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/20">

                <!-- Judul -->
                <h2 class="text-center text-2xl font-bold text-white mb-6">
                    Buat Akun <span class="text-red-500">CineFlick</span> Dulu Yuk!
                </h2>

                <!-- Name -->
                <div>
                    <label class="text-white text-sm">Nama</label>
                    <input id="name" type="text" name="name"
                        class="mt-1 w-full bg-gray-700/60 text-white rounded-md border-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('name') }}" required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label class="text-white text-sm">Email</label>
                    <input id="email" type="email" name="email"
                        class="mt-1 w-full bg-gray-700/60 text-white rounded-md border-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label class="text-white text-sm">Buat Password</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 w-full bg-gray-700/60 text-white rounded-md border-none focus:ring-2 focus:ring-red-500"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label class="text-white text-sm">Verifikasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 w-full bg-gray-700/60 text-white rounded-md border-none focus:ring-2 focus:ring-red-500"
                        required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                </div>

                <!-- Button -->
                <div class="mt-6 flex flex-col items-center">
                    <button type="submit"
                        class="w-full py-3 bg-red-600 hover:bg-red-700 rounded-full text-white font-semibold transition">
                        Daftar
                    </button>

                    <p class="text-white mt-4 text-sm">
                        Sudah Punya Akun?
                        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-500 font-semibold">
                            Login
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </form>

</x-guest-layout>
