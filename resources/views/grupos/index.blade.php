@extends("menu2")

@section("contenido2")

<form action="{{ route('grupos.store') }}" method="POST" id="grupoForm">
    @csrf
    <h2 class="text-center">Asignación de Grupos</h2>
    <div class="container">
        <!-- Primera fila -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="fecha" class="mb-2">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" required value="{{ old('fecha') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="maxalumnos" class="mb-2">Max. Alumnos:</label>
                    <input type="number" id="maxalumnos" name="maxalumnos" class="form-control form-control-sm" required value="{{ old('maxalumnos') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="descripcion" class="mb-2">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" required value="{{ old('descripcion') }}">
                </div>
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="grupo" class="mb-2">Grupo:</label>
                    <input id="grupo" name="grupo" type="text" class="form-control form-control-sm" required value="{{ old('grupo') }}">
                </div>                
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="periodo_id" class="mb-2">Periodo:</label>
                    <select name="periodo_id" id="periodo_id" class="form-select form-select-sm">
                        <option value="" disabled selected>Selecciona un Periodo</option>
                        @foreach ($materiasa->unique('periodo.periodo') as $peri)
                            @if ($peri->periodo)
                            <option value="{{ $peri->periodo->id }}" {{ old('periodo_id') == $peri->periodo->id ? 'selected' : '' }}>
                                {{ $peri->periodo->periodo }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <label for="materia_abierta_id" class="mb-2">Carrera:</label>
                    <select name="materia_abierta_id" id="materia_abierta_id" class="form-select form-select-sm">
                        <option value="" disabled selected>Selecciona una Carrera</option>
                        @foreach ($materiasa->unique('carrera.nombrecarrera') as $carr)
                            @if ($carr->carrera)
                                <option value="{{ $carr->carrera->id }}">{{ $carr->carrera->nombrecarrera }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4" id="semestreContainer" style="display: none;">
                <label for="semestreSelect" class="mb-2">Semestre:</label>
                <select name="semestre" id="semestreSelect" class="form-select form-select-sm">
                    <option value="" disabled selected>Selecciona un Semestre</option>
                    @foreach ($materiasa->unique('materia.semestre') as $materias)
                        <option value="{{ $materias->materia->semestre }}">Semestre: {{ $materias->materia->semestre }}</option>
                    @endforeach
                </select>

                <div class="form-check mt-3">
                    @foreach ($materiasa as $mate)
                        <input type="radio" name="materia_abierta_id" id="materia_abierta_{{ $mate->id }}" value="{{ $mate->id }}" class="form-check-input">
                        <label for="materia_{{ $mate->id }}" class="form-check-label">{{ $mate->materia->nombremateria }}</label>
                    @endforeach
                </div>
            </div>

            <!-- Contenedor para los docentes, que se mostrará solo después de seleccionar periodo y carrera -->
            <div class="form-group">
                <label for="departamento">Departamento</label>
                <select id="departamento" name="departamento" class="form-control" required>
                    <option value="" disabled {{ old('departamento') == '' ? 'selected' : '' }}>Seleccionar departamento</option>
                    @foreach($deptos as $depto)
                        <option value="{{ $depto->id }}" {{ old('departamento') == $depto->id ? 'selected' : '' }}>
                            {{ $depto->nombredepto }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4" id="personalContainer" style="display: none;">
                <label class="mb-2">Docentes:</label>
                @foreach ($personales as $personal)
                    <div class="form-check mb-2 personal" data-depto-id="{{ $personal->depto->id }}">
                        <input type="radio" name="personal_id" id="personal_{{ $personal->id }}" value="{{ $personal->id }}" class="form-check-input">
                        <label for="personal_{{ $personal->id }}" class="form-check-label">
                            {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                        </label>
                    </div>
                @endforeach
                <div class="form-check mb-2">
                    <input type="radio" name="personal_id" id="personal_null" value="" class="form-check-input" checked style="display: none;">
                    <label for="personal_null" class="form-check-label" style="display: none;">Sin Asignar Docente</label>
                </div>
            </div>
        </div>

        {{--FILTRADO DE DOCENTES POR DEPTO--}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            const departamentoSelect = document.getElementById("departamento");
            const personalContainer = document.getElementById("personalContainer");
            const personals = personalContainer.getElementsByClassName("personal");

            departamentoSelect.addEventListener("change", function() {
                const selectedDepto = departamentoSelect.value;
                
                let hasVisiblePersonal = false;

                Array.from(personals).forEach(personal => {
                    if (selectedDepto === "" || personal.getAttribute("data-depto-id") === selectedDepto) {
                        personal.style.display = "block";
                        hasVisiblePersonal = true;
                    } else {
                        personal.style.display = "none";
                    }
                });

                // Mostrar u ocultar el contenedor de personal según sea necesario
                personalContainer.style.display = hasVisiblePersonal ? "block" : "none";
            });
         });
        </script>

        <!-- Botón Registrar -->
        <div class="row mb-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-primary btn-sm" id="botonIniciarHorario">Iniciar Horario Grupo</button>
            </div>
        </div>
        <hr class="my-4">
</form>

<form action="{{ route('grupo_horarios.store') }}" method="POST" id="secondFormContainer" style="display: none;">
    @csrf
    <h2 class="text-center">Asignación de Grupo Horario</h2>
    <div class="row mb-4">
        <div class="col-md-4" id="personalContainer" style="display: none;">
            <label for="edificioSelect" class="mb-2">Edificio:</label>
            <select name="edificio_id" class="form-select form-select-sm mb-2" id="edificioSelect">
                <option value="" disabled selected>Selecciona un Edificio</option>
                @foreach ($edificios as $edificio)
                    <option value="{{ $edificio->id }}" data-lugares="{{ json_encode($edificio->lugares) }}">
                        {{ $edificio->nombreedificio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4" id="lugarContainer" style="display: none;">
            <label for="lugaresList" class="mb-2">Lugares:</label>
            <div id="lugaresList"></div>
        </div>
    </div>
    <div class="row mb-4">
        <!-- Seleccionar el Grupo -->
        <div class="col-md-4">
            <label for="grupoSelect" class="mb-2">Grupo:</label>
            <select name="grupo_id" class="form-select form-select-sm mb-2" id="grupoSelect">
                <option value="" disabled selected>Selecciona un Grupo</option>
                @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
                @endforeach
            </select>
        </div>
        <!-- Seleccionar la Hora -->
        <div class="col-md-4">
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
                            <!-- Genera las columnas para cada día de la semana -->
                            @for ($dia = 1; $dia <= 5; $dia++)
                                <td>
                                    <input type="checkbox" name="horarios[]" value="{{ $dia }}-{{ $horaFormatted }}">
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>    

    <button type="submit" class="btn btn-primary" id="botonGuardarHorario">Guardar</button>
    {{--BOTON DINAMICO--}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const botonIniciarHorario = document.getElementById("botonIniciarHorario");
            const botonGuardarHorario = document.getElementById("botonGuardarHorario");
            const formularioPrimero = document.getElementById("grupoForm"); // Primer formulario
            const segundoFormulario = document.getElementById("secondFormContainer");
    
            // Estado inicial desde localStorage
            const estadoBoton = localStorage.getItem("estadoBoton") || "nuevo";
    
            // Configuración inicial de visibilidad
            if (estadoBoton === "terminar") {
                botonIniciarHorario.style.display = "none"; // Ocultar botón "Iniciar Horario"
                segundoFormulario.style.display = "block"; // Mostrar el segundo formulario
                botonGuardarHorario.textContent = "Terminar Horario Grupo"; // Cambiar texto del botón del segundo formulario
            } else {
                botonIniciarHorario.style.display = "inline-block"; // Mostrar botón "Iniciar Horario"
                segundoFormulario.style.display = "none"; // Ocultar el segundo formulario
                botonGuardarHorario.textContent = "Guardar"; // Texto original del botón del segundo formulario
            }
    
            // Evento al hacer clic en "Iniciar Horario Grupo"
            botonIniciarHorario.addEventListener("click", function () {
                localStorage.setItem("estadoBoton", "terminar");
                botonIniciarHorario.style.display = "none"; // Ocultar "Iniciar Horario Grupo"
                segundoFormulario.style.display = "block"; // Mostrar el segundo formulario
                botonGuardarHorario.textContent = "Terminar Horario Grupo"; // Cambiar texto en el segundo formulario
    
                // Enviar datos del primer formulario
                formularioPrimero.submit();
            });
    
            // Evento al hacer clic en "Guardar" o "Terminar Horario Grupo" (segundo formulario)
            botonGuardarHorario.addEventListener("click", function (event) {
                if (botonGuardarHorario.textContent === "Terminar Horario Grupo") {
                    // No previene el envío, el formulario debe enviarse
                    localStorage.setItem("estadoBoton", "nuevo"); // Restablecer estado
                    botonGuardarHorario.textContent = "Guardar"; // Restaurar texto original
                    botonIniciarHorario.style.display = "inline-block"; // Mostrar "Iniciar Horario Grupo"
                    segundoFormulario.style.display = "none"; // Ocultar el segundo formulario
                } else {
                    // Enviar el segundo formulario cuando esté en estado "Guardar"
                    formularioSegundo.submit();
                }
            });
    
            // Inicializar el formulario si hay datos en la sesión
            const formData = @json(session('form_data'));
            const showSecondForm = @json(session('show_second_form', false));
    
            if (showSecondForm && formData) {
                // Mostrar el segundo formulario si se indicó en la sesión
                segundoFormulario.style.display = "block";
                botonIniciarHorario.style.display = "none";
    
                // Rellenar campos con datos de la sesión
                if (formData.grupo) document.getElementById("grupo").value = formData.grupo;
                if (formData.descripcion) document.getElementById("descripcion").value = formData.descripcion;
                if (formData.maxalumnos) document.getElementById("maxalumnos").value = formData.maxalumnos;
                if (formData.fecha) document.getElementById("fecha").value = formData.fecha;
    
                // Seleccionar valores en los selectores
                if (formData.periodo_id) document.getElementById("periodo_id").value = formData.periodo_id;
                if (formData.carrera_id) document.getElementById("materia_abierta_id").value = formData.carrera_id;
                if (formData.semestre) document.getElementById("semestreSelect").value = formData.semestre;
            }
        });
    </script>
</form>

{{--IMPRIMIR NOMBRE CORTO--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const lugaresList = document.getElementById('lugaresList');
    const lugarContainer = document.getElementById('lugarContainer');
    const edificioSelect = document.getElementById('edificioSelect');

    let lugarSeleccionado = '';

    // Función para cargar los lugares según el edificio seleccionado
    edificioSelect.addEventListener('change', function () {
        lugaresList.innerHTML = ''; // Limpiar lista de lugares
        const edificioId = this.value;
        const lugaresData = JSON.parse(this.selectedOptions[0]?.dataset?.lugares || '[]');

        if (lugaresData.length > 0) {
            lugarContainer.style.display = 'block'; // Mostrar contenedor de lugares

            // Crear radios de lugar
            lugaresData.forEach(lugar => {
                const lugarDiv = document.createElement('div');
                lugarDiv.classList.add('form-check');

                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'lugar_id';
                input.id = `lugar_${lugar.id}`;
                input.value = lugar.id;
                input.classList.add('form-check-input');
                input.setAttribute('data-nombre-lugar', lugar.nombrelugar || 'Lugar desconocido'); // Asignar nombre o valor por defecto

                const label = document.createElement('label');
                label.htmlFor = input.id;
                label.classList.add('form-check-label');
                label.textContent = lugar.nombrelugar || 'Lugar desconocido'; // Mostrar nombre o valor por defecto

                lugarDiv.appendChild(input);
                lugarDiv.appendChild(label);
                lugaresList.appendChild(lugarDiv);
            });

            // Evento de cambio para capturar el lugar seleccionado
            const lugarRadios = lugaresList.querySelectorAll('input[name="lugar_id"]');
            lugarRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    lugarSeleccionado = this.getAttribute('data-nombre-lugar') || 'Lugar desconocido';
                    console.log('Lugar seleccionado:', lugarSeleccionado); // Mostrar en consola
                });
            });
        } else {
            lugarContainer.style.display = 'none'; // Ocultar contenedor si no hay lugares
        }
    });

    // Manejo de los checkboxes de horario
    const horariosCheckboxes = document.querySelectorAll('input[name="horarios[]"]');
    horariosCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const value = checkbox.value;
            const [dia, hora] = value.split(',');

            // Contenedor para la descripción
            let descriptionContainer = checkbox.parentElement.querySelector('.description');

            if (checkbox.checked) {
                if (!descriptionContainer) {
                    descriptionContainer = document.createElement('div');
                    descriptionContainer.classList.add('description');
                    descriptionContainer.innerText = `${lugarSeleccionado}`;
                    checkbox.parentElement.appendChild(descriptionContainer);
                }
            } else {
                if (descriptionContainer) {
                    checkbox.parentElement.removeChild(descriptionContainer);
                }
            }
        });
    });
    });
</script>

{{--BLOQUEAR PRIMER FORMS--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const botonIniciarHorario = document.getElementById("botonIniciarHorario");
    const botonGuardarHorario = document.getElementById("botonGuardarHorario");
    const formularioPrimero = document.getElementById("grupoForm"); // Primer formulario
    const segundoFormulario = document.getElementById("secondFormContainer");

    // IDs de los campos a deshabilitar
    const camposAfectados = [
        "fecha",
        "maxalumnos",
        "descripcion",
        "grupo",
        "periodo_id",
        "materia_abierta_id",
        "departamento" // Campo departamento añadido aquí
    ];

    // IDs de los contenedores adicionales
    const contenedoresAdicionales = [
        "semestreContainer",
        "personalContainer"
    ];

    // Función para habilitar o deshabilitar campos dentro de contenedores
    const toggleFields = (disable) => {
        // Deshabilitar campos con IDs directos
        camposAfectados.forEach(id => {
            const field = document.getElementById(id);
            if (field) {
                field.disabled = disable;
            }
        });

        // Deshabilitar todos los inputs/selects dentro de los contenedores
        contenedoresAdicionales.forEach(containerId => {
            const container = document.getElementById(containerId);
            if (container) {
                const fields = container.querySelectorAll("input, select, textarea");
                fields.forEach(field => {
                    field.disabled = disable;
                });
            }
        });
    };

    // Estado inicial desde localStorage
    const estadoBoton = localStorage.getItem("estadoBoton") || "nuevo";

    // Configuración inicial de visibilidad
    if (estadoBoton === "terminar") {
        botonIniciarHorario.style.display = "none"; // Ocultar botón "Iniciar Horario"
        segundoFormulario.style.display = "block"; // Mostrar el segundo formulario
        botonGuardarHorario.textContent = "Terminar Horario Grupo"; // Cambiar texto del botón del segundo formulario
        toggleFields(true); // Deshabilitar los campos
    } else {
        botonIniciarHorario.style.display = "inline-block"; // Mostrar botón "Iniciar Horario"
        segundoFormulario.style.display = "none"; // Ocultar el segundo formulario
        botonGuardarHorario.textContent = "Guardar"; // Texto original del botón del segundo formulario
        toggleFields(false); // Habilitar los campos
    }

    // Evento al hacer clic en "Iniciar Horario Grupo"
    botonIniciarHorario.addEventListener("click", function () {
        localStorage.setItem("estadoBoton", "terminar");
        botonIniciarHorario.style.display = "none"; // Ocultar "Iniciar Horario Grupo"
        segundoFormulario.style.display = "block"; // Mostrar el segundo formulario
        botonGuardarHorario.textContent = "Terminar Horario Grupo"; // Cambiar texto en el segundo formulario
        toggleFields(true); // Deshabilitar los campos
    });

    // Evento al hacer clic en "Guardar" o "Terminar Horario Grupo" (segundo formulario)
    botonGuardarHorario.addEventListener("click", function () {
        if (botonGuardarHorario.textContent === "Terminar Horario Grupo") {
            localStorage.setItem("estadoBoton", "nuevo");
            botonGuardarHorario.textContent = "Guardar"; // Restaurar texto original
            botonIniciarHorario.style.display = "inline-block"; // Mostrar "Iniciar Horario Grupo"
            segundoFormulario.style.display = "none"; // Ocultar el segundo formulario
            toggleFields(false); // Habilitar los campos
        }
    });

    // Inicializar el formulario si hay datos en la sesión
    const formData = @json(session('form_data'));
    const showSecondForm = @json(session('show_second_form', false));

    if (showSecondForm && formData) {
        segundoFormulario.style.display = "block";
        botonIniciarHorario.style.display = "none";

        // Rellenar campos con datos de la sesión
        if (formData.grupo) document.getElementById("grupo").value = formData.grupo;
        if (formData.descripcion) document.getElementById("descripcion").value = formData.descripcion;
        if (formData.maxalumnos) document.getElementById("maxalumnos").value = formData.maxalumnos;
        if (formData.fecha) document.getElementById("fecha").value = formData.fecha;

        // Seleccionar valores en los selectores
        if (formData.periodo_id) document.getElementById("periodo_id").value = formData.periodo_id;
        if (formData.carrera_id) document.getElementById("materia_abierta_id").value = formData.carrera_id;
        if (formData.departamento) document.getElementById("departamento").value = formData.departamento;
        if (formData.semestre) document.getElementById("semestreSelect").value = formData.semestre;
    }
    });
</script>

{{--FILTRACIONES--}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const periodoSelect = document.getElementById("periodo_id");
    const carreraSelect = document.getElementById("materia_abierta_id");
    const semestreSelect = document.getElementById("semestreSelect");
    const grupoInput = document.getElementById("grupo");
    const descripcionInput = document.getElementById("descripcion");
    const maxalumnosInput = document.getElementById("maxalumnos");
    const fechaInput = document.getElementById("fecha");
    const semestreContainer = document.getElementById("semestreContainer");
    const personalContainer = document.getElementById("personalContainer");
    const lugarContainer = document.getElementById("lugarContainer");
    const edificioContainer = document.getElementById("edificioSelect").closest('.col-md-4');
    const materiaContainer = semestreContainer.querySelector(".form-check");

    // Función para mostrar y cargar los datos después del registro
    function initializeFormAfterSubmission(formData) {
        if (!formData) return;

        // Mostrar los contenedores
        semestreContainer.style.display = "block";
        personalContainer.style.display = "block";
        edificioContainer.style.display = "block";

        // Establecer valores de los campos básicos
        if (formData.grupo) grupoInput.value = formData.grupo;
        if (formData.descripcion) descripcionInput.value = formData.descripcion;
        if (formData.maxalumnos) maxalumnosInput.value = formData.maxalumnos;
        if (formData.fecha) fechaInput.value = formData.fecha;

        // Establecer valores de los selectores
        if (formData.periodo_id) {
            periodoSelect.value = formData.periodo_id;
        }

        if (formData.carrera_id) {
            carreraSelect.value = formData.carrera_id;
        }

        if (formData.semestre) {
            semestreSelect.value = formData.semestre;
            cargarMateriasPorCarrera(true); // El true indica que es una carga inicial
        }

        // Seleccionar el docente si existe
        if (formData.personal_id) {
            const personalRadio = document.querySelector(`input[name="personal_id"][value="${formData.personal_id}"]`);
            if (personalRadio) {
                personalRadio.checked = true;
            }
        }
    }

    function mostrarSelectores() {
        if (periodoSelect.value && carreraSelect.value) {
            semestreContainer.style.display = "block";
            personalContainer.style.display = "block";
            edificioContainer.style.display = "block";
        }
    }

    function cargarMateriasPorCarrera(isInitialLoad = false) {
        const carreraId = carreraSelect.value;
        const selectedSemestre = semestreSelect.value;
        materiaContainer.innerHTML = '';
        
        if (!carreraId || !selectedSemestre) return;

        @foreach ($materiasa as $materia)
            if (carreraId == "{{ $materia->carrera->id }}" && selectedSemestre == "{{ $materia->materia->semestre }}") {
                const radioHtml = `
                    <div class="form-check">
                        <input type="radio" 
                               name="materia_abierta_id" 
                               id="materia_abierta_{{ $materia->id }}" 
                               value="{{ $materia->id }}" 
                               class="form-check-input"
                               ${@json(session('form_data.materia_abierta_id')) == {{ $materia->id }} ? 'checked' : ''}>
                        <label for="materia_{{ $materia->id }}" 
                               class="form-check-label">{{ $materia->materia->nombremateria }}</label>
                    </div>`;
                materiaContainer.innerHTML += radioHtml;
            }
        @endforeach

        // Si es carga inicial y hay una materia seleccionada previamente, seleccionarla
        if (isInitialLoad) {
            const savedMateriaId = @json(session('form_data.materia_abierta_id'));
            if (savedMateriaId) {
                const radioButton = document.querySelector(`input[name="materia_abierta_id"][value="${savedMateriaId}"]`);
                if (radioButton) {
                    radioButton.checked = true;
                }
            }
        }
    }

    // Verificar grupo existente
    function verificarGrupo() {
        const messageDiv = grupoInput.parentNode.querySelector('div');
        const currentValue = grupoInput.value.trim();
        
        if (messageDiv) {
            messageDiv.textContent = '';
            messageDiv.className = '';
            
            if (currentValue && existingGroups.includes(currentValue)) {
                messageDiv.textContent = 'Ya existe. ¿Quieres actualizar?';
                messageDiv.style.color = 'blue';
            }
        }
    }

    // Inicializar el formulario si hay datos en la sesión
    const formData = @json(session('form_data'));
    const showForm = @json(session('show_form'));
    
    if (showForm && formData) {
        initializeFormAfterSubmission(formData);
    }

    // Event listeners
    periodoSelect.addEventListener("change", mostrarSelectores);
    carreraSelect.addEventListener("change", function() {
        mostrarSelectores();
        cargarMateriasPorCarrera();
    });
    semestreSelect.addEventListener("change", cargarMateriasPorCarrera);
    grupoInput.addEventListener("blur", verificarGrupo);
    });
</script>

{{--FILTRACIONES DE EDIFICIO-LUGAR--}}
<script>
    document.getElementById('edificioSelect').addEventListener('change', function() {
        const lugaresList = document.getElementById('lugaresList');
        const edificioId = this.value;
        const lugaresData = JSON.parse(this.selectedOptions[0].dataset.lugares);

        lugaresList.innerHTML = '';

        const uniqueLugares = Array.from(new Set(lugaresData.map(lugar => lugar.nombrelugar)))
            .map(nombrelugar => {
                return lugaresData.find(lugar => lugar.nombrelugar === nombrelugar);
            });

        if (uniqueLugares.length > 0) {
            lugarContainer.style.display = 'block';
            uniqueLugares.forEach(lugar => {
                const lugarDiv = document.createElement('div');
                lugarDiv.classList.add('form-check');
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'lugar_id';
                input.id = `lugar_${lugar.id}`;
                input.value = lugar.id;
                input.classList.add('form-check-input');
                const label = document.createElement('label');
                label.htmlFor = input.id;
                label.classList.add('form-check-label');
                label.textContent = lugar.nombrelugar;
                lugarDiv.appendChild(input);
                lugarDiv.appendChild(label);
                lugaresList.appendChild(lugarDiv);
            });
        } else {
            lugarContainer.style.display = 'none';
        }
    });
</script>

{{--GRUPO EXISTE--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const grupoInput = document.getElementById("grupo");
        const feedbackDiv = document.createElement("div"); // Contenedor para el mensaje y el botón
        feedbackDiv.style.marginTop = "10px";

        if (!grupoInput) {
            console.error("El elemento con id 'grupo' no se encontró en la página.");
            return;
        }

        grupoInput.parentNode.appendChild(feedbackDiv);

        grupoInput.addEventListener("input", function () {
            const grupo = grupoInput.value.trim();

            // Limpiar contenido del contenedor de feedback
            feedbackDiv.innerHTML = "";

            if (!grupo) {
                console.log("Campo de grupo vacío.");
                return;
            }

            const existingGroups = @json($existingGroups); // Grupos existentes desde el servidor
            console.log("Grupos existentes:", existingGroups);

            if (existingGroups.includes(grupo)) {
                // Crear mensaje
                const mensaje = document.createElement("p");
                mensaje.textContent = "Grupo existente.";
                mensaje.style.color = "blue";
                mensaje.style.marginBottom = "5px";

                // Crear botón
                const modificarBtn = document.createElement("button");
                modificarBtn.textContent = "¡Solo da ENTER!";
                modificarBtn.style.backgroundColor = "#007bff";
                modificarBtn.style.color = "white";
                modificarBtn.style.border = "none";
                modificarBtn.style.padding = "5px 10px";
                modificarBtn.style.borderRadius = "4px";
                modificarBtn.style.cursor = "pointer";

                modificarBtn.addEventListener("click", function () {
                    console.log("Redirigiendo al formulario de edición...");
                    window.location.href = `/grupos/${grupo}/edit`;
                });

                // Añadir mensaje y botón al contenedor
                feedbackDiv.appendChild(mensaje);
                feedbackDiv.appendChild(modificarBtn);
            } else {
                // Crear mensaje para un grupo nuevo
                const mensaje = document.createElement("p");
                mensaje.textContent = "Estás agregando un grupo nuevo.";
                mensaje.style.color = "green";
                feedbackDiv.appendChild(mensaje);
            }
        });
    });
</script>

<style>

    label {
        font-size: 14px;
        font-weight: bold;
        color: #555;
        margin-bottom: 6px;
    }

    input[type="text"], input[type="date"], input[type="number"], select, .form-control-sm {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 8px 10px;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.3s ease-in-out;
    }

    input:focus, select:focus {
        border-color: #007bff;
        outline: none;
    }

    .form-select-sm, .form-control-sm {
        height: 36px;
    }

    button {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Table Styling */
    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    hr {
        border: none;
        height: 1px;
        background-color: #ddd;
        margin: 20px 0;
    }

    /* Rows and Columns */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .col-md-4 {
        flex: 0 0 33.333%;
        max-width: 33.333%;
        padding: 0 10px;
        box-sizing: border-box;
    }

    .text-end {
        text-align: right;
    }

</style>
@endsection