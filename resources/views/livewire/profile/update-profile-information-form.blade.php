<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
        $this->success('Perfil atualizado!');
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function logout(): void
    {
        Session::flush();
        Auth::logout();
        $this->redirectRoute('login');
    }
};
?>

<section>
    <x-mary-header 
        title="{{ __('Profile Information') }}"
        subtitle="{{ __('Update your account\'s profile information and email address.') }}" 
        separator
    >
        <x-slot:actions>
            <x-mary-button 
                icon="fas.door-open" 
                class="btn-primary btn-outline" 
                label="Sair"
                wire:click="logout"
            />
        </x-slot:actions>
    </x-mary-header>

    @if ($errors->has('google'))
        <div class="my-4 p-4 border-l-4 border-red-500 bg-red-100 rounded-md flex items-start gap-4 shadow">
            <x-mary-icon name="fas.exclamation-circle" class="w-6 h-6 text-red-600 mt-1" />
            <div class="flex-1">
                <h4 class="text-red-800 font-semibold mb-1">Erro na vinculação do Google</h4>
                <p class="text-sm text-red-800">
                    {{ $errors->first('google') }}
                </p>
            </div>
        </div>
    @endif

    @if (is_null(Auth::user()->google_email))
    <div class="my-6 p-4 border-l-4 border-yellow-500 bg-yellow-100 rounded-md flex items-start gap-4 shadow">
        <x-mary-icon name="fas.exclamation-triangle" class="w-6 h-6 text-yellow-600 mt-1" />
        <div class="flex-1">
            <h4 class="text-yellow-800 font-semibold mb-1">Conta não vinculada</h4>
            <p class="text-sm text-yellow-800">
                Seu progresso está sendo armazenado apenas nesta sessão temporária do navegador.
                Isso significa que você <strong>perderá todo seu progresso</strong> se:
            </p>
            <ul class="list-disc list-inside text-sm text-yellow-800 mt-1 space-y-1">
                <li>A sessão expirar por inatividade ou problema de rede</li>
                <li>Mudar de dispositivo ou navegador</li>
                <li>Limpar os dados de navegação</li>
                <li>Entre outros</li>
            </ul>
            <p class="text-sm text-yellow-800 mt-3">
                <strong>Recomendamos fortemente vincular sua conta ao Google</strong> para garantir que seu progresso seja salvo com segurança.
            </p>
        </div>
        <x-mary-button 
            label="Vincular agora" 
            icon="fab.google" 
            link="{{ route('google.redirect') }}" 
            no-wire-navigate 
            class="btn-warning"
        />
    </div>
    @endif


    <x-mary-form wire:submit="updateProfileInformation">
        <div>
            <x-mary-input label="{{ __('Name') }}" wire:model="name" required autofocus />
        </div>

        <div>
            <x-mary-input label="{{ __('Email') }}" wire:model="email" readonly />
        </div>

        <div>
            <x-mary-button label="{{ __('Save') }}" class="btn-primary" type="submit" spinner="save" />
        </div>
    </x-mary-form>

    {{-- Vinculações --}}
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2 text-gray-800">Contas vinculadas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Google --}}
            <div class="flex items-center justify-between p-4 border rounded-lg shadow-sm">
                <div class="flex items-center gap-2">
                    <x-mary-icon name="fab.google" class="w-5 h-5 text-blue-800" />
                    <span class="font-medium">Google</span>
                </div>
                @if (is_null(Auth::user()->google_email))
                    <x-mary-button 
                        label="Vincular" 
                        icon="fab.google" 
                        link="{{ route('google.redirect') }}" 
                        no-wire-navigate 
                        class="btn-info"
                    />
                @else
                    <span class="text-sm text-green-800 font-semibold">Vinculado</span>
                @endif
            </div>

            {{-- Aqui você pode adicionar futuras vinculações como Facebook, GitHub etc. --}}
            {{-- Exemplo:
            <div class="flex items-center justify-between p-4 border rounded-lg shadow-sm bg-white">
                <div class="flex items-center gap-2">
                    <x-mary-icon name="fab.github" class="w-5 h-5 text-gray-800" />
                    <span class="font-medium">GitHub</span>
                </div>
                <x-mary-button 
                    label="Vincular" 
                    icon="fab.github" 
                    link="#"
                    class="btn-dark"
                />
            </div>
            --}}

        </div>
    </div>
</section>