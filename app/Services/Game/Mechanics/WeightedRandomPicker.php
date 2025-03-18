<?php

namespace App\Services\Game\Mechanics;

class WeightedRandomPicker {
    private array $items;
    private array $weights;
    private float $totalWeight;

    public function __construct(array $itemsWithWeights) {
        $this->items = array_keys($itemsWithWeights);
        $this->weights = array_values($itemsWithWeights);
        $this->totalWeight = array_sum($this->weights);
    }

    public function pick(): mixed {
        $random = mt_rand(1, (int) ($this->totalWeight * 1000)) / 1000;
        $cumulativeWeight = 0;
		echo $random." ";
        foreach ($this->items as $index => $item) {
            $cumulativeWeight += $this->weights[$index];
            if ($random <= $cumulativeWeight) {
                return $item;
            }
        }
        
        return end($this->items);
    }
}
/* 
// Exemplo de uso:
$picker = new WeightedRandomPicker([
    'Item A' => 30, // 30%
    'Item B' => 68, // 50%
    'Item C' => 2  // 20%
]);

// Testando várias chamadas
for ($i = 0; $i < 10; $i++) {
    echo $picker->pick() . "\n";
}
*/