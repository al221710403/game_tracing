<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RenpyController extends Component
{
    public $traslate_source,$traslate_target;

    public function render()
    {
        return view('livewire.renpy')->extends('layouts.app')
            ->section('content');
    }

    public function traslate(){
        $tr = new GoogleTranslate('es');
        $this->traslate_target = $tr->translate($this->traslate_source);
    }
}
