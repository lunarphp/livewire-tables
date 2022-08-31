<div
    x-data="{
        open: false
    }"
    class="relative"
>
    <button
        @click="open = !open"
        type="button"
        class="text-gray-400"
        :class="{
            'text-gray-400': !open,
            'text-blue-600': open,
        }"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
        </svg>
    </button>

    <div class="absolute bg-white shadow left-0 rounded overflow-hidden" :class="{
        'hidden' : !open
    }">
        @foreach($this->actions as $actionIndex => $action)
            @php
                $action = $action->record($record)
            @endphp
            {{ $action }}
        @endforeach
    </div>
</div>
