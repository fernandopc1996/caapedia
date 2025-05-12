<div class="mt-6">
    <h2 class="text-3xl font-bold mb-4">Água (m³)</h2>

    <div x-data="{
        quantity: @entangle('quantity'),
        unit_value: {{ $unitPrice }},
        max: {{ $maxQuantity }},
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
            &lt;&lt;
        </button>

        <button type="button" 
                @click="increment(-1)" 
                :disabled="quantity <= 0" 
                class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            &lt;
        </button>

        <input type="number"
               x-model.number="quantity"
               min="0"
               :max="max"
               class="h-10 text-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100"
               @input="if(quantity < 0){ quantity = 0 } else if(quantity > max){ quantity = max }" />

        <button type="button" 
                @click="increment(1)" 
                :disabled="quantity >= max" 
                class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            &gt;
        </button>

        <button type="button" 
                @click="increment(10)" 
                :disabled="quantity >= max" 
                class="w-10 h-10 flex items-center justify-center bg-transparent border-t border-b border-r border-black border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            &gt;&gt;
        </button>

        <button type="button" 
                wire:click="buyWater" 
                :disabled="quantity <= 0" 
                class="h-10 px-5 font-bold flex items-center justify-center bg-transparent border border-black rounded-r border-l-0 hover:bg-gray-200/80 active:scale-95 transition-transform duration-100">
            <span x-text="'Comprar por R$ ' + (quantity * unit_value).toFixed(2).replace('.', ',')"></span>
        </button>
    </div>
</div>
