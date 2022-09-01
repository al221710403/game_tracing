<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RenpyController;
use App\Http\Livewire\GameIndexController;
use App\Http\Livewire\VersionShowController;

Route::get('renpy-traslate', RenpyController::class)->name('renpy.traslate');

Route::redirect('/', '/version');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/version', GameIndexController::class)->name('version');
    Route::get('/version-game/{id}', VersionShowController::class)->name('version.show.game');
});
