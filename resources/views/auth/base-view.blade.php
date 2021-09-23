<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-button class="ml-4" onclick="window.location.href='/login'">
            {{ __('Log in') }}
        </x-jet-button>
        <x-jet-button class="ml-4" onclick="window.location.href='/register'">
            {{ __('Register') }}
        </x-jet-button>
        <x-jet-button class="ml-4" onclick="window.location.href='/forgot-password'">
            {{ __('Forgot pass') }}
        </x-jet-button>
    </x-jet-authentication-card>
</x-guest-layout>
