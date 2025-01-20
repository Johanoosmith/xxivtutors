@if ($paginator->hasPages())
{{-- Previous Page Link --}}

                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="page-link prev relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.26873 9.33183C5.31054 9.37364 5.3437 9.42327 5.36633 9.4779C5.38896 9.53253 5.4006 9.59107 5.4006 9.6502C5.4006 9.70933 5.38896 9.76788 5.36633 9.8225C5.3437 9.87713 5.31054 9.92677 5.26873 9.96858C5.22692 10.0104 5.17728 10.0436 5.12266 10.0662C5.06803 10.0888 5.00948 10.1005 4.95035 10.1005C4.89123 10.1005 4.83268 10.0888 4.77805 10.0662C4.72342 10.0436 4.67379 10.0104 4.63198 9.96858L0.131979 5.46858C0.0901394 5.42678 0.0569482 5.37715 0.0343022 5.32252C0.0116563 5.2679 0 5.20934 0 5.1502C0 5.09106 0.0116563 5.03251 0.0343022 4.97788C0.0569482 4.92325 0.0901394 4.87362 0.131979 4.83183L4.63198 0.331826C4.71642 0.247388 4.83094 0.199951 4.95035 0.199951C5.06977 0.199951 5.18429 0.247388 5.26873 0.331826C5.35317 0.416265 5.4006 0.530788 5.4006 0.650201C5.4006 0.769615 5.35317 0.884138 5.26873 0.968576L1.08654 5.1502L5.26873 9.33183Z" fill="currentColor"></path>
                                    </svg>
                            </span>
                        </li>
                    @else
                    <li class="page-item">   
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link next relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    @endif
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item" aria-disabled="true">
                                <span class="page-link relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item" aria-current="page">
                                        <span class="page-link relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $page }}</span>
                                    </li>
                                @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                    <li class="page-item">    
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link next relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.73127 9.33183C0.689461 9.37364 0.656296 9.42327 0.633669 9.4779C0.611042 9.53253 0.599395 9.59107 0.599395 9.6502C0.599395 9.70933 0.611042 9.76788 0.633669 9.8225C0.656296 9.87713 0.689461 9.92677 0.73127 9.96858C0.77308 10.0104 0.822715 10.0436 0.877342 10.0662C0.931969 10.0888 0.990518 10.1005 1.04965 10.1005C1.10877 10.1005 1.16732 10.0888 1.22195 10.0662C1.27658 10.0436 1.32621 10.0104 1.36802 9.96858L5.86802 5.46858C5.90986 5.42678 5.94305 5.37715 5.9657 5.32252C5.98834 5.2679 6 5.20934 6 5.1502C6 5.09106 5.98834 5.03251 5.9657 4.97788C5.94305 4.92325 5.90986 4.87362 5.86802 4.83183L1.36802 0.331826C1.28358 0.247388 1.16906 0.199951 1.04965 0.199951C0.930232 0.199951 0.815709 0.247388 0.73127 0.331826C0.646832 0.416265 0.599395 0.530788 0.599395 0.650201C0.599395 0.769615 0.646832 0.884138 0.73127 0.968576L4.91346 5.1502L0.73127 9.33183Z" fill="currentColor"></path>
                                    </svg>
                        </a>
                    </li>
                    @else
                
                        <li class="page-item" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="page-link next relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                            <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.73127 9.33183C0.689461 9.37364 0.656296 9.42327 0.633669 9.4779C0.611042 9.53253 0.599395 9.59107 0.599395 9.6502C0.599395 9.70933 0.611042 9.76788 0.633669 9.8225C0.656296 9.87713 0.689461 9.92677 0.73127 9.96858C0.77308 10.0104 0.822715 10.0436 0.877342 10.0662C0.931969 10.0888 0.990518 10.1005 1.04965 10.1005C1.10877 10.1005 1.16732 10.0888 1.22195 10.0662C1.27658 10.0436 1.32621 10.0104 1.36802 9.96858L5.86802 5.46858C5.90986 5.42678 5.94305 5.37715 5.9657 5.32252C5.98834 5.2679 6 5.20934 6 5.1502C6 5.09106 5.98834 5.03251 5.9657 4.97788C5.94305 4.92325 5.90986 4.87362 5.86802 4.83183L1.36802 0.331826C1.28358 0.247388 1.16906 0.199951 1.04965 0.199951C0.930232 0.199951 0.815709 0.247388 0.73127 0.331826C0.646832 0.416265 0.599395 0.530788 0.599395 0.650201C0.599395 0.769615 0.646832 0.884138 0.73127 0.968576L4.91346 5.1502L0.73127 9.33183Z" fill="currentColor"></path>
                                    </svg>
                            </span>
                        </span>
                        </li>
                    @endif

    
@endif
