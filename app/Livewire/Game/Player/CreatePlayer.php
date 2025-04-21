<?php

namespace App\Livewire\Game\Player;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Mary\Traits\Toast;

use App\Models\Game\{Player, PlayerCharacter};
use App\Repositories\CharacterRepository;
use App\Traits\LoadsPlayerFromSession;

class CreatePlayer extends Component
{
    use Toast;
    use LoadsPlayerFromSession;

    public String $nickname = '';

    public function createPlayer(CharacterRepository $characterRepository)
    {
        $this->validate([
            'nickname' => 'required|unique:players,nickname',
        ], [
            'unique' => 'O nome :input já está sendo utilizado.',
        ]);

        $player = DB::transaction(function () use ($characterRepository) {
            $player = Player::create([
                'nickname' => $this->nickname,
                'user_id' => auth()->user()->id,
            ]);

            $characters = $characterRepository->all()->take(2);
            foreach ($characters as $character) {
                PlayerCharacter::create([
                    'player_id' => $player->id,
                    'coid' => $character->id, 
                ]);
            }

            return $player;
        });
        $this->updatePlayerInSession($player->fresh(), true);
        $this->dispatch('playerUpdated');

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
