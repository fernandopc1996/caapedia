@props(['icon', 'title', 'href', 'disabled' => false, 'tag' => null])

@php
    use Illuminate\Support\Str;

    $currentUrl = url()->current();

    $normalizedHref = rtrim($href, '/');
    $normalizedCurrent = rtrim($currentUrl, '/');

    $isInSection = Str::startsWith($normalizedCurrent, $normalizedHref);
    $isExactMatch = $normalizedCurrent === $normalizedHref;

    $baseClasses = 'relative w-full flex flex-col items-center justify-center px-5 py-2 rounded-lg shadow-lg';
    $activeClasses = 'bg-gray-200/80';
    $inactiveClasses = 'bg-gray-200/10 hover:bg-gray-100/10 hover:scale-105 active:scale-90 duration-300 group';
    $disabledClasses = 'opacity-10 cursor-default pointer-events-none';

    $finalClasses = $baseClasses;

    if ($disabled) {
        $finalClasses .= " {$activeClasses} {$disabledClasses}";
    } elseif ($isInSection) {
        $finalClasses .= " {$activeClasses}";
    } else {
        $finalClasses .= " {$inactiveClasses}";
    }
@endphp

<a
    x-data="{ clicked: false }"
    href="{{ $href }}"
    :class="clicked ? '{{ $activeClasses }} {{ $disabled ? $disabledClasses : '' }}' : ''"
    class="{{ $finalClasses }}"
    x-bind:disabled="clicked || {{ $disabled ? 'true' : 'false' }}"
    x-on:click="clicked = true"
    wire:navigate
>
    @if ($tag)
        <div class="absolute top-0.5 right-0.5 bg-gray-700 text-white text-[9px] font-semibold px-1 rounded">
            {{ $tag }}
        </div>
    @endif

    <x-mary-icon name="{{ $icon }}" class="h-10" />
    <span class="text-xs font-semibold text-gray-900">{{ $title }}</span>
</a>