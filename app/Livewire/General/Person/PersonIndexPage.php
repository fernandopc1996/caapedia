<?php

namespace App\Livewire\General\Person;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination; 

use App\Models\General\Character;

class PersonIndexPage extends Component{
    use WithPagination; 

    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Nice Name'],
    ];

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public ?string $search = null;

    public int $perPage = 1;

    #[Title('Personagens')] 



    public function characters(){
        return Character::query()
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->orderBy(...array_values($this->sortBy))
            ->paginate($this->perPage); 
    }

    public function updated($property): void{
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    public function render(){
        $characters = $this->characters();
        return view('livewire.general.person.person-index-page', compact('characters'));
    }
}
