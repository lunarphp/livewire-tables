<div x-data="{
    savingSearch: false,
    init() {
        Livewire.on('savedSearch', () => this.savingSearch = false)
    }
}">
    <div x-cloak
         x-show="savingSearch">
        <x-tables::support.modal>
            <div class="p-4">
                <div class="flex items-end gap-4">
                    <div class="flex-1">
                        <label for="SaveSearchName"
                               class="block text-xs font-medium text-gray-700 capitalize">
                            Name
                        </label>

                        <input type="text"
                               id="SaveSearchName"
                               placeholder="Name"
                               wire:model="savedSearchName"
                               class="w-full mt-1 text-sm text-gray-700 border-gray-200 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300 form-input">
                    </div>

                    <x-tables::button theme="primary"
                                      wire:click="saveSearch">
                        Save Search
                    </x-tables::button>
                </div>

                @if ($errors->first('savedSearchName'))
                    <small class="block mt-1 text-red-600">
                        {{ $errors->first('savedSearchName') }}
                    </small>
                @endif
            </div>
        </x-tables::support.modal>
    </div>

    <div class="overflow-hidden border border-gray-200 rounded-lg">
        <div x-data="{
            showFilters: false,
            selected: @entangle('selected').defer,
            selectedAll: false,
        }"
             x-init="$watch('selectedAll', function(isChecked) {
                 selected = isChecked ? {{ json_encode($this->rows->pluck('id')->toArray()) }} : []
             })"
             class="w-full divide-y divide-gray-200">
            <div class="p-4">
                <div class="flex items-center gap-2 sm:gap-4">
                    @if ($this->searchable)
                        <div class="flex-1">
                            <div class="relative">
                                <label for="Search"
                                       class="absolute inset-y-0 left-0 grid w-10 place-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-4 h-4">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>

                                    <span class="sr-only">
                                        Search
                                    </span>
                                </label>

                                <input type="text"
                                       id="Search"
                                       placeholder="{{ $this->searchPlaceholder }}"
                                       wire:model.debounce.500ms="query"
                                       class="w-full pl-10 text-sm text-gray-700 border-gray-200 rounded-md form-input focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300">
                            </div>
                        </div>
                    @endif

                    @if ($this->hasSearchApplied)
                        <x-tables::button x-on:click="savingSearch = true">
                            Save Search
                        </x-tables::button>
                    @endif

                    @if (count($this->tableFilters))
                        <x-tables::button x-on:click="showFilters = !showFilters">
                            Filters

                            @if (count($this->filters))
                                <sup>
                                    ({{ count($this->filters) }})
                                </sup>
                            @endif
                        </x-tables::button>
                    @endif
                </div>

                @if (count($this->savedSearches))
                    <div class="flex items-center gap-4 mt-2">
                        @foreach ($this->savedSearches as $savedSearch)
                            <div
                                 class="flex items-stretch overflow-hidden text-gray-600 transition bg-white border border-gray-200 rounded-md hover:shadow-sm focus-within:ring focus-within:ring-blue-100">
                                <x-tables::button size="xs"
                                                  aria-label="Delete Saved Search"
                                                  wire:click="deleteSavedSearch({{ $savedSearch['key'] }})"
                                                  class="!border-0 !rounded-r-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-3 h-3">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </x-tables::button>

                                <x-tables::button size="xs"
                                                  aria-label="Apply Saved Search"
                                                  wire:click="applySavedSearch({{ $savedSearch['key'] }})"
                                                  class="!border-y-0 !border-r-0 !rounded-l-none">
                                    {{ $savedSearch['label'] }}
                                </x-tables::button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-cloak
                 x-show="showFilters || selected.length"
                 class="p-4 bg-white">
                <div class="flow-root">
                    <div class="-my-4 divide-y divide-gray-100">
                        <div :hidden="!selected.length"
                             class="py-4">
                            <p class="text-sm font-medium text-gray-900">Bulk Actions</p>

                            <div class="flex flex-wrap gap-4 mt-2">
                                @foreach ($this->bulkActions as $action)
                                    {{ $action }}
                                @endforeach
                            </div>
                        </div>

                        <div :hidden="!showFilters"
                             class="py-4">
                            <p class="sr-only">Filters</p>

                            <div class="flex flex-wrap gap-4">
                                @foreach ($this->tableFilters as $filter)
                                    <div>{{ $filter }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                        <tr>
                            @if ($this->bulkActions->count())
                                <td class="w-10 py-3 pl-4 leading-none">
                                    <input type="checkbox"
                                           x-model="selectedAll"
                                           class="w-5 h-5 border border-gray-300 rounded-md form-checkbox focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300 focus:ring-offset-0">
                                </td>
                            @endif

                            @foreach ($this->columns as $column)
                                @livewire(
                                    'get-candy.livewire-tables.components.head',
                                    [
                                        'heading' => $column->getHeading(),
                                        'sortable' => $column->isSortable(),
                                        'field' => $column->field,
                                        'sortField' => $sortField,
                                        'sortDir' => $sortDir,
                                    ],
                                    key($column->field),
                                )
                            @endforeach

                            @if (count($this->actions))
                                <td></td>
                            @endif
                        </tr>

                        <tr x-cloak
                            x-show="selected.length">
                            <td colspan="50"
                                class="p-0">
                                <div
                                     class="relative px-3 py-2 -my-px text-sm text-blue-700 border-blue-200 border-y bg-blue-50">
                                    Selected <span x-text="selected.length"></span> of {{ $this->rows->count() }}
                                    results.
                                </div>
                            </td>
                        </tr>
                    </thead>

                    <tbody class="relative">
                        @foreach ($this->rows as $row)
                            <tr class="bg-white even:bg-gray-50"
                                wire:key="table_row_{{ $row->id }}">
                                @if ($this->bulkActions->count())
                                    <x-tables::cell class="w-10 pr-0 leading-none">
                                        <input type="checkbox"
                                               x-model="selected"
                                               value="{{ $row->id }}"
                                               class="w-5 h-5 border border-gray-300 rounded-md form-checkbox focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300 focus:ring-offset-0">
                                    </x-tables::cell>
                                @endif

                                @foreach ($this->columns as $column)
                                    <x-tables::cell :sort="true"
                                                    wire:key="column_{{ $column->field }}">
                                        @if ($column->isLivewire())
                                            <livewire:is :component="$column->getLivewire()" />
                                        @elseif($column->isViewComponent())
                                            <x-dynamic-component :component="$column->getViewComponent()"
                                                                 :record="$row" />
                                        @else
                                            {{ $column->record($row)->render() }}
                                        @endif
                                    </x-tables::cell>
                                @endforeach

                                <x-tables::cell class="text-right ">
                                    <x-tables::action-cell :actions="$this->actions"
                                                           :record="$row" />
                                </x-tables::cell>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($hasPagination)
        <div class="mt-4">
            {{ $this->rows->links() }}
        </div>
    @endif
</div>
