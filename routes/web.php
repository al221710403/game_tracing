<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RenpyController;
use Stichoza\GoogleTranslate\GoogleTranslate;

Route::get('renpy-traslate', RenpyController::class)->name('renpy.traslate');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/', function () {
//     $tr = new GoogleTranslate('es');
//     return $tr->translate('Hello World! Are you!');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
