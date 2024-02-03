<?php

namespace App\Livewire;

use App\Models\Vacante;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class MostrarVacantes extends Component
{
    #[On('eliminarVacante')]

    public function eliminarVacante(Vacante $vacante) {

        //Verificar que el dueño de la vacante lo puede eliminar
        $this -> authorize('delete', $vacante);

        // borrar imagen del servidor con el nombre de la imagen
        if( $vacante->imagen ) {
            Storage::delete('public/vacantes/' . $vacante->imagen);
        }

        // if( $vacante->candidatos->count() ) {
        //     foreach( $vacante->candidatos as $candidato ) {
        //         if( $candidato->cv ) {
        //             Storage::delete('public/cv/' . $candidato->cv);
        //         }
        //     }
        // }

        $vacante->delete();
        // return redirect(request()->header('Referer'));

        // $vacante -> delete();
    }
    public function render()
    {

    $vacantes = Vacante::where('user_id', auth() -> user() -> id) -> paginate(10);

        return view('livewire.mostrar-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
