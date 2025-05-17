@props(['mode' => 0, 'lastDatetime'])

@php
    use Illuminate\Support\Carbon;

    $animationClass = match ($mode) {
        1 => 'animate-clock-slow',
        2 => 'animate-clock-fast',
        default => 'animate-clock-paused animate-pulse-scale',
    };

    $datetime = Carbon::parse($lastDatetime);
    $hour = $datetime->hour % 12;
    $minute = $datetime->minute;

    $angle = ($hour * 30) + ($minute * 0.5); 
@endphp

<svg
    viewBox="0 0 100 100"
    class="w-8 h-8 {{ $animationClass }}"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
>
    <circle cx="50" cy="50" r="45" stroke="#000" stroke-width="5" />

    @for ($i = 0; $i < 12; $i++)
        @php
            $a = $i * 30;
            $x1 = 50 + 40 * cos(deg2rad($a - 90));
            $y1 = 50 + 40 * sin(deg2rad($a - 90));
            $x2 = 50 + 43 * cos(deg2rad($a - 90));
            $y2 = 50 + 43 * sin(deg2rad($a - 90));
        @endphp
        <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}" stroke="#000" stroke-width="2" />
    @endfor

    <line
        x1="50"
        y1="50"
        x2="50"
        y2="20"
        stroke="#ff0000"
        stroke-width="3"
        stroke-linecap="round"
        class="clock-hand"
        style="transform: rotate({{ $angle }}deg); transform-origin: center;"
    />
</svg>