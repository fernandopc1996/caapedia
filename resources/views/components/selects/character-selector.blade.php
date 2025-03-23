@props([
    'characters' => [],
    'model' => null,
    'buttonLabel' => 'Selecionar',
    'buttonClass' => 'bg-blue-600 hover:bg-blue-700'
])

@php
    $modelName = $attributes->wire('model')->value();
@endphp

<div
    x-data="{
        characters: @js($characters),
        index: 0,
        get current() {
            return this.characters[this.index];
        },
        prev() {
            if (this.index > 0) this.index--;
        },
        next() {
            if (this.index < this.characters.length - 1) this.index++;
        },
        submit() {
            if (this.characters.length > 0) {
                @this.set('{{ $modelName }}', this.current.id);
            }
        }
    }"
    class="flex flex-col items-center gap-0 w-full"
>
    {{-- Select group --}}
    <div class="flex items-center justify-center w-full max-w-xs">
        {{-- Left arrow --}}
        <button
            type="button"
            @click="prev"
            class="w-20 h-12 text-xl border border-black rounded-tl-md bg-transparent hover:bg-gray-100 transition active:scale-95 flex items-center justify-center"
            :disabled="index === 0"
        >
            &#8592;
        </button>

        {{-- Select --}}
        <select
            x-model="index"
            class="h-12 appearance-none px-3 py-0 text-lg border-y border-black bg-transparent focus:outline-none focus:ring-2 focus:ring-black text-gray-900 w-full"
        >
            <template x-for="(character, i) in characters" :key="character.id">
                <option :value="i" x-text="character.name" class="text-black"></option>
            </template>
        </select>

        {{-- Right arrow --}}
        <button
            type="button"
            @click="next"
            class="w-20 h-12 text-xl border border-black rounded-tr-md bg-transparent hover:bg-gray-100 transition active:scale-95 flex items-center justify-center"
            :disabled="index === characters.length - 1"
        >
            &#8594;
        </button>
    </div>

    {{-- Action button --}}
    <button
        type="button"
        @click="submit"
        class="w-full max-w-xs h-12 text-lg border border-black border-t-0 rounded-b-md bg-transparent text-black hover:bg-gray-100 transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
        x-bind:disabled="characters.length === 0"
        wire:loading.attr="disabled"
    >
        <span wire:loading.remove>{{ $buttonLabel }}</span>
        <span wire:loading class="animate-pulse">Aguarde...</span>
    </button>
</div>
