<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public bool $confirmModel = false;
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>
<div>
    <x-mary-card title="{{ __('Delete Account') }}" subtitle="{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}" shadow separator>
        <x-mary-button
        class="btn-error"
        x-data=""
        @click="$wire.confirmModel = true"
    >{{ __('Delete Account') }}</x-danger-button>
    </x-mary-card>

    <x-mary-modal wire:model="confirmModel" title="{{ __('Are you sure you want to delete your account?') }}">
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>
        </div>
        <x-mary-form wire:submit="deleteUser">
            <div class="mt-6">
                <x-mary-input
                    label="{{ __('Password') }}"
                    wire:model="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    required
                />
            </div>
            <x-slot:actions>
                <x-mary-button label="{{ __('Cancel') }}" @click="$wire.confirmModel = false" />
                <x-mary-button label="{{ __('Delete Account') }}" class="btn-error" type="submit" spinner="save"/>
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>



    

