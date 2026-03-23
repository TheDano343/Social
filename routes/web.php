<?php

use Illuminate\Support\Facades\Route; 

Route::middleware(['auth'])->group(function()
{
    Route::livewire('/publicacion','pages::modulos.social.publicacion');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
