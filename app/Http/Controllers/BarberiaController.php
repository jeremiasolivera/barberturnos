<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarberiaController extends Controller
{
    public function edit()
    {
        $barberia = auth()->user()->barberia;

        return view('barberia.configuracion', compact('barberia'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hora_apertura'  => 'required|date_format:H:i',
            'hora_cierre'    => 'required|date_format:H:i|after:hora_apertura',
            'duracion_turno' => 'required|integer|min:10|max:120',
        ]);

        $barberia = auth()->user()->barberia;

        $barberia->update($request->only([
            'hora_apertura',
            'hora_cierre',
            'duracion_turno',
        ]));

        return back()->with('success', 'Configuración actualizada correctamente');
    }
}
