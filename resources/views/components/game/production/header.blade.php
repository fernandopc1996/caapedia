@props(['title', 'image', 'description', 'source'])

<div class="text-gray-900">
    <x-layout.header :title="$title" />
    <div class="flex items-start gap-4 mb-4">
        <img src="{{ asset($image) }}" alt="{{ $title }}"
            class="w-24 h-24 object-cover rounded-lg border border-gray-700">
        <div class="flex-1">
            <p class="text-sm text-gray-800 mb-2">{{ $description }}</p>
            <a href="{{ $source }}" target="_blank"
                class="text-white bg-black px-3 py-1 rounded text-sm inline-block font-semibold">
                Clique aqui para detalhes
            </a>
        </div>
    </div>
</div>
