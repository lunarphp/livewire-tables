<div>
    @if ($url)
        <a role="menuitem"
           href="{{ call_user_func($url, $record) }}"
           class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50">
            <span class="capitalize">
                {{ $label }}
            </span>
        </a>
    @else
        <p class="px-3 py-2 text-sm font-medium text-gray-600">
            <span class="capitalize">
                {{ $label }}
            </span>
        </p>
    @endif
</div>
