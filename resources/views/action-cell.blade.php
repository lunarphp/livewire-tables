<div x-data="{ isActive: false }"
     class="relative">
    <div
         class="inline-flex items-stretch bg-white border border-gray-200 rounded-md hover:shadow-sm focus-within:ring focus-within:ring-blue-100">
        <a href="/edit"
           class="button button-gray px-2.5 py-2 text-xs !border-0 !rounded-r-none focus:!ring-transparent focus:bg-gray-50">
            Edit
        </a>

        <x-tables::button size="xs"
                          aria-label="Toggle Menu"
                          x-on:click="isActive = !isActive"
                          class="!border-y-0 !border-r-0 !rounded-l-none focus:!ring-transparent focus:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 viewBox="0 0 20 20"
                 fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
            </svg>
        </x-tables::button>
    </div>

    <div x-cloak
         x-transition
         x-show="isActive"
         x-on:click.away="isActive = false"
         x-on:keydown.escape.window="isActive = false"
         role="menu"
         class="absolute right-0 z-50 w-48 mt-2 text-left origin-top-right bg-white border border-gray-100 rounded-lg shadow-sdm">
        <div class="p-2">
            @foreach ($this->actions as $actionIndex => $action)
                @php
                    $action = $action->record($record);
                @endphp

                {{ $action }}
            @endforeach
        </div>
    </div>
</div>
