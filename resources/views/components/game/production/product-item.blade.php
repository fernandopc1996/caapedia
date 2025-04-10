@props(['product', 'qnt'])

<div class="p-2 flex items-center rounded shadow gap-2 bg-gray-200/80">
    @if(isset($qnt))
    <div class="font-bold text-gray-900">{{$qnt}}x </div>
    @endif
    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="h-6 object-cover rounded">
    <div class="font-bold text-gray-900">{{ $product->name }}</div>
</div>
