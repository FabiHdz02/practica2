@extends('menu2')

@section('contenido2')

@if(session('mensaje'))
    <div class="alert alert-info alert-dismissible fade show text-center shadow rounded-pill mb-4" role="alert">
        <strong>{{ session('mensaje') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Título -->
            <h2 class="text-center mb-4 text-dark fw-bold">
                <i class="fas fa-book text-primary"></i> Gestión de Materias
            </h2>

            <!-- Botón centrado -->
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('materias.create') }}" class="btn btn-primary btn-lg shadow rounded-pill px-4">
                    <i class="fas fa-plus-circle"></i> Registrar Nueva Materia
                </a>
            </div>

            <!-- Tabla -->
            <div class="table-responsive shadow rounded" style="border-radius: 20px; overflow: hidden; max-width: 1100px; margin: 0 auto;">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 10%;">ID Materia</th>
                            <th style="width: 20%;">Nombre de la Materia</th>
                            <th style="width: 10%;">Nivel</th>
                            <th style="width: 15%;">Nombre Corto</th>
                            <th style="width: 15%;">Modalidad</th>
                            <th style="width: 15%;">Retícula</th>
                            <th style="width: 10%;">Semestre</th>
                            <th colspan="3" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($materias as $materia)
                        <tr class="hover-shadow">
                            <td class="fw-bold">{{ $materia->idmateria }}</td>
                            <td>{{ $materia->nombremateria }}</td>
                            <td>{{ $materia->nivel }}</td>
                            <td>{{ $materia->nombrecorto }}</td>
                            <td>{{ $materia->modalidad }}</td>
                            <td>{{ $materia->reticula->descripcion ?? 'Sin asignar' }}</td>
                            <td>{{ $materia->semestre }}</td>
                            <td class="text-center">
                                <a href="{{ route('materias.edit', $materia->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    Editar
                                </a>
                            </td>
                            <td class="text-center">
                                <!-- Botón Eliminar -->
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill delete-btn" 
                                        data-id="{{ $materia->id }}" data-action="{{ route('materias.destroy', $materia->id) }}">
                                    Eliminar
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('materias.show', $materia->id) }}" class="btn btn-outline-info btn-sm rounded-pill">
                                    Ver
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $materias->links() }}
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Escucha clics en los botones de eliminar
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Evita el envío inmediato del formulario
            const actionUrl = this.getAttribute('data-action'); // Ruta de eliminación
            const id = this.getAttribute('data-id'); // ID del elemento

            Swal.fire({
                title: '¿Estás seguro?',
                text: `No podrás revertir esto. La materia con ID ${id} será eliminada.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarla',
                cancelButtonText: 'Cancelar',
                showClass: {
                    popup: 'animate_animated animate_fadeInDown'
                },
                hideClass: {
                    popup: 'animate_animated animate_fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear un formulario para enviar el DELETE
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;

                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

@endsection