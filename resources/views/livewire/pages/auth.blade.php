<?php

use App\Livewire\Forms\LoginForm;
use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function Livewire\Volt\{form, layout, mount, state};

layout('layouts.guest');

mount(function () {
    SEOTools::setTitle('احراز هویت');
});

form(RegisterForm::class, 'registerForm');
form(LoginForm::class, 'loginForm');

state([
    'selectedTab' => fn() => 'register'
])->url('tab');

$register = function () {
    $this->registerForm->validate();
    $user = User::create($this->registerForm->only('name', 'email', 'password'));
    Auth::login($user);
    session()->regenerate();
    $this->redirectRoute('index', navigate: true);
};

$login = function () {
    $this->loginForm->validate();
    if (!Auth::attempt($this->loginForm->only('email', 'password'), $this->loginForm->remember)) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed')
        ]);
    }
    session()->regenerate();
    $this->redirectRoute('index', navigate: true);
};
?>

<div>
    <x-tabs wire:model="selectedTab"
            label-div-class="bg-base-200 rounded-lg p-3 space-x-1 font-bold"
            active-class="bg-primary rounded-md text-white"
            label-class="" tabs-class="flex flex-col justify-center items-center">
        <x-tab name="register" :label="__('pages.auth.register')">
            <x-card class="bg-base-200">
                <x-form wire:submit="register">
                    <x-input icon-right="o-user" wire:model.blur="registerForm.name" inline first-error-only type="text"
                             :label="__('validation.attributes.name')"/>
                    <x-input icon-right="o-at-symbol" wire:model.blur="registerForm.email" inline first-error-only
                             type="email" :label="__('validation.attributes.email')"/>
                    <x-input icon-right="o-lock-closed" wire:model.blur="registerForm.password" inline first-error-only
                             type="password" :label="__('validation.attributes.password')"/>
                    <x-input icon-right="o-check" wire:model.blur="registerForm.password_confirmation" inline
                             first-error-only type="password"
                             :label="__('validation.attributes.password_confirmation')"/>
                    <x-button type="submit" class="bg-base-300 btn-ghost mt-4"
                              :label="__('pages.auth.create-account')"/>
                </x-form>
            </x-card>
        </x-tab>
        <x-tab name="login" :label="__('pages.auth.login')">
            <x-card class="bg-base-200">
                <x-form wire:submit="login">
                    <x-input icon-right="o-at-symbol" wire:model.blur="loginForm.email" inline first-error-only
                             type="email" :label="__('validation.attributes.email')"/>
                    <x-input icon-right="o-lock-closed" wire:model.blur="loginForm.password" inline first-error-only
                             type="password" :label="__('validation.attributes.password')"/>
                    <x-checkbox wire:model="loginForm.remember" class="my-4"
                                :label="__('validation.attributes.remember')"/>
                    <x-button type="submit" class="bg-base-300 btn-ghost"
                              :label="__('pages.auth.login-account')"/>
                </x-form>
            </x-card>
        </x-tab>
    </x-tabs>
</div>
