<div class="space-y-4">
    <div>
      @foreach($this->savedSearches as $savedSearch)
        <x-hub::button theme="gray" wire:click="applySavedSearch({{ $savedSearch['key'] }})">
          {{ $savedSearch['label'] }}
        </x-hub::button>
      @endforeach
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
                <div class="w-full md:grow">
                    <x-hub::input.text
                        :placeholder="$this->searchPlaceholder"
                        class="py-2"
                        wire:model.debounce.400ms="query"
                    />
                </div>
            @endif
            @if($this->tableFilters->count())
                <x-hub::button theme="gray" @click="showFilters = !showFilters">Filter</x-hub::button>
            @endif
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
