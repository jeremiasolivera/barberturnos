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
