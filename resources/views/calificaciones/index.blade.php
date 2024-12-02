@extends("menu2")

@section("contenido2")

<!-- Importar Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-weight: 700;
        margin-bottom: 20px;
        color: #2c3e50;
        text-align: center;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #3498db;
        color: white;
        font-size: 18px;
        font-weight: 500;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 20px;
    }

    table {
        margin-bottom: 20px;
    }

    th {
        background-color: #2c3e50;
        color: rgb(7, 7, 7);
        text-align: center;
    }

    td {
        text-align: center;
    }

    .btn-link {
        color: white;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .confirm-btn {
        background-color: #28a745;
        color: white;
        font-weight: 500;
    }

    .confirm-btn:hover {
        background-color: #218838;
        color: white;
    }

    .alert-info {
        background-color: #eaf2f8;
        color: #2c3e50;
    }
</style>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="container">
    <br>
    <h1>Asignar Calificaciones</h1>

    @foreach ($grupos as $index => $grupo)
        <div class="card mb-4">
            <div class="card-header">
                <h3>
                    <button type="button" class="btn btn-link text-decoration-none" onclick="toggleGroup({{ $index }})">
                        {{ $grupo->grupo }} - 
                        {{ $grupo->materiaAbierta->materia->nombremateria ?? 'Materia no asignada' }}
                    </button>
                </h3>
            </div>
            <div class="card-body d-none" id="group-details-{{ $index }}">
                <!-- Formulario específico para cada grupo -->
                <form action="{{ route('calificaciones.store') }}" method="POST" id="calificaciones-form-{{ $index }}">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->horarios as $horario)
                                @foreach ($horario->alumnos as $horarioAlumno)
                                    <tr>
                                        <td>
                                            {{ $horarioAlumno->alumno->nombre }}
                                            {{ $horarioAlumno->alumno->apellidop }}
                                            {{ $horarioAlumno->alumno->apellidom }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="calificaciones[{{ $horarioAlumno->alumno->id }}][horario_grupo_id]" 
                                                   value="{{ $horarioAlumno->grupoHorario->id ?? '' }}">
                                            <input type="hidden" name="calificaciones[{{ $horarioAlumno->alumno->id }}][horario_alumno_id]" 
                                                   value="{{ $horarioAlumno->id }}">
                                            <input type="number" 
                                                   name="calificaciones[{{ $horarioAlumno->alumno->id }}][calificacion]" 
                                                   step="0.01" 
                                                   min="0" 
                                                   max="100" 
                                                   class="form-control" 
                                                   value="{{ $horarioAlumno->calificacion->calificacion ?? '' }}" 
                                                   placeholder="Calificación">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    @if (!$grupo->calificacionesCompletas())
                        <!-- Botón de guardar calificaciones específico para este grupo -->
                        <button type="button" class="btn confirm-btn mt-3" data-form-id="calificaciones-form-{{ $index }}">
                            Guardar Calificaciones
                        </button>
                    @else
                        <div class="alert alert-info mt-3">
                            Las calificaciones ya han sido registradas para este grupo.
                        </div>
                    @endif
                </form>
            </div>
        </div>
    @endforeach
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleGroup(index) {
        const details = document.getElementById(`group-details-${index}`);
        if (details.classList.contains('d-none')) {
            details.classList.remove('d-none');
        } else {
            details.classList.add('d-none');
        }
    }

    // Manejar el clic en el botón "Guardar Calificaciones"
    document.querySelectorAll('.confirm-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir envío del formulario inmediato

            const formId = this.getAttribute('data-form-id'); // Obtener el ID del formulario específico

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás realizar cambios después de guardar las calificaciones.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit(); // Enviar el formulario específico
                }
            });
        });
    });
</script>
@endsection
