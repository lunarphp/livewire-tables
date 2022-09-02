<div>
    @if ($url)
        <a href="{{ call_user_func($url, $record) }}"
           class="lt-text-blue-600 hover:lt-underline lt-block lt-py-1 lt-px-2">
            {{ $value }}
        </a>
    @else
        {{ $value }}
    @endif
</div>
