<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Mary\Traits\Toast;

class ThemeUserForm extends Component
{
    use Toast;

    public $themes = [
        ['id' => 'light', 'name' => 'Claro'],
        ['id' => 'dark', 'name' => 'Escuro'],
        ['id' => 'cupcake', 'name' => 'Cupcake'],
        ['id' => 'retro', 'name' => 'Retro'],
        ['id' => 'valentine', 'name' => 'Namorados'],
        ['id' => 'forest', 'name' => 'Floresta'],
        ['id' => 'pastel', 'name' => 'Pastel'],
        ['id' => 'lemonade', 'name' => 'Limonada'],
        ['id' => 'night', 'name' => 'Noite'],
    ]; 

    #[Session]
    public $theme;

    public function save(){
        $user = auth()->user();
        $user->theme = $this->theme;
        $user->save();
        $this->success("Tema atualizado!");
        return redirect()->route('profile');
    }

    public function mount(){
        $this->theme = auth()->user()->theme ?? 'light';
    }

    public function render(){
        return view('livewire.profile.theme-user-form');
    }
}
