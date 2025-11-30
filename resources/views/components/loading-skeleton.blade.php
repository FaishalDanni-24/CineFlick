{{--
LOADING SKELETON COMPONENT
Displayed during infinite scroll loading
--}}

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @for($i = 0; $i < 6; $i++)
    <div class="animate-pulse">
        {{-- Poster Skeleton --}}
        <div class="aspect-[2/3] bg-gray-700 rounded-lg mb-3"></div>
        
        {{-- Title Skeleton --}}
        <div class="h-4 bg-gray-700 rounded w-3/4 mb-2"></div>
        
        {{-- Info Skeleton --}}
        <div class="flex justify-between">
            <div class="h-3 bg-gray-700 rounded w-16"></div>
            <div class="h-3 bg-gray-700 rounded w-12"></div>
        </div>
    </div>
    @endfor
</div>
