@props($rowCount)

<tbody class="lt-hidden"
       wire:loading.class.remove="lt-hidden">
    @foreach (range($rowCount) as $id)
        <tr class="lt-border-b lt-border-gray-100 lt-bg-white"
            wire:key="loading_{{ $id }}">
            @if (count($this->bulkActions))
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
    @endforeach
</tbody>
