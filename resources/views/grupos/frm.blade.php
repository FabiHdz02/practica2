@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Encabezados y etiquetas */
    .container h4, 
    .container label, 
    .container .form-control, 
    .container .btn {
        font-family: 'Poppins', sans-serif;
    }

    .container h4 {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Campos de entrada */
    .form-control, .form-select {
        font-weight: 400;
        font-size: 0.85rem;
        padding: 8px 10px;
        border-radius: 5px;
    }

    /* Botones */
    .btn {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        border-radius: 20px;
        padding: 5px 20px;
    }

    .btn-container {
        text-align: center;
        margin-top: 20px;
    }

    /* Sección decorativa */
    .section-divider {
        width: 50px;
        height: 4px;
        background: #007bff;
        margin: 10px auto 20px;
        border-radius: 2px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Columna izquierda: Información del Grupo -->
        <div class="col-md-6">
            <form 
                action="{{ $accion == 'C' ? route('grupos.store') : route('grupos.update', $grupo->id) }}" 
                method="POST"
                class="p-4 shadow-sm rounded"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E')
                    @method('PUT')
                @endif

                <!-- Información del Grupo -->
                <h4>Información del Grupo</h4>
                <div class="section-divider"></div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="grupo" class="form-label">Grupo</label>
                        <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Código del grupo" value="{{ old('grupo', $grupo->grupo) }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $grupo->fecha) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="2" placeholder="Descripción">{{ old('descripcion', $grupo->descripcion) }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="maxalumnos" class="form-label">Máximo de Alumnos</label>
                        <input type="number" class="form-control" id="maxalumnos" name="maxalumnos" min="1" placeholder="Máximo de alumnos" value="{{ old('maxalumnos', $grupo->maxalumnos) }}">
                    </div>
                </div>

                <!-- Información Complementaria -->
                <h4>Información Complementaria</h4>
                <div class="section-divider"></div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="periodo_id" class="form-label">Periodo</label>
                        <select name="periodo_id" id="periodo_id" class="form-select">
                            <option value="" disabled {{ old('periodo_id') ? '' : 'selected' }}>Selecciona un Periodo</option>
                            @foreach ($materiasa->unique('periodo.periodo') as $peri)
                                @if ($peri->periodo)
                                    <option value="{{ $peri->periodo->id }}" {{ old('periodo_id') == $peri->periodo->id ? 'selected' : '' }}>
                                        {{ $peri->periodo->periodo }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="carrera_id" class="form-label">Carrera</label>
                        <select name="carrera_id" id="carrera_id" class="form-select">
                            <option value="" disabled {{ old('carrera_id') ? '' : 'selected' }}>Selecciona una Carrera</option>
                            @foreach ($materiasa->unique('carrera.nombrecarrera') as $carr)
                                @if ($carr->carrera)
                                    <option value="{{ $carr->carrera->id }}" {{ old('carrera_id') == $carr->carrera->id ? 'selected' : '' }}>
                                        {{ $carr->carrera->nombrecarrera }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2" id="semestreContainer" style="display: none;">
                        <label for="semestreSelect" class="form-label">Semestre</label>
                        <select name="semestre" id="semestreSelect" class="form-select">
                            <option value="" disabled {{ old('semestre') ? '' : 'selected' }}>Selecciona un Semestre</option>
                            @foreach ($materiasa->unique('materia.semestre') as $materias)
                                <option value="{{ $materias->materia->semestre }}" {{ old('semestre') == $materias->materia->semestre ? 'selected' : '' }}>
                                    {{ $materias->materia->semestre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2" id="materiaContainer" style="display: none;">
                        <label for="materia_abierta_id" class="form-label">Materia Abierta</label>
                        <select name="materia_abierta_id" id="materia_abierta_id" class="form-select">
                            <option value="" disabled {{ old('materia_abierta_id') ? '' : 'selected' }}>Selecciona una Materia</option>
                            @foreach ($materiasa as $mate)
                                <option value="{{ $mate->id }}" {{ old('materia_abierta_id') == $mate->id ? 'selected' : '' }}>
                                    {{ $mate->materia->nombremateria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <option value="" disabled {{ old('departamento') ? '' : 'selected' }}>Seleccionar departamento</option>
                            @foreach($deptos as $depto)
                                <option value="{{ $depto->id }}" {{ old('departamento') == $depto->id ? 'selected' : '' }}>
                                    {{ $depto->nombredepto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2" id="personalContainer" style="display: none;">
                        <label for="personal_id" class="form-label">Docente</label>
                        <select name="personal_id" id="personal_id" class="form-select">
                            <option value="" disabled {{ old('personal_id') ? '' : 'selected' }}>Selecciona un Docente</option>
                            @foreach ($personales as $personal)
                                <option value="{{ $personal->id }}" data-depto-id="{{ $personal->depto_id }}" {{ old('personal_id') == $personal->id ? 'selected' : '' }}>
                                    {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

        <!-- Columna derecha: Formulario de Horarios -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                @if (isset($grupo->id))
                    @include('grupohorarios.frm', ['grupo_id' => $grupo->id])
                @endif
            </div>
        </div>
    </div>
</div>

        

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const periodoSelect = document.getElementById("periodo_id");
        const carreraSelect = document.getElementById("carrera_id");
        const semestreContainer = document.getElementById("semestreContainer");
        const semestreSelect = document.getElementById("semestreSelect");
        const materiaContainer = document.getElementById("materiaContainer");
        const materiaSelect = document.getElementById("materia_abierta_id");
        const departamentoSelect = document.getElementById("departamento");
        const personalSelect = document.getElementById("personal_id");

        // Mostrar opciones según selección de periodo y carrera
        const mostrarOpciones = () => {
            if (periodoSelect.value && carreraSelect.value) {
                semestreContainer.style.display = "block";
                materiaContainer.style.display = "block";
            }
        };

        // Filtrar materias por semestre
        const filtrarMateriasPorSemestre = () => {
            const selectedSemestre = semestreSelect.value;
            const carreraId = carreraSelect.value;

            // Limpiar las opciones de materias
            materiaSelect.innerHTML = '<option value="" disabled selected>Selecciona una Materia</option>';

            // Filtrar materias que coincidan con el semestre seleccionado y la carrera
            @foreach ($materiasa as $materia)
                if ("{{ $materia->materia->semestre }}" === selectedSemestre && "{{ $materia->carrera->id }}" === carreraId) {
                    const option = document.createElement("option");
                    option.value = "{{ $materia->id }}";
                    option.textContent = "{{ $materia->materia->nombremateria }}";
                    materiaSelect.appendChild(option);
                }
            @endforeach
        };

        // Filtrar personal por departamento
        departamentoSelect.addEventListener("change", () => {
            const deptoId = departamentoSelect.value;

            Array.from(personalSelect.options).forEach(option => {
                option.style.display = option.getAttribute("data-depto-id") === deptoId ? "block" : "none";
            });

            const personalContainer = document.getElementById("personalContainer");
            personalContainer.style.display = deptoId ? "block" : "none";
        });

        // Eventos de cambio
        periodoSelect.addEventListener("change", mostrarOpciones);
        carreraSelect.addEventListener("change", mostrarOpciones);
        semestreSelect.addEventListener("change", filtrarMateriasPorSemestre);
    });
</script>
@endsection