<div>
    <x-hub::input.group :label="$heading" for="$field">
        <x-hub::input.select wire:model="filters.{{ $field }}">
            @foreach($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </x-hub::input.select>
    </x-hub::input.group>
</div>
