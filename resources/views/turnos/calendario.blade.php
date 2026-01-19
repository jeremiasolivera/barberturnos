<x-app-layout>

<div class="flex align-middle gap-10 mt-4"> 
    <h1 class="text-xl font-bold mb-4 mt-4">
    Calendario del día {{ $fecha->format('d/m/Y') }}
    </h1>

    <form method="GET" class="mb-4">
        <input
            type="date"
            name="fecha"
            value="{{ $fecha->toDateString() }}"
            class="border p-2"
        >
        <button class="ml-2 px-3 py-2 bg-blue-600 text-white rounded">
            Ver
        </button>
    </form>
</div>


<div class="max-w-4xl mx-auto px-4">
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 text-center">

        @foreach ($horarios as $horaStr)
            @php
                $turno = $turnos->get($horaStr);
            @endphp

            <div class="p-2 border rounded-lg shadow-sm flex flex-col justify-center min-h-[80px] transition-all
                {{ $turno ? 'bg-red-100 border-red-300' : 'bg-green-100 border-green-300' }}">

                <strong class="text-sm md:text-base">{{ $horaStr }}</strong>

                @if ($turno)
                    <div class="text-[10px] md:text-xs leading-tight mt-1">
                        <span class="font-bold block truncate">
                            {{ $turno->nombre_cliente }}
                        </span>
                        <span class="text-gray-600">
                            {{ $turno->contacto_cliente }}
                        </span>
                    </div>
                @else
                    <div class="text-[10px] md:text-xs text-gray-500 italic mt-1">
                        Disponible
                    </div>
                @endif
            </div>
        @endforeach

    </div>
</div>

</x-app-layout>
