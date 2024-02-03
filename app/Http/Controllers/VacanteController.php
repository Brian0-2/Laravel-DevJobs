<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //Le paso el modelo de Vacante poque ahi viene el usuario
        // Prevengo que el reclutador autenticado pueda ver sus vacantes
        $this -> authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this -> authorize('create', Vacante::class);
       return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante_id)
    {
        return view('vacantes.show',[
            'vacante' => $vacante_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante_id)
    {

        //Policy para en el metodo de actualizar
        //Verificamos que auth() -> user() -> id === $vacante -> id
        //Verificamos que el usuario autenticado sea el mismo que creo la vacante cuando edita
        $this -> authorize('update', $vacante_id);

        return view('vacantes.edit',[
            'vacante' => $vacante_id
        ]);
    }

}
