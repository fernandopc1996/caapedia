@props(['disabled' => false])
<button {{ $attributes->merge(['class' => "border rounded shadow hover:bg-gray-200/80 transition duration-300 ease-in-out flex items-center p-2 space-x-3 min-h-20 " . ($disabled ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105 active:scale-95')]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>