@props(['disabled' => false])

<button
    x-data="{ clicked: false }"
    x-bind:disabled="clicked || {{ $disabled ? 'true' : 'false' }}"
    x-on:click="clicked = true"
    x-bind:class="(clicked || {{ $disabled ? 'true' : 'false' }})
        ? 'border rounded shadow flex items-center p-2 space-x-3 min-h-20 disabled:opacity-50 disabled:cursor-not-allowed'
        : 'border rounded shadow hover:bg-gray-200/80 transition duration-300 ease-in-out flex items-center p-2 space-x-3 min-h-20 hover:scale-105 hover:cursor-pointer active:scale-95'"
    {{ $attributes }}
>
    {{ $slot }}
</button>
