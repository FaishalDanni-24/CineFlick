<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center">
        <div
            class="p-8 w-full max-w-lg rounded-3xl 
                   backdrop-blur-2xl shadow-[0_8px_40px_rgba(0,0,0,0.55)]
                   border border-red-400/30 bg-red-900/30 relative"
            style="
                background: linear-gradient(
                    135deg,
                    rgba(255, 0, 0, 0.18),
                    rgba(20, 0, 0, 0.35)
                );
            "
        >

            {{-- Glow merah halus --}}
            <div class="absolute inset-0 rounded-3xl pointer-events-none"
                style="
                    border: 1px solid rgba(255, 50, 50, 0.25);
                    background: radial-gradient(
                        circle at top left,
                        rgba(255, 60, 60, 0.25),
                        transparent 60%
                    );
                ">
            </div>

            {{-- CONTENT --}}
            <div class="relative z-10 text-gray-200 space-y-4">

                <p class="text-sm leading-relaxed text-gray-200">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <p class="text-sm font-medium text-green-400">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                @endif

                <div class="flex items-center justify-between pt-3">

                    {{-- BUTTON MERAH --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button
                            class="px-5 py-2 rounded-xl font-semibold text-sm
                                   bg-red-600 hover:bg-red-700
                                   text-white shadow-lg shadow-red-900/40
                                   transition-all duration-200
                                   focus:outline-none focus:ring-2 focus:ring-red-300"
                        >
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="px-5 py-2 rounded-xl font-semibold text-sm
                                   bg-red-600 hover:bg-red-700
                                   text-white shadow-lg shadow-red-900/40
                                   transition-all duration-200
                                   focus:outline-none focus:ring-2 focus:ring-red-300"
                        >
                            {{ __('Log Out') }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
