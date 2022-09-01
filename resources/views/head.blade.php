<th class="px-4 py-3 text-sm font-medium text-left text-gray-700">
    @unless($sortable)
        <span class="capitalize">
            {{ $heading }}
        </span>
    @else
        <button class="flex items-center gap-0.5 group focus:outline-none focus:ring focus:ring-blue-100 p-2 -m-2"
                wire:click="sort">
            <span class="capitalize">
                {{ $heading }}
            </span>

            <span>
                @if ($sortField == $field)
                    <span @class([
                        'block',
                        'rotate-0' => $sortDir === 'asc',
                        'rotate-180' => $sortDir === 'desc',
                    ])>
                        <svg class="w-3 h-3"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 15l7-7 7 7"></path>
                        </svg>
                    </span>
                @else
                    <span class="transition opacity-0 group-hover:opacity-100">
                        <svg class="w-3 h-3"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 15l7-7 7 7"></path>
                        </svg>
                    </span>
                @endif
            </span>
        </button>
    @endunless
</th>
