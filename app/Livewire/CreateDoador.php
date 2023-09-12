<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Doador;

class CreateDoador extends Component
{
    public $isDonation = true;


    public function render()
    {
        return view('livewire.create-doador');
    }

}

