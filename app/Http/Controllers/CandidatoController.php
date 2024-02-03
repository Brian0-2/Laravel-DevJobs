<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Vacante;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Vacante $vacante)
    {
        return view('candidatos.index',[
            'vacante' => $vacante
        ]);
    }
}
