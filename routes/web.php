<?php

use Illuminate\Support\Facades\Route; 

Route::middleware(['auth'])->group(function()
{
    Route::livewire('/','pages::modulos.social.publicacion');
    Route::livewire('/perfil','pages::modulos.social.perfil')->name('perfil');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
