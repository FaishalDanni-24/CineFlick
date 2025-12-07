<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-gray-700 hover:bg-gray-600 active:bg-gray-800 border border-gray-600 rounded-lg font-semibold text-sm text-gray-200 uppercase tracking-wide focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200']) }}>
    {{ $slot }}
</button>
