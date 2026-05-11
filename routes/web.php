<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function()
{
    Route::livewire('/','pages::modulos.social.publicacion');
    Route::livewire('/perfil','pages::modulos.social.perfil')->name('perfil');

    Route::resource('user', UserController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
