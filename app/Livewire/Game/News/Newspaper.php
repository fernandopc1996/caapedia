<?php

namespace App\Livewire\Game\News;

use Livewire\Attributes\Title;
use Livewire\Component;

class Newspaper extends Component
{
    #[Title('Notícias')] 

    public function render()
    {
        return view('livewire.game.news.newspaper');
    }
}
