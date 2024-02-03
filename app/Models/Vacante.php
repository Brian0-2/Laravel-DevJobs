<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    public $casts = [
        'ultimo_dia' => 'date',
    ];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function categoria(){
        return $this -> belongsTo(Categoria::class);
    }

    public function salario(){
        return $this -> belongsTo(Salario::class);
    }

    public function candidatos(){
        return $this->hasMany(Candidato::class) -> orderBy('created_at','DESC');
    }

    public function reclutador(){
        // esta relacion es para la persona que publico la vacante
        return $this ->belongsTo(User::class,'user_id');
    }

}
