<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $department = ''; // Tambahan: departemen

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Sign Up')" :description="__('Masukkan detail Anda di bawah ini untuk membuat akun')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nama')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nama lengkap')"
        />

        <!-- Email -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Konfirmasi Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Konfirmasi Password')"
        />

        <!-- Department -->
        <flux:input
            wire:model="department"
            :label="__('Departemen')"
            type="text"
            required
            autocomplete="organization"
            :placeholder="__('Nama Departemen')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" class="w-full" style="background-color: #23439C; color: white; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#1C357D'" onmouseout="this.style.backgroundColor='#23439C'">
                {{ __('Sign Up') }}
            {{-- <flux:button type="submit" class="w-full" style="background-color: #23439C; color: white; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#1C357D'" onmouseout="this.style.backgroundColor='#23439C'">
                {{ __('Sign Up') }} --}}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Sudah punya akun?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
