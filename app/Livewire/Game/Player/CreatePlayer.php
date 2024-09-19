<?php

namespace App\Livewire\Game\Player;

use Livewire\Component;

use App\Models\Game\Player;

use Mary\Traits\Toast;


class CreatePlayer extends Component
{
    use Toast;

    public String $nickname = '';

    public function createPlayer(){

        $this->validate([
            'nickname' => 'required|unique:players,nickname',
        ], [
            'unique' => 'O nome :input já está sendo utilizado.',
        ]);
        Player::create(['nickname' => $this->nickname, 'user_id' => auth()->user()->id]);
        
        $this->success(
            'Seu personagem foi criado com sucesso',
            redirectTo: route('dashboard'),
        );
    }

    public function render()
    {
        return view('livewire.game.player.create-player');
    }
}
