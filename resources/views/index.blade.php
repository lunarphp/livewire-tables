<div class="space-y-4">
    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
      <div class="w-full overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              @foreach($this->columns as $column)
                @livewire('get-candy.livewire-tables.components.head', [
                    'heading' => $column->getHeading(),
                    'sortable' => $column->isSortable(),
                    'field' => $column->field,
                    'sortField' => $sortField,
                    'sortDir' => $sortDir,
                ], key($column->field))
              @endforeach
            </tr>
          </thead>

          <tbody class="relative">
            @foreach($this->rows as $row)
              <tr class="bg-white even:bg-gray-50" wire:key="table_row_{{ $row->id }}">
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
