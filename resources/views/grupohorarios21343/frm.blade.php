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

            <!-- Selector de lugar -->
            <div class="mb-4">
                <label for="lugar_global" class="form-label">Selecciona un Lugar</label>
                <select id="lugar_global" class="form-select" onchange="updateTable()">
                    <option value="" disabled selected>Selecciona un Lugar</option>
                    @foreach ($lugares as $lugar)
                        <option value="{{ $lugar->id }}">{{ $lugar->nombrelugar }}</option>
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
                                        action="{{ $horarioActual ? route('grupohorarios21343.destroy', $horarioActual->id) : route('grupohorarios21343.store') }}" 
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
                                        <input type="hidden" name="lugar_id" value="">

                                        <!-- Checkbox -->
                                        <input 
                                            type="checkbox" 
                                            name="accion" 
                                            value="1" 
                                            id="checkbox-{{ $hora }}-{{ $dia }}"
                                            data-hora="{{ $hora }}"
                                            data-dia="{{ $dia }}"
                                            data-lugar="{{ $horarioActual?->lugar_id }}"
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
                <a href="{{ route('grupos21343.index21343') }}" class="btn btn-secondary">Volver a Grupos</a>
            </div>
        </div>
    </div>
</div>

<script>
    function updateTable() {
        const lugarId = document.getElementById('lugar_global').value;

        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            const lugarAsignado = checkbox.dataset.lugar;

            // Marca o desmarca los checkboxes según el lugar seleccionado
            checkbox.checked = lugarId && lugarId === lugarAsignado;
        });
    }

    function handleCheckboxChange(checkbox) {
        const lugarId = document.getElementById('lugar_global').value;

        if (!lugarId) {
            alert('Selecciona un lugar antes de asignar');
            checkbox.checked = false;
            return;
        }

        const form = checkbox.closest('form');
        form.querySelector('input[name="lugar_id"]').value = lugarId;
        form.submit();
    }
</script>