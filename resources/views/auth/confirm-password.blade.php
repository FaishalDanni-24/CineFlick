<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center w-full bg-black/20 ">

        <div class="w-full max-w-md bg-white/10 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/10">
            
            <div class="mb-4 text-sm text-gray-200 text-center">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-200 mb-1">
                        Password
                    </label>

                    <input 
                        id="password" 
                        class="block w-full rounded-xl p-3 bg-white/10 text-white border border-white/20 focus:ring-red-500 focus:border-red-500"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <div class="flex justify-end mt-6">
                    <button 
                        class="px-6 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">
                        Confirm
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-guest-layout>
