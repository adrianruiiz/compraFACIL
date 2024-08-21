<!-- resources/views/pagination/custom.blade.php -->
@php
    $paginator = $paginator->appends(request()->except('page'));
@endphp

@if ($paginator->hasPages())
    <nav class="flex justify-between items-center text-gray-700">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg cursor-not-allowed" aria-disabled="true">
                {!! __('&laquo; Anterior') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-200">
                {!! __('&laquo; Anterior') !!}
            </a>
        @endif

        <!-- Pagination Elements -->
        <div class="flex items-center">
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg">{{ $element }}</span>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-200 ">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-200">
                {!! __('Siguiente &raquo;') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg cursor-not-allowed" aria-disabled="true">
                {!! __('Siguiente &raquo;') !!}
            </span>
        @endif
    </nav>
@endif
