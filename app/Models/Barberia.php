<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class Barberia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'activo',
        'hora_apertura',
        'hora_cierre',
        'duracion_turno'
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

    public function generarHorarios(): array
    {
        $inicio = Carbon::createFromTimeString($this->hora_apertura);
        $fin    = Carbon::createFromTimeString($this->hora_cierre);

        $periodo = CarbonPeriod::create(
            $inicio,
            "{$this->duracion_turno} minutes",
            $fin->subMinutes($this->duracion_turno)
        );

        $horarios = [];

        foreach ($periodo as $hora) {
            $horarios[] = $hora->format('H:i');
        }

        return $horarios;
    }
}
