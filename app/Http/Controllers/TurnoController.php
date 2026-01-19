<?php

namespace App\Http\Controllers;

use App\Models\Barberia;
use Illuminate\Http\Request;
use App\Models\Turno;
use Carbon\Carbon;

class TurnoController extends Controller
{


    private function horariosBase()
    {
        return [
            '09:00', '09:30',
            '10:00', '10:30',
            '11:00', '11:30',
            '12:00', '12:30',
            '13:00', '13:30',
            '14:00', '14:30',
            '15:00', '15:30',
            '16:00', '16:30',
            '17:00', '17:30',
            '18:00',
        ];
    }


    



    public function create(Barberia $barberia)
    {
        return view('turnos.create', compact('barberia'));
    }



    public function store(Request $request, Barberia $barberia)
    {
        $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'contacto_cliente' => ['nullable', 'string', 'max:50'],
        ]);


        $fecha = Carbon::parse($request->fecha);
        $hoy = Carbon::today();

        if ($fecha->lt($hoy)) {
            return back()->withErrors([
                'fecha' => 'No se pueden reservar turnos en fechas pasadas.',
            ])->withInput();
        }

        if ($fecha->isToday()) {
            $horaTurno = Carbon::createFromTimeString($request->hora);
            $ahora = Carbon::now();

            if ($horaTurno->lt($ahora)) {
                return back()->withErrors([
                    'hora' => 'No se puede reservar un horario que ya pasó.',
                ])->withInput();
            }
        }


        $existeTurno = Turno::where('barberia_id', $barberia->id)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->where('activo', true)
        ->exists();

        if ($existeTurno) {
            return back()->withErrors([
                'hora' => 'Este horario ya ha sido reservado por otro cliente.',
            ])->withInput();
        }

        Turno::create([
            'barberia_id' => $barberia->id,
            'fecha' => $request->fecha,
            'estado' => 'reservado',
            'activo' => true,
            'hora' => $request->hora,
            'nombre_cliente' => $request->nombre_cliente,
            'contacto_cliente' => $request->contacto_cliente,
        ]);

        return redirect()->back()->with('success', 'Turno reservado correctamente');
    }

    public function horariosDisponibles(Request $request, Barberia $barberia)
    {
        $request->validate([
            'fecha' => ['required', 'date'],
        ]);

        $horariosBase = $this->horariosBase();

        $horariosOcupados = Turno::where('barberia_id', $barberia->id)
            ->where('fecha', $request->fecha)
            ->where('activo', true)
            ->pluck('hora')
            ->map(fn ($hora) => substr($hora, 0, 5))
            ->toArray();

        $horariosDisponibles = array_values(
            array_diff($horariosBase, $horariosOcupados)
        );

        return response()->json($horariosDisponibles);
    }

    public function cancelarPorPeluquero(Turno $turno)
    {
        $turno->update([
            'estado' => 'cancelado_peluquero',          
            'activo' => false,

        ]);

        return back()->with('success', 'Turno cancelado correctamente.');
    }


}
