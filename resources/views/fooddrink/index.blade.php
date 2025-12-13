@extends('layouts.app')

@php
    $showNavigation = false;
    $showPattern = true;
@endphp

@section('content')
{{-- Sidebar --}}
@include('components.sidebar')

{{-- Main Content Area --}}
<main class="lg:ml-64 min-h-screen bg-gray-900 relative">
    {{-- Background Pattern (FIX: z-index dan positioning) --}}
    @if($showPattern)
    <div class="absolute inset-0 pointer-events-none opacity-5"
         style="background-image: url('{{ asset('images/pattern 3.png') }}'); 
                background-repeat: repeat; 
                background-size: 1600px;
                z-index: 0;">
    </div>
    @endif

    {{-- Navbar (FIX: z-index lebih tinggi dari pattern) --}}
    <div class="relative z-20">
        @include('components.navbar')
    </div>
    
    <!-- Content Container -->
    <div class="container mx-auto px-6 py-8 relative z-10">
        
        {{-- Page Title --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">Food & Drink</h1>
            <p class="text-gray-400">Explore our delicious menu options for your movie experience</p>
        </div>

        {{-- Filter Tabs --}}
        @include('components.genre-filter', [
            'filters' => [
                ['label' => 'All', 'value' => 'all', 'count' => $counts['all']],
                ['label' => 'Promo', 'value' => 'promo', 'count' => $counts['promo']],
                ['label' => 'Combo', 'value' => 'combo', 'count' => $counts['combo']],
                ['label' => 'Food', 'value' => 'food', 'count' => $counts['food']],
                ['label' => 'Drink', 'value' => 'drink', 'count' => $counts['drink']],
            ],
            'currentFilter' => $filter,
            'route' => 'fooddrink.index',
            'paramName' => 'filter'
        ])

        {{-- Products Grid --}}
        @if($foodDrinks->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
                @foreach($foodDrinks as $item)
                    <div class="food-card group cursor-pointer" 
                         data-product-id="{{ $item->id }}"
                         data-product-name="{{ $item->name }}"
                         data-product-type="{{ $item->type }}"
                         data-product-price="{{ $item->price }}"
                         data-product-image="{{ $item->image_url ?? '' }}"
                         onclick="openDetailModalFromData(this)">
                        
                        {{-- Product Image --}}
                        <div class="relative aspect-square overflow-hidden rounded-t-lg bg-gradient-to-br from-yellow-400 to-orange-500">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" 
                                     alt="{{ $item->name }}"
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                     onerror="this.onerror=null; this.src='https://placehold.co/400x400/F59E0B/ffffff?text={{ urlencode($item->name) }}';">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Type Badge --}}
                            <div class="absolute top-2 right-2">
                                <span class="px-3 py-1 text-xs font-bold rounded-full backdrop-blur-sm
                                    {{ $item->type === 'food' ? 'bg-red-500/90 text-white' : 'bg-blue-500/90 text-white' }}">
                                    {{ ucfirst($item->type) }}
                                </span>
                            </div>
                        </div>

                        {{-- Product Info --}}
                        <div class="bg-gray-800 p-4 rounded-b-lg">
                            <h3 class="text-white font-semibold text-base mb-2 truncate group-hover:text-red-500 transition-colors">
                                {{ $item->name }}
                            </h3>
                            <div class="flex items-center justify-between">
                                <p class="text-red-500 font-bold text-lg">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                                <div class="w-8 h-8 flex items-center justify-center bg-red-500/20 rounded-lg group-hover:bg-red-500 transition-colors">
                                    <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors group-hover:translate-x-0.5" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($foodDrinks->hasPages())
                <div class="mt-10">
                    {{ $foodDrinks->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-20 mt-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-800 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">No Items Found</h3>
                <p class="text-gray-400 mb-6">There are no items in this category</p>
                <a href="{{ route('fooddrink.index') }}" 
                   class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                    View All Items
                </a>
            </div>
        @endif
    </div>
</main>

{{-- Detail Modal (Slide from Right) --}}
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/75 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    
    {{-- Modal Panel --}}
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-gray-900 shadow-2xl transform transition-transform duration-300 ease-out" 
         id="modalPanel" style="transform: translateX(100%)">
        
        {{-- Header --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-800">
            <h2 class="text-xl font-bold text-white">Product Details</h2>
            <button onclick="closeDetailModal()" 
                    class="w-10 h-10 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-lg transition-all hover:rotate-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="p-6 overflow-y-auto" style="height: calc(100% - 80px);">
            {{-- Product Image --}}
            <div class="relative aspect-square overflow-hidden rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 mb-6">
                <img id="modalImage" 
                     src="" 
                     alt="Product Image" 
                     class="w-full h-full object-cover"
                     style="display: none;"
                     onload="this.style.display='block'; document.getElementById('modalImagePlaceholder').style.display='none';"
                     onerror="this.style.display='none'; document.getElementById('modalImagePlaceholder').style.display='flex';">
                <div id="modalImagePlaceholder" class="w-full h-full flex items-center justify-center">
                    <svg class="w-24 h-24 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="space-y-4">
                <div>
                    <h3 id="modalName" class="text-2xl font-bold text-white mb-3"></h3>
                    <span id="modalType" class="inline-block px-4 py-1.5 text-sm font-bold rounded-full"></span>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <p class="text-gray-400 text-sm mb-1">Price</p>
                    <p id="modalPrice" class="text-3xl font-bold text-red-500"></p>
                </div>

                <div class="flex items-start gap-3 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
                    <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-yellow-400 text-sm leading-relaxed">
                        This item can be purchased during movie ticket booking process
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Food Card */
.food-card {
    background: transparent;
    border-radius: 0.5rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.food-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}
</style>
@endpush

@push('scripts')
<script>
// Ensure Alpine.js is loaded and initialized
document.addEventListener('alpine:init', () => {
    console.log('Alpine.js initialized on Food & Drink page');
});

// FIX: Gunakan data attributes untuk menghindari masalah dengan special characters
function openDetailModalFromData(element) {
    const productData = {
        id: element.dataset.productId,
        name: element.dataset.productName,
        type: element.dataset.productType,
        price: element.dataset.productPrice,
        image_url: element.dataset.productImage
    };
    
    console.log('Opening modal for product:', productData);
    console.log('Image URL:', productData.image_url);
    
    openDetailModal(productData);
}

function openDetailModal(product) {
    const modal = document.getElementById('detailModal');
    const panel = document.getElementById('modalPanel');
    const modalImage = document.getElementById('modalImage');
    const modalImagePlaceholder = document.getElementById('modalImagePlaceholder');
    
    if (!modal || !panel || !modalImage) {
        console.error('Modal elements not found');
        return;
    }
    
    // Reset displays
    modalImage.style.display = 'none';
    modalImagePlaceholder.style.display = 'flex';
    
    // Update image
    const imageUrl = product.image_url || '';
    console.log('Setting image URL:', imageUrl);
    
    if (imageUrl && imageUrl.trim() !== '') {
        modalImage.src = imageUrl;
        modalImage.alt = product.name || 'Product';
        // Image will show via onload event
    } else {
        console.log('No valid image URL, showing placeholder');
    }
    
    // Update product name
    const modalName = document.getElementById('modalName');
    if (modalName) {
        modalName.textContent = product.name || 'Product Name';
    }
    
    // Update type badge
    const modalType = document.getElementById('modalType');
    if (modalType) {
        const productType = product.type || 'food';
        modalType.textContent = productType.charAt(0).toUpperCase() + productType.slice(1);
        modalType.className = 'inline-block px-4 py-1.5 text-sm font-bold rounded-full ' + 
            (productType === 'food' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white');
    }
    
    // Update price
    const modalPrice = document.getElementById('modalPrice');
    if (modalPrice) {
        const price = Number(product.price) || 0;
        modalPrice.textContent = 'Rp ' + price.toLocaleString('id-ID');
    }
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Slide in animation
    setTimeout(() => {
        panel.style.transform = 'translateX(0)';
    }, 10);
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const panel = document.getElementById('modalPanel');
    
    if (!modal || !panel) return;
    
    // Slide out animation
    panel.style.transform = 'translateX(100%)';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

// Close on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeDetailModal();
    }
});

// Debug: Check if Alpine.js is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    console.log('Alpine available?', typeof window.Alpine !== 'undefined');
    
    // If Alpine not available after 1 second, log warning
    setTimeout(() => {
        if (typeof window.Alpine === 'undefined') {
            console.warn('Alpine.js not loaded! Hamburger and dropdown will not work.');
            console.warn('Check if Alpine.js is included in app.blade.php');
        } else {
            console.log('Alpine.js is available ✓');
        }
    }, 1000);
});
</script>
@endpush
