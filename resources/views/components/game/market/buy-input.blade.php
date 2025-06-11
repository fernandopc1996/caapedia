<div x-data="{
    quantity: 0,
    unit_value: {{ $product->unit_value }},
    max: Math.floor({{ $player->amount }} / {{ $product->unit_value }}),
    buying: false,
    increment(delta) {
        let newQty = this.quantity + delta;
        this.quantity = Math.max(0, Math.min(newQty, this.max));
    },
    setTo(value) {
        this.quantity = Math.max(0, Math.min(value, this.max));
    },
    async buyNow() {
        if (this.quantity <= 0 || this.buying) return;
        this.buying = true;
        @this.call('buy', {{ $product->id }}, this.quantity).then(() => {
            this.buying = false;
        });
    }
}" class="w-full flex flex-col items-stretch">

    
    <div class="flex w-full">
        <button type="button" @click="setTo(0)"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border border-black rounded-l hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <b>0</b>
        </button>
        <button type="button" @click="increment(-10)" :disabled="quantity <= 0"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <x-mary-icon name="fas.angles-left" />
        </button>
        <button type="button" @click="increment(-1)" :disabled="quantity <= 0"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <x-mary-icon name="fas.angle-left" />
        </button>
        <input type="number" x-model.number="quantity" min="0" :max="max"
            class="w-20 h-10 text-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 transition duration-100"
            @input="if(quantity < 0){ quantity = 0 } else if(quantity > max){ quantity = max }" />
        <button type="button" @click="increment(1)" :disabled="quantity >= max"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <x-mary-icon name="fas.angle-right" />
        </button>
        <button type="button" @click="increment(10)" :disabled="quantity >= max"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <x-mary-icon name="fas.angles-right" />
        </button>
        <button type="button" @click="setTo(max)"
            class="flex-1 h-10 flex items-center justify-center bg-transparent border border-black rounded-r border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <x-mary-icon name="fas.arrow-up" />
        </button>
    </div>

    
    <button type="button" @click="buyNow" :disabled="quantity <= 0 || buying"
        class="h-10 w-full mt-0 border-t-0 border border-black rounded-b font-bold flex items-center justify-center bg-transparent hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        <span x-show="!buying" x-text="'Comprar por R$ ' + (quantity * unit_value).toFixed(2).replace('.', ',')"></span>
        <span x-show="buying">Processando...</span>
    </button>
</div>
