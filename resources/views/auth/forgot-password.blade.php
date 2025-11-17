<x-guest-layout>

    <div class="w-full flex justify-center px-6 pt-36 md:pt-20 md:px-0">
        <div class="w-full max-w-md bg-black/10 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/20">

            <h2 class="text-center text-white text-sm mb-4 font-medium">
                Masukkan Email-mu Untuk Reset Password
            </h2>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="
                            block w-full mt-1
                            bg-gray-500/30 text-white
                            placeholder-gray-300
                            border border-gray-500/40
                            rounded-md

                            focus:border-red-500
                            focus:ring-2 focus:ring-red-600
                            focus:ring-offset-0
                            outline-none
                        "
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <div class="mt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-full text-sm font-semibold transition">
                        Kirim
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-guest-layout>
