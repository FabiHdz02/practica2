<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Por favor corrige los siguientes errores!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Encabezado -->
            <h2 class="text-center mb-4">{{ $accion == 'C' ? 'Crear Horario' : 'Editar Horario' }}</h2>

            <!-- Edificio -->
            <div class="mb-3">
                <label for="edificio_id" class="form-label">Edificio:</label>
                <select 
                    class="form-select" 
                    id="edificio_id" 
                    name="edificio_id" 
                    {{ $accion == 'D' ? 'disabled' : 'required' }}
                    onchange="updateLugares()"
                >
                    <option value="" disabled {{ old('edificio_id', session('edificio_id') ?? '') == '' ? 'selected' : '' }}>Seleccione un edificio</option>
                    @foreach ($edificios as $edificio)
                        <option 
                            value="{{ $edificio->id }}" 
                            {{ old('edificio_id', session('edificio_id') ?? '') == $edificio->id ? 'selected' : '' }}
                        >
                            {{ $edificio->nombreedificio }}
                        </option>
                    @endforeach
                </select>
                @error('edificio_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="lugar_global" class="form-label">Selecciona un Lugar</label>
                <select id="lugar_global" class="form-select" onchange="updateTable()">
                    <option value="" disabled selected>Selecciona un Lugar</option>
                    @foreach ($lugares as $lugar)
                        <option 
                            value="{{ $lugar->id }}" 
                            data-edificio-id="{{ $lugar->edificio_id }}"
                            {{ old('lugar_id', session('lugar_id') ?? '') == $lugar->id ? 'selected' : '' }}
                        >
                            {{ $lugar->nombrelugar }}
                        </option>
                    @endforeach
                </select>
            </div>
            
               
            <!-- Tabla de horario -->
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['07-08', '08-09', '09-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17'] as $hora)
                        <tr>
                            <td><strong>{{ $hora }}</strong></td>
                            @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes'] as $dia)
                                @php
                                    $horarioActual = $grupoHorarios->where('hora', $hora)->where('dia', $dia)->first();
                                @endphp
                                <td>
                                    <form 
                                        action="{{ $horarioActual ? route('grupohorarios.destroy', $horarioActual->id) : route('grupohorarios.store') }}" 
                                        method="POST" 
                                        id="form-{{ $hora }}-{{ $dia }}"
                                    >
                                        @csrf
                                        @if ($horarioActual)
                                            @method('DELETE')
                                        @endif

                                        <!-- Campos ocultos -->
                                        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                                        <input type="hidden" name="dia" value="{{ $dia }}">
                                        <input type="hidden" name="hora" value="{{ $hora }}">
                                        <input type="hidden" name="lugar_id" value="{{ $horarioActual?->lugar_id ?? '' }}">

                                        <!-- Checkbox -->
                                        <input 
    type="checkbox" 
    name="accion" 
    value="1" 
    id="checkbox-{{ $hora }}-{{ $dia }}"
    data-hora="{{ $hora }}"
    data-dia="{{ $dia }}"
    data-lugar="{{ $horarioActual?->lugar_id ?? '' }}"
    data-edificio-id="{{ $lugar->edificio_id ?? '' }}"
    {{ $horarioActual ? 'checked' : '' }}
    onchange="handleCheckboxChange(this)"
>
                                    </form>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Botón para regresar -->
            <div class="text-center mt-4">
                <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Volver a Grupos</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Definir la función updateLugares
    function updateLugares() {
        const edificioId = document.getElementById('edificio_id').value;
        const lugarSelect = document.getElementById('lugar_global');

        // Filtrar lugares por edificio
        Array.from(lugarSelect.options).forEach(option => {
            option.style.display = option.dataset.edificioId === edificioId ? 'block' : 'none';
        });

        // Asegurarse de que el lugar previamente seleccionado se mantiene
        const selectedLugar = @json(session('lugar_id')) ?? '';
        if (selectedLugar) {
            lugarSelect.value = selectedLugar;
        }
    }

    // Llamar a updateLugares cuando el DOM esté completamente cargado
    updateLugares();  // Asegurarse de que se ejecute al cargar la página

    // También vincular la función a eventos 'onchange' de los selects si es necesario
    document.getElementById('edificio_id').addEventListener('change', updateLugares);
});

function handleCheckboxChange(checkbox) {
    const lugarId = document.getElementById('lugar_global').value;
    const hora = checkbox.dataset.hora;
    const dia = checkbox.dataset.dia;
    const grupoId = document.querySelector('input[name="grupo_id"]').value;

    if (!lugarId) {
        alert('Selecciona un lugar antes de asignar');
        checkbox.checked = false;
        return;
    }

    // Hacer una petición al servidor para verificar si el horario ya está ocupado
    fetch('/check-horario-ocupado', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Obtener el token CSRF
        },
        body: JSON.stringify({
            grupo_id: grupoId,
            lugar_id: lugarId,
            hora: hora,
            dia: dia
        })
    })
    .then(response => response.json())  // Aquí esperamos siempre una respuesta JSON
    .then(data => {
        // Verificar si hay un error
        if (data.error) {
            // Mostrar el mensaje de error con SweetAlert2
            Swal.fire({
                title: '¡Error!',
                text: data.error, // Este es el mensaje que viene del backend
                icon: 'error',
                confirmButtonText: '¡Entendido!',
                showClass: {
                    popup: 'animate_animated animate_shakeX' // Animación de error
                },
                hideClass: {
                    popup: 'animate_animated animate_fadeOutUp'
                }
            });
            checkbox.checked = false; // Desmarcar el checkbox
        } else if (data.success) {
            // Si el horario no está ocupado, enviar el formulario
            const form = checkbox.closest('form');
            form.querySelector('input[name="lugar_id"]').value = lugarId;
            form.submit();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}




    function updateTable() {
    const lugarId = document.getElementById('lugar_global').value;

    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        const checkboxLugarId = checkbox.dataset.lugar;

        // Si no hay un lugar seleccionado, no cambiar nada
        if (!lugarId) return;

        // Solo modificar los checkboxes del lugar seleccionado
        if (checkboxLugarId === lugarId) {
            checkbox.checked = true;
        } else if (checkbox.dataset.hora + '-' + checkbox.dataset.dia === checkbox.closest('tr').querySelector('strong').textContent + '-' + checkbox.dataset.dia) {
            checkbox.checked = false;
        }
    });
}



</script>