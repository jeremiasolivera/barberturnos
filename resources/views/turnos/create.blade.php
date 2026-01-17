<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar turno - {{ $barberia->nombre }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h1 class="text-xl font-bold mb-4 text-center">
            {{ $barberia->nombre }}
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST">
            @csrf

      

            <div class="mb-3">
                <label class="block text-sm font-medium">Fecha</label>
                <input type="date" name="fecha" min="{{ now()->toDateString() }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Hora</label>

                <select name="hora" id="hora"
                    class="w-full border rounded p-2"
                    required>
                    <option value="">Seleccioná una fecha primero</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre_cliente" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="text" name="contacto_cliente" class="w-full border rounded p-2">
            </div>

            <button class="w-full bg-blue-600 text-white py-2 rounded">
                Reservar turno
            </button>
        </form>
    </div>


    <script>
        const fechaInput = document.querySelector('input[name="fecha"]');
        const horaSelect = document.getElementById('hora');

        fechaInput.addEventListener('change', async function () {
            horaSelect.innerHTML = '<option>Cargando...</option>';

            const response = await fetch(
                `/barberias/{{ $barberia->id }}/horarios-disponibles?fecha=${this.value}`
            );

            const horarios = await response.json();

            horaSelect.innerHTML = '';

            if (horarios.length === 0) {
                horaSelect.innerHTML =
                    '<option>No hay horarios disponibles</option>';
                return;
            }

            horarios.forEach(hora => {
                const option = document.createElement('option');
                option.value = hora;
                option.textContent = hora;
                horaSelect.appendChild(option);
            });
        });
    </script>

</body>
</html>
