@extends('menu2')

@section('contenido2')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Título -->
            <h2 class="text-center mb-4 text-dark fw-bold">
                <i class="fas fa-users text-primary"></i> Gestión de Grupos
            </h2>

            <!-- Botón Registrar Grupo -->
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('grupos.create') }}" class="btn btn-primary btn-lg shadow rounded-pill px-4">
                    <i class="fas fa-plus-circle"></i> Registrar Grupo
                </a>
            </div>

            <!-- Tabla -->
            <div class="table-responsive shadow rounded" style="border-radius: 20px; overflow: hidden; max-width: 1200px; margin: 0 auto;">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 10%;">Grupo</th>
                            <th style="width: 25%;">Descripción</th>
                            <th style="width: 15%;">Máximo de Alumnos</th>
                            <th style="width: 15%;">Fecha</th>
                            <th style="width: 15%;">Periodo</th>
                            <th style="width: 15%;">Materia Abierta</th>
                            <th style="width: 15%;">Acciones</th>
                            <th style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($grupos as $grupo)
                        <tr class="hover-shadow">
                            <td class="fw-bold">{{ $grupo->grupo }}</td>
                            <td>{{ $grupo->descripcion }}</td>
                            <td>{{ $grupo->maxalumnos }}</td>
                            <td>{{ \Carbon\Carbon::parse($grupo->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $grupo->periodo->periodo ?? 'Sin Asignar' }}</td>
                            <td>{{ $grupo->materiaAbierta->materia->nombremateria ?? 'Sin Asignar' }}</td>
                            <td class="text-center">
                                <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    Editar
                                </a>
                               
                            </td>
                            <td> <button type="button" class="btn btn-outline-danger btn-sm rounded-pill delete-btn" 
                                data-id="{{ $grupo->id }}" data-action="{{ route('grupos.destroy', $grupo->id) }}">
                            Eliminar
                        </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $grupos->links() }}
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
                text: `No podrás revertir esto. El grupo con ID ${id} será eliminado.`
                ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo',
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