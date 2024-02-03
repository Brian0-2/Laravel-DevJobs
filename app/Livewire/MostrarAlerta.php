<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{
    //Esta variable se encuentra en el componente de livewire y aqui la defino para poder utilizarla
    public $message;

    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
