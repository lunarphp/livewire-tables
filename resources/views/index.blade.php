<div class="space-y-4" x-data="{
    savingSearch: false,
    init() {
        Livewire.on('savedSearch', () => this.savingSearch = false)
    }
}">
    <div class="flex items-center space-x-4">
      @foreach($this->savedSearches as $savedSearch)
        <div class="flex items-center space-x-1">
            <x-hub::button theme="gray" wire:click="applySavedSearch({{ $savedSearch['key'] }})">
              {{ $savedSearch['label'] }}
            </x-hub::button>
            <button wire:click="deleteSavedSearch({{ $savedSearch['key'] }})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>

            </button>
        </div>
      @endforeach
    </div>

    <div x-show="savingSearch" x-cloak>
        <x-tables::support.modal>
            <div class="p-4 space-y-4">
                <x-hub::input.group for="savedSearchName" label="Name" :error="$errors->first('savedSearchName')">
                    <x-hub::input.text id="saveSearchName" wire:model="savedSearchName" />
                </x-hub::input.group>

                <x-tables::button type="button" wire:click="saveSearch">Save Search</x-tables::button>
            </div>
        </x-tables::support.modal>
    </div>
    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
      <div
        class="w-full"
        x-data="{
          showFilters: false,
          selected: @entangle('selected').defer,
          toggleSelectAll() {
            if (!this.selected.length) {
              this.selected = {{ json_encode($this->rows->pluck('id')->toArray()) }}
            } else {
              this.selected = []
            }

          }
        }"
    >
        <div x-show="selected.length" class="p-4" x-cloak>
          @foreach($this->bulkActions as $action)
            {{ $action }}
          @endforeach
        </div>
        <div class="items-center w-full md:space-x-4 md:flex p-4">
            @if($this->searchable)
                <div class="md:grow">
                    <x-hub::input.text
                        :placeholder="$this->searchPlaceholder"
                        class="py-2"
                        wire:model.debounce.400ms="query"
                    />
                </div>
            @endif
            <div class="flex items-center space-x-2">
            @if($this->tableFilters->count())
                <x-hub::button theme="gray" @click="showFilters = !showFilters">Filter</x-hub::button>
            @endif

            @if($this->hasSearchApplied)
                <x-hub::button theme="gray" @click="savingSearch = true">
                    Save search
                </x-hub::button>
            @endif
            </div>
        </div>

        <div
            class="bg-white p-4 border-b border-t"
            x-show="showFilters"
            x-cloak
        >
            <div class="grid grid-cols-4">
                @foreach($this->tableFilters as $filter)
                    <div>{{ $filter }}</div>
                @endforeach
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              @if($this->bulkActions->count())
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <x-hub::input.checkbox @click="toggleSelectAll" />
                </td>
              @endif
              @foreach($this->columns as $column)
                @livewire('get-candy.livewire-tables.components.head', [
                    'heading' => $column->getHeading(),
                    'sortable' => $column->isSortable(),
                    'field' => $column->field,
                    'sortField' => $sortField,
                    'sortDir' => $sortDir,
                ], key($column->field))
              @endforeach
              @if($this->actions->count())
                <td></td>
              @endif
            </tr>

            <tr x-cloak x-show="selected.length">
              <td colspan="50">
                <div class="bg-blue-50 text-blue-800 px-4 py-2 border-t border-blue-200 text-sm">
                  Selected <span x-text="selected.length"></span> of {{ $this->rows->count() }} results.
                </div>
              </td>
            </tr>
          </thead>

          <tbody class="relative">
            @foreach($this->rows as $row)
              <tr class="bg-white even:bg-gray-50" wire:key="table_row_{{ $row->id }}">
                @if($this->bulkActions->count())
                  <x-tables::cell>
                    <x-hub::input.checkbox x-model="selected" value="{{ $row->id }}" />
                  </x-tables::cell>
                @endif

                @foreach($this->columns as $column)
                  <x-tables::cell :sort="true" wire:key="column_{{ $column->field }}">
                    @if($column->isLivewire())
                      <livewire:is :component="$column->getLivewire()"/>
                    @elseif($column->isViewComponent())
                      <x-dynamic-component
                        :component="$column->getViewComponent()"
                        :record="$row"
                       />
                    @else
                      {{ $column->record($row)->render() }}
                    @endif
                  </x-tables::cell>
                @endforeach

                <x-tables::cell>
                    <x-tables::action-cell :actions="$this->actions" :record="$row" />
                </x-tables::cell>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @if($hasPagination)
        <div>
            {{ $this->rows->links() }}
        </div>
    @endif
</div>
