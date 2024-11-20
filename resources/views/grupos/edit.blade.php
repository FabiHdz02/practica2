@extends("menu2")

@section("contenido2")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <form action="{{ route('grupos.update', $grupoData->id) }}" method="POST" id="grupoForm">
        @csrf
        @method('PUT')
        <h2 class="text-center">Editar Grupo</h2>

        <!-- Primera fila -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="fecha" class="mb-2">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" required value="{{ $grupoData->fecha }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="maxalumnos" class="mb-2">Max. Alumnos:</label>
                    <input type="number" id="maxalumnos" name="maxalumnos" class="form-control form-control-sm" required value="{{ $grupoData->maxalumnos }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="descripcion" class="mb-2">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" required value="{{ $grupoData->descripcion }}">
                </div>
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="grupo" class="mb-2">Grupo:</label>
                    <input id="grupo" name="grupo" type="text" class="form-control form-control-sm" required value="{{ $grupoData->grupo }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="periodo_id" class="mb-2">Periodo:</label>
                    <select name="periodo_id" id="periodo_id" class="form-select form-select-sm">
                        @foreach ($materiasa->unique('periodo.periodo') as $peri)
                            <option value="{{ $peri->periodo->id }}" {{ $grupoData->periodo_id == $peri->periodo->id ? 'selected' : '' }}>
                                {{ $peri->periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="materia_abierta_id" class="mb-2">Carrera:</label>
                    <select name="materia_abierta_id" id="materia_abierta_id" class="form-select form-select-sm">
                        @foreach ($materiasa->unique('carrera.nombrecarrera') as $carr)
                            <option value="{{ $carr->carrera->id }}" {{ $grupoData->materia_abierta_id == $carr->carrera->id ? 'selected' : '' }}>
                                {{ $carr->carrera->nombrecarrera }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tercera fila: semestre y materias -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="semestreSelect" class="mb-2">Semestre:</label>
                    <select name="semestre" id="semestreSelect" class="form-select form-select-sm">
                        <option value="" disabled selected>Selecciona un Semestre</option>
                        @foreach ($materiasa->unique('materia.semestre') as $materias)
                            <option value="{{ $materias->materia->semestre }}" {{ $grupoData->semestre == $materias->materia->semestre ? 'selected' : '' }}>
                                Semestre: {{ $materias->materia->semestre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    <label class="mb-2">Materias:</label>
                    @foreach ($materiasa as $mate)
                        <div class="form-check">
                            <input type="radio" name="materia_abierta_id" id="materia_abierta_{{ $mate->id }}" value="{{ $mate->id }}" class="form-check-input" 
                            {{ $grupoData->materia_abierta_id == $mate->id ? 'checked' : '' }}>
                            <label for="materia_abierta_{{ $mate->id }}" class="form-check-label">{{ $mate->materia->nombremateria }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cuarta fila: departamento y docentes -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="departamento" class="mb-2">Departamento:</label>
                    <select id="departamento" name="departamento" class="form-select form-select-sm">
                        <option value="" disabled {{ old('departamento', $grupoData->departamento) == '' ? 'selected' : '' }}>Seleccionar departamento</option>
                        @foreach($deptos as $depto)
                            <option value="{{ $depto->id }}" {{ old('departamento', $grupoData->departamento) == $depto->id ? 'selected' : '' }}>
                                {{ $depto->nombredepto }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label class="mb-2">Docentes:</label>
                    @foreach ($personales as $personal)
                        <div class="form-check">
                            <input type="radio" name="personal_id" id="personal_{{ $personal->id }}" value="{{ $personal->id }}" class="form-check-input"
                            {{ $grupoData->personal_id == $personal->id ? 'checked' : '' }}>
                            <label for="personal_{{ $personal->id }}" class="form-check-label">
                                {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{--<!-- Quinta fila: horarios -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <label class="mb-2">Horarios:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Día</th>
                                <th>Hora</th>
                                <th>Edificio</th>
                                <th>Lugar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupoHorarios as $horario)
                                <tr>
                                    <td>
                                        <select name="horarios[{{ $horario->id }}][dia]" class="form-select form-select-sm">
                                            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $key => $dia)
                                                <option value="{{ $key }}" {{ $horario->dia == $key ? 'selected' : '' }}>
                                                    {{ $dia }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" name="horarios[{{ $horario->id }}][hora]" class="form-control form-control-sm"
                                            value="{{ $horario->hora }}">
                                    </td>
                                    <td>
                                        <select name="horarios[{{ $horario->id }}][edificio_id]" class="form-select form-select-sm">
                                            @foreach ($edificios as $edificio)
                                                <option value="{{ $edificio->id }}" {{ optional($horario->lugar)->edificio_id == $edificio->id ? 'selected' : '' }}>
                                                    {{ $edificio->nombreedificio }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="horarios[{{ $horario->id }}][lugar_id]" class="form-select form-select-sm">
                                            @if ($horario->lugar && $horario->lugar->edificio)
                                                @foreach ($horario->lugar->edificio->lugares as $lugar)
                                                    <option value="{{ $lugar->id }}" {{ $horario->lugar_id == $lugar->id ? 'selected' : '' }}>
                                                        {{ $lugar->nombrelugar }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>--}}
        
        <!-- Edificios y Lugares -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="grupoSelect" class="mb-2">Grupo:</label>
                <select name="grupo_id" class="form-select form-select-sm" id="grupoSelect">
                    <option value="" disabled>Selecciona un Grupo</option>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}" {{ $grupoData->id == $grupo->id ? 'selected' : '' }}>
                            {{ $grupo->grupo }}
                        </option>
                    @endforeach
                </select>
            </div>
                           
            <div class="col-md-4">
                <label for="edificioSelect" class="mb-2">Edificio:</label>
                <select name="edificio_id" class="form-select form-select-sm" id="edificioSelect">
                    <option value="" disabled>Selecciona un Edificio</option>
                    @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->id }}" 
                            {{ $grupoHorarios->first()->lugar->edificio_id == $edificio->id ? 'selected' : '' }}>
                            {{ $edificio->nombreedificio }}
                        </option>
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="lugarSelect" class="mb-2">Lugar:</label>
                <select name="lugar_id" class="form-select form-select-sm" id="lugarSelect">
                    <option value="" disabled>Selecciona un Lugar</option>
                    @foreach ($grupoHorarios->first()->lugar->edificio->lugares ?? [] as $lugar)
                        <option value="{{ $lugar->id }}" 
                            {{ $grupoHorarios->first()->lugar_id == $lugar->id ? 'selected' : '' }}>
                            {{ $lugar->nombrelugar }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
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
                        @for ($hora = 7; $hora <= 22; $hora++)
                            @php
                                $horaFormatted = sprintf('%02d:00', $hora);
                            @endphp
                            <tr>
                                <td>{{ $horaFormatted }}</td>
                                @for ($dia = 1; $dia <= 5; $dia++)
                                    @php
                                        // Verificar si el horario está en el listado
                                        $isChecked = $grupoHorarios->contains(function ($horario) use ($dia, $horaFormatted) {
                                            return $horario->dia == $dia && $horario->hora == $horaFormatted;
                                        });
                                    @endphp
                                    <td>
                                        <input type="checkbox" 
                                               name="horarios[]" 
                                               value="{{ $dia }}-{{ $horaFormatted }}" 
                                               {{ $isChecked ? 'checked' : '' }}>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>                    
                </table>
            </div>
        </div>        
        
        <!-- Botón Guardar -->
        <div class="row mb-4">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Elementos DOM
        const edificioSelect = document.getElementById("edificioSelect");
        const lugaresList = document.getElementById("lugaresList");
        const lugarContainer = document.getElementById("lugarContainer");
        const departamentoSelect = document.getElementById("departamento");
        const personalContainer = document.getElementById("personalContainer");
        const personals = personalContainer.querySelectorAll(".form-check");

        // Filtrar lugares por edificio seleccionado
        edificioSelect.addEventListener("change", function () {
            const selectedOption = this.selectedOptions[0];
            const lugaresData = JSON.parse(selectedOption.dataset.lugares || "[]");
            
            lugaresList.innerHTML = "";
            if (lugaresData.length > 0) {
                lugarContainer.style.display = "block";
                const uniqueLugares = Array.from(new Set(lugaresData.map(lugar => lugar.nombrelugar)))
                    .map(nombrelugar => lugaresData.find(lugar => lugar.nombrelugar === nombrelugar));

                uniqueLugares.forEach(lugar => {
                    const lugarDiv = document.createElement("div");
                    lugarDiv.classList.add("form-check");

                    const input = document.createElement("input");
                    input.type = "radio";
                    input.name = "lugar_id";
                    input.id = `lugar_${lugar.id}`;
                    input.value = lugar.id;
                    input.classList.add("form-check-input");

                    const label = document.createElement("label");
                    label.htmlFor = input.id;
                    label.classList.add("form-check-label");
                    label.textContent = lugar.nombrelugar;

                    lugarDiv.appendChild(input);
                    lugarDiv.appendChild(label);
                    lugaresList.appendChild(lugarDiv);
                });
            } else {
                lugarContainer.style.display = "none";
            }
        });

        // Filtrar docentes por departamento seleccionado
        departamentoSelect.addEventListener("change", function () {
            const selectedDepto = this.value;

            let hasVisiblePersonal = false;
            personals.forEach(personal => {
                const personalDeptoId = personal.getAttribute("data-depto-id");
                if (selectedDepto === "" || personalDeptoId === selectedDepto) {
                    personal.style.display = "block";
                    hasVisiblePersonal = true;
                } else {
                    personal.style.display = "none";
                }
            });

            personalContainer.style.display = hasVisiblePersonal ? "block" : "none";
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const edificioSelect = document.getElementById('edificioSelect');
    const lugarSelect = document.getElementById('lugarSelect');

    edificioSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const lugares = JSON.parse(selectedOption.dataset.lugares || '[]');

        lugarSelect.innerHTML = '<option value="" disabled selected>Selecciona un Lugar</option>';

        lugares.forEach(lugar => {
            const option = document.createElement('option');
            option.value = lugar.id;
            option.textContent = lugar.nombrelugar;
            lugarSelect.appendChild(option);
        });
    });
    });
</script>
@endsection