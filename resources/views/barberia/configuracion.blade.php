<x-app-layout>
<x-guest-layout>
    <h2 class="text-xl font-bold mb-4">Configuración de horarios</h2>

    @if(session('success'))
        <div class="text-green-600 mb-3">{{ session('success') }}</div>
    @endif


    
    <form method="POST" action="{{ route('barberia.configuracion.update') }}">
        @csrf

        <div>
            <label>Hora de apertura</label>
            <input type="time" name="hora_apertura" value="{{ $barberia->hora_apertura }}">
        </div>

        <div class="mt-4">
            <label>Hora de cierre</label>
            <input type="time" name="hora_cierre" value="{{ $barberia->hora_cierre }}">
        </div>

        <div class="mt-4">
            <label>Duración del turno (minutos)</label>
            <input type="number" name="duracion_turno" value="{{ $barberia->duracion_turno }}">
        </div>

         <x-primary-button class="ms-3 mt-4 w-40">
                {{ __('Guardar') }}
            </x-primary-button>
    </form>
</x-guest-layout>
</x-app-layout>