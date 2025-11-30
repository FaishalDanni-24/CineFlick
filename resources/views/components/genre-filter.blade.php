{{-- Dynamic Filter Support --}}
@php
    $filters = $filters ?? [];
    $currentFilter = $currentFilter ?? null;
    $route = $route ?? 'movies.index';
    $paramName = $paramName ?? 'genre';
@endphp

<div class="flex flex-wrap gap-2 mb-8">
    @foreach($filters as $filterItem)
        <a href="{{ route($route, [$paramName => $filterItem['value']]) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-all
                  {{ $currentFilter === $filterItem['value'] 
                      ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg' 
                      : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">
            {{ $filterItem['label'] }}
            @if(isset($filterItem['count']) && $filterItem['count'] > 0)
                <span class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-bold
                             {{ $currentFilter === $filterItem['value'] 
                                 ? 'bg-white/25' 
                                 : 'bg-white/10' }}">
                    {{ $filterItem['count'] }}
                </span>
            @endif
        </a>
    @endforeach
</div>
