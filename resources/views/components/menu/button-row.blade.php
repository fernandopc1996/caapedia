@props(['icon', 'title', 'href'])

@php
    use Illuminate\Support\Str;

    $currentUrl = url()->current();

    $normalizedHref = rtrim($href, '/');
    $normalizedCurrent = rtrim($currentUrl, '/');

    $isInSection = Str::startsWith($normalizedCurrent, $normalizedHref);
    $isExactMatch = $normalizedCurrent === $normalizedHref;

    $baseClasses = 'w-full flex flex-col items-center justify-center px-5 py-2 rounded-lg shadow-lg';
    $activeClasses = 'bg-gray-200/80';
    $inactiveClasses = 'bg-gray-200/10 hover:bg-gray-100/10 hover:scale-105 active:scale-90 duration-300 group';
    $finalClasses = $baseClasses . ' ' . ($isInSection ? $activeClasses : $inactiveClasses);
    $isDisabled = $isExactMatch;
@endphp

<a
    x-data="{ clicked: false }"
    href="{{ $href }}"
    :class="clicked ? '{{ $activeClasses }} cursor-default pointer-events-none' : ''"
    class="{{ $finalClasses }} {{ $isDisabled ? 'cursor-default pointer-events-none' : '' }}"
    x-bind:disabled="clicked || {{ $isDisabled ? 'true' : 'false' }}"
    x-on:click="clicked = true"
>
    <x-mary-icon name="{{ $icon }}" class="h-10"/>
    <span class="text-xs font-semibold text-gray-900">{{ $title }}</span>
</a>
