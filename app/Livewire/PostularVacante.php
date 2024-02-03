<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        //Validar los datos del formulario
        $datos = $this->validate();

        //Almacenar el Cv
        //       *store es un metodo para guardar carpetas en una ruta
        //       *storage/app/public/
        //      *?Creamos la carpeta cv si existe lo gaurda si no la crea y lo guarda
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        //Crear candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        //Crear notificacion y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //Mostrar al usuario que se envio un mensaje de ok
        session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte!');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
