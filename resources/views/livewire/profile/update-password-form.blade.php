<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component
{
    use Toast;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
        $this->success("Senha atualizado!");
    }
}; ?>

<section>
    <x-mary-card title="{{ __('Update Password') }}" subtitle="{{ __('Ensure your account is using a long, random password to stay secure.') }}" shadow separator>
        <x-mary-form wire:submit="updatePassword">
            <div>
                <x-mary-input label="{{__('Current Password')}}" wire:model="current_password" type="password" required autofocus/>
            </div>
    
            <div>
                <x-mary-input label="{{__('New Password')}}" wire:model="password" type="password" required/>
            </div>
    
            <div>
                <x-mary-input label="{{__('Confirm Password')}}" wire:model="password_confirmation" type="password" required/>
            </div>
    
            <div >
                <x-mary-button label="{{ __('Save') }}" class="btn-primary" type="submit" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
</section>
