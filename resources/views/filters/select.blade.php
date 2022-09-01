<div>
    <label for="{{ $field }}"
           class="block text-xs font-medium text-gray-700 capitalize">
        {{ $heading }}
    </label>

    <select id="{{ $field }}"
            wire:model="filters.{{ $field }}"
            class="mt-1 text-sm text-gray-700 border-gray-200 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300 form-select">
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
