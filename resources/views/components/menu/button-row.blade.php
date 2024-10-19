<div>
    @php
        $isActive = url()->current() === $attributes->get('href');
    @endphp
    <a  @if($isActive) 
            class="w-full flex flex-col items-center justify-center px-5 py-2 rounded-lg shadow-lg bg-gray-200/80 cursor-default pointer-events-none"
        @else 
            {{ $attributes->merge(['href' => '#']) }} class="w-full flex flex-col items-center active:scale-90 duration-300 justify-center group px-5 py-2 rounded-lg shadow-lg bg-gray-200/10 hover:bg-gray-100/10 hover:scale-105"
        @endif
    >
       <x-mary-icon name="{{$icon}}" class="h-10"/>
        <span class="text-xs font-semibold text-gray-900">{{ $title }}</span>
    </a>
</div>