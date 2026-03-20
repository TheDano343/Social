<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function()
{

    Route::get('/publicacion', function ()
    {
        return view('publicacion');
    });

    Route::get('/', function () 
    {
        return view('rol');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
