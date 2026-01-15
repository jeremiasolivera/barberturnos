<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barberia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'activo'
    ];

    public function servicios(){
        return $this->hasMany(Servicio::class);
    }

    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    public function turnos(){
        return $this->hasMany(Turno::class);
    }

    public function usuarios(){
        return $this->hasMany(User::class);
    }
}
