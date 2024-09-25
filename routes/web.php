<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
   Volt::route('/auth','pages.auth')->name('login');
});

Route::middleware('auth')->group(function () {
    Volt::route('/','pages.index')->name('index');
});
