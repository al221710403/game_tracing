<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RenpyController extends Component
{
    public function render()
    {
        return view('livewire.renpy')->extends('layouts.app')
            ->section('content');
    }
}
