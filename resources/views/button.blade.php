@props([
    'size' => 'default',
    'theme' => 'default',
])

<button
        {{ $attributes->merge([
                'class' => 'button',
            ])->class([
                'px-3 py-2 text-sm' => $size == 'default',
                'px-3 py-2 text-xs' => $size == 'sm',
                'px-2.5 py-2 text-xs' => $size == 'xs',
                'button-gray' => $theme == 'default',
                'button-success' => $theme == 'success',
                'button-primary' => $theme == 'primary',
                'button-danger' => $theme == 'danger',
            ]) }}>
    {{ $slot }}
</button>
