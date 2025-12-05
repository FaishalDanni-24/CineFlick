<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wide focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 shadow-lg shadow-red-600/30']) }}>
    {{ $slot }}
</button>
