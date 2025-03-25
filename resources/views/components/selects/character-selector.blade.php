@props([
    'characters' => [],
    'model' => null,
    'buttonLabel' => 'Selecionar',
    'buttonClass' => 'bg-blue-600 hover:bg-blue-700',
    'onSubmit' => null
])

@php
    $modelName = $attributes->wire('model')->value();
    $modelId = Str::slug($modelName, '_') . '_value'; // identificador do hidden input
@endphp

<div
    x-data="{
        characters: @js($characters),
        index: 0,
        get current() {
            return this.characters[this.index] || null;
        },
        get hasPrev() {
            return this.index > 0;
        },
        get hasNext() {
            return this.index < this.characters.length - 1;
        },
        prev() {
            if (this.hasPrev) this.index--;
        },
        next() {
            if (this.hasNext) this.index++;
        },
        updateModel() {
            const hidden = document.getElementById('{{ $modelId }}');
            if (this.current && hidden) {
                hidden.value = this.current.id;
                hidden.dispatchEvent(new Event('input'));
            }
        }
    }"
    class="flex flex-col items-center gap-0 w-full"
>
    {{-- Hidden input para atualizar o model via Alpine --}}
    <input type="hidden" wire:model="{{ $modelName }}" id="{{ $modelId }}">

    {{-- Navegação --}}
    <div class="flex items-center justify-center w-full max-w-xs">
        <button
            type="button"
            @click="prev"
            class="w-20 h-14 text-xl border border-black rounded-tl-md bg-transparent hover:bg-gray-100 transition active:scale-95 flex items-center justify-center"
            :disabled="!hasPrev || characters.length === 0"
            :class="(!hasPrev || characters.length === 0) ? 'opacity-50 cursor-not-allowed' : ''"
            >
            &#8592;
        </button>

        <div class="flex items-center gap-3 px-3 py-0 h-14 border-y border-black bg-transparent w-full justify-start overflow-hidden">
            <template x-if="current">
                <div class="flex items-center gap-2">
                    <img :src="current.front_square || 'https://via.placeholder.com/32'" alt="Imagem" class="h-14 object-cover" />
                    <span class="text-lg text-black font-medium truncate" x-text="current.name"></span>
                </div>
            </template>
            <template x-if="!current">
                <span class="text-sm text-gray-500">Ninguém disponível</span>
            </template>
        </div>

        <button
            type="button"
            @click="next"
            class="w-20 h-14 text-xl border border-black rounded-tr-md bg-transparent hover:bg-gray-100 transition active:scale-95 flex items-center justify-center"
            :disabled="!hasNext || characters.length === 0"
            :class="(!hasNext || characters.length === 0) ? 'opacity-50 cursor-not-allowed' : ''"
            >
            &#8594;
        </button>
    </div>

    {{-- Botão principal com wire:click --}}
    <button
        type="button"
        @click="updateModel()"
        wire:click="characterSeletorAction"
        class="w-full max-w-xs h-14 text-lg border border-black border-t-0 rounded-b-md bg-transparent text-black hover:bg-gray-100 transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
        :disabled="characters.length === 0"
        wire:loading.attr="disabled"
    >
        <span wire:loading.remove>{{ $buttonLabel }}</span>
        <span wire:loading class="animate-pulse">Aguarde...</span>
    </button>
</div>
