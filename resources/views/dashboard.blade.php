<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->barberia->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-bold mb-2">
                    Datos de la barbería:
                </h3>

                <p class="text-gray-600">
                    Teléfono: {{ auth()->user()->barberia->telefono ?? 'No definido' }}
                </p>

                <p class="text-gray-600">
                    Dirección: {{ auth()->user()->barberia->direccion ?? 'No definida' }}
                </p>
            </div>


            <div class="bg-white p-6 shadow rounded">
                <h4 class="font-semibold mb-4">Próximos turnos</h4>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(auth()->user()->barberia->turnos()->orderBy('fecha')->orderBy('hora')->get() as $turno)
                            <tr class="border-b">
                                <td>{{ $turno->fecha }}</td>
                                <td>{{ $turno->hora }}</td>
                                <td>{{ $turno->nombre_cliente }}</td>
                                <td>
                                    <span
                                    class="
                                    {{ $turno->estado === 'reservado' ? 'text-green-600' : 'text-gray-500' }}
                                ">
                                        {{ ucfirst(str_replace('_', ' ', $turno->estado)) }}
                                    </span></td>
                                <td>
                                    @if ($turno->estado === 'reservado')
                                        <form action="{{ route('turnos.cancelar', $turno) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-red-600">
                                                Cancelar turno
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">
                                    No hay turnos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <div class="bg-white p-6 shadow rounded">
                <h4 class="font-semibold mb-4">Próximos pasos</h4>

                <ul class="list-disc ml-6 text-gray-700 space-y-2">
                    <li>Gestionar turnos</li>
                    <li>Configurar horarios</li>
                    <li>Agregar servicios</li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
