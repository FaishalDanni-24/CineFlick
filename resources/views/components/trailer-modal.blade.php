<div 
    x-data="{ 
        open: false, 
        trailerUrl: '' 
    }"
    @open-trailer.window="open = true; trailerUrl = $event.detail.url"
    @close.stop="open = false"
    @keydown.escape.window="open = false"
    x-show="open"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
>
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 bg-black/80"
    ></div>
    
    <div class="flex min-h-full items-center justify-center p-4">
        <div 
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative bg-gray-900 rounded-xl overflow-hidden w-full max-w-4xl"
        >
            <button 
                @click="open = false"
                class="absolute top-4 right-4 z-10 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition"
            >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="aspect-video">
                <iframe 
                    :src="trailerUrl" 
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</div>
