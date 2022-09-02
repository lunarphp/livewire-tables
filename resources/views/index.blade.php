<div x-data="{
    savingSearch: false,
    init() {
        Livewire.on('savedSearch', () => this.savingSearch = false)
    }
}">
    <div x-cloak
         x-show="savingSearch">
        <x-tables::support.modal>
            <div class="lt-p-4">
                <div class="lt-flex lt-items-end lt-gap-4">
                    <div class="lt-flex-1">
                        <label for="SaveSearchName"
                               class="lt-block lt-text-xs lt-font-medium lt-text-gray-700 lt-capitalize">
                            Name
                        </label>

                        <input type="text"
                               id="SaveSearchName"
                               placeholder="Name"
                               wire:model="savedSearchName"
                               class="lt-w-full lt-mt-1 lt-text-sm lt-text-gray-700 lt-border-gray-200 lt-rounded-md focus:lt-outline-none focus:lt-ring focus:lt-ring-blue-100 focus:lt-border-blue-300 lt-form-input">
                    </div>

                    <x-tables::button theme="primary"
                                      wire:click="saveSearch">
                        Save Search
                    </x-tables::button>
                </div>

                @if ($errors->first('savedSearchName'))
                    <small class="lt-block lt-mt-1 lt-text-red-600">
                        {{ $errors->first('savedSearchName') }}
                    </small>
                @endif
            </div>
        </x-tables::support.modal>
    </div>

    <div class="lt-overflow-hidden lt-border lt-border-gray-200 lt-rounded-lg">
        <div x-data="{
            showFilters: false,
            selected: @entangle('selected').defer,
            selectedAll: false,
        }"
             x-init="$watch('selectedAll', function(isChecked) {
                 selected = isChecked ? {{ json_encode($this->rows->pluck('id')->toArray()) }} : []
             })"
             class="lt-w-full lt-divide-y lt-divide-gray-200">
            <div class="lt-p-4">
                <div class="lt-flex lt-items-center lt-gap-2 sm:lt-gap-4">
                    @if ($this->searchable)
                        <div class="lt-flex-1">
                            <div class="lt-relative">
                                <label for="Search"
                                       class="lt-absolute lt-inset-y-0 lt-left-0 lt-grid lt-w-10 lt-place-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="lt-w-4 lt-h-4">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>

                                    <span class="lt-sr-only">
                                        Search
                                    </span>
                                </label>

                                <input type="text"
                                       id="Search"
                                       placeholder="{{ $this->searchPlaceholder }}"
                                       wire:model.debounce.500ms="query"
                                       class="lt-w-full lt-pl-10 lt-text-sm lt-text-gray-700 lt-border-gray-200 lt-rounded-md lt-form-input focus:lt-outline-none focus:lt-ring focus:lt-ring-blue-100 focus:lt-border-blue-300">
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
                                <sup class="lt-top-0">
                                    ({{ count($this->filters) }})
                                </sup>
                            @endif
                        </x-tables::button>
                    @endif
                </div>

                @if (count($this->savedSearches))
                    <div class="lt-flex lt-items-center lt-gap-4 lt-mt-2">
                        @foreach ($this->savedSearches as $savedSearch)
                            <div
                                 class="lt-flex lt-items-stretch lt-overflow-hidden lt-text-gray-600 lt-transition lt-bg-white lt-border lt-border-gray-200 lt-rounded-md hover:lt-shadow-sm focus-within:lt-ring focus-within:lt-ring-blue-100">
                                <x-tables::button size="xs"
                                                  aria-label="Delete Saved Search"
                                                  wire:click="deleteSavedSearch({{ $savedSearch['key'] }})"
                                                  class="!border-0 !rounded-r-none focus:!lt-ring-transparent focus:lt-bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="lt-w-3 lt-h-3">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </x-tables::button>

                                <x-tables::button size="xs"
                                                  aria-label="Apply Saved Search"
                                                  wire:click="applySavedSearch({{ $savedSearch['key'] }})"
                                                  class="!lt-border-y-0 !lt-border-r-0 !lt-rounded-l-none focus:!lt-ring-transparent focus:lt-bg-gray-50">
                                    {{ $savedSearch['label'] }}
                                </x-tables::button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-cloak
                 x-show="showFilters || selected.length"
                 class="lt-p-4 lt-bg-white">
                <div class="lt-flow-root">
                    <div class="lt--my-4 lt-divide-y lt-divide-gray-100">
                        <div :hidden="!selected.length"
                             class="py-4">
                            <p class="lt-text-sm lt-font-medium lt-text-gray-900">
                                Bulk Actions
                            </p>

                            <div class="lt-flex lt-flex-wrap lt-gap-4 lt-mt-2">
                                @foreach ($this->bulkActions as $action)
                                    {{ $action }}
                                @endforeach
                            </div>
                        </div>

                        <div :hidden="!showFilters"
                             class="lt-py-4">
                            <p class="lt-sr-only">
                                Filters
                            </p>

                            <div class="lt-flex lt-flex-wrap lt-gap-4">
                                @foreach ($this->tableFilters as $filter)
                                    <div>{{ $filter }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lt-overflow-x-auto">
                <table class="lt-min-w-full lt-divide-y lt-divide-gray-200">
                    <thead class="lt-bg-white">
                        <tr>
                            @if ($this->bulkActions->count())
                                <td class="lt-w-10 lt-py-3 lt-pl-4 lt-leading-none">
                                    <input type="checkbox"
                                           x-model="selectedAll"
                                           class="lt-w-5 lt-h-5 lt-border lt-border-gray-300 lt-rounded-md lt-form-checkbox focus:lt-outline-none focus:lt-ring focus:lt-ring-blue-100 focus:lt-border-blue-300 focus:lt-ring-offset-0">
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
                                class="lt-p-0">
                                <div
                                     class="lt-relative lt-px-3 lt-py-2 lt--my-px lt-text-sm lt-text-blue-700 lt-border-blue-200 lt-border-y lt-bg-blue-50">
                                    Selected <span x-text="selected.length"></span> of {{ $this->rows->count() }}
                                    results.
                                </div>
                            </td>
                        </tr>
                    </thead>

                    <tbody class="lt-hidden" wire:loading.class.remove="lt-hidden">
                      @for($i = 0; $i <= $this->rows->count(); $i++)
                        <tr class="lt-bg-white border-b border-gray-100" wire:key="loading_{{ $i }}">
                          @if ($this->bulkActions->count())
                            <x-tables::cell class="lt-text-right">
                            </x-tables::cell>
                          @endif

                          @foreach ($this->columns as $column)
                            <x-tables::cell wire:key="loading_column_{{ $column->field }}">
                              <div class="lt-animate-pulse">
                                <div class="lt-h-4 lt-bg-gray-200 lt-rounded-full"></div>
                              </div>
                            </x-tables::cell>
                          @endforeach

                          <x-tables::cell class="lt-text-right">
                            <div class="lt-animate-pulse">
                              <div class="lt-h-4 lt-bg-gray-200 lt-rounded-full"></div>
                            </div>
                          </x-tables::cell>
                        </tr>
                      @endfor
                    </tbody>


                    <tbody class="lt-relative" wire:loading.remove>
                        @foreach ($this->rows as $row)
                            <tr class="lt-bg-white even:lt-bg-gray-50"
                                wire:key="table_row_{{ $row->id }}">
                                @if ($this->bulkActions->count())
                                    <x-tables::cell class="lt-w-10 lt-pr-0 lt-leading-none">
                                        <input type="checkbox"
                                               x-model="selected"
                                               value="{{ $row->id }}"
                                               class="lt-w-5 lt-h-5 lt-border lt-border-gray-300 lt-rounded-md lt-form-checkbox focus:lt-outline-none focus:lt-ring focus:lt-ring-blue-100 focus:lt-border-blue-300 focus:lt-ring-offset-0">
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

                                <x-tables::cell class="lt-text-right">
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
        <div class="lt-mt-4">
            {{ $this->rows->links() }}
        </div>
    @endif
</div>
