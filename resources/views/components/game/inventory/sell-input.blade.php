<div x-data="{
    quantity: 0,
    max: {{ $product->balance }},
    increment(delta) {
        let newQty = this.quantity + delta;
        if(newQty < 0) {
            this.quantity = 0;
        } else if(newQty > this.max) {
            this.quantity = this.max;
        } else {
            this.quantity = newQty;
        }
    }
}" class="inline-flex">
    <button type="button" 
            @click="increment(-10)" 
            :disabled="quantity <= 0" 
            class="w-10 h-10 flex items-center justify-center bg-transparent border border-black rounded-l hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        <<
    </button>
    <button type="button" 
            @click="increment(-1)" 
            :disabled="quantity <= 0" 
            class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        <
    </button>
    <input type="number"
           x-model.number="quantity"
           min="0"
           :max="max"
           class="w-16 h-10 text-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100"
           @input="if(quantity < 0){ quantity = 0 } else if(quantity > max){ quantity = max }" />
    <button type="button" 
            @click="increment(1)" 
            :disabled="quantity >= max" 
            class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        >
    </button>
    <button type="button" 
            @click="increment(10)" 
            :disabled="quantity >= max" 
            class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        >>
    </button>
    <button type="button" 
            wire:click="sell({{ $product->coid }}, quantity)" 
            :disabled="quantity <= 0" 
            class="w-10 h-10 flex items-center justify-center bg-transparent border border-black rounded-r border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
        Vender
    </button>
</div>
