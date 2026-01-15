<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Servicio extends Model
{
    use HasFactory;


    protected $fillable = [
        'barberia_id',
        'nombre',
        'duracion_minutos',
        'precio',
        'activo'
    ];


    public function barberia(){
        return $this->BelongsTo(Barberia::class);
    }

    public function turnos(){
        return $this->hasMany(Turno::class);
    }
}
