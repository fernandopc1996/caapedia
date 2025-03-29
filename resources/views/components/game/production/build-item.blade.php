@props(['icon', 'label', 'value', 'color'])

<div class="flex flex-row md:inline-flex md:flex-col gap-1 sm:gap-0">
    <div class="flex items-center gap-2">
        <x-mary-icon :name="$icon" class="h-5 text-{{ $color }}" :title="$label" />
        <strong>{{ $label }}:</strong>
    </div>
    <span class="sm:ml-7">{{ $value }}</span>
</div>