<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'barberia_id',
        'servicio_id',
        'fecha',
        'hora',
        'nombre_cliente',
        'contacto_cliente',
        'estado',
        'activo'
    ];

    public function barberia(){
        return $this->belongsTo(Barberia::class);
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
