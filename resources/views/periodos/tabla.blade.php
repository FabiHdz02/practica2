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
                <i class="fas fa-calendar-alt text-primary"></i> Gestión de Periodos
            </h2>

            <!-- Botón centrado -->
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('periodos.create') }}" class="btn btn-primary btn-lg shadow rounded-pill px-4">
                    <i class="fas fa-plus-circle"></i> Registrar Nuevo Periodo
                </a>
            </div>

            <!-- Tabla -->
            <div class="table-responsive shadow rounded" style="border-radius: 20px; overflow: hidden; max-width: 1100px; margin: 0 auto;">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">Periodo</th>
                            <th style="width: 30%;">Descripción</th>
                            <th style="width: 15%;">Fecha Inicio</th>
                            <th style="width: 15%;">Fecha Fin</th>
                            <th colspan="3" style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($periodos as $periodo)
                        <tr class="hover-shadow">
                            <td class="fw-bold">{{ $periodo->id }}</td>
                            <td>{{ $periodo->periodo }}</td>
                            <td>{{ $periodo->desccorta }}</td>
                            <td>{{ $periodo->fechaini }}</td>
                            <td>{{ $periodo->fechafin }}</td>
                            <td class="text-center">
                                <a href="{{ route('periodos.edit', $periodo->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    Editar
                                </a>
                            </td>
                            <td class="text-center">
                                <!-- Botón Eliminar -->
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill delete-btn" 
                                        data-id="{{ $periodo->id }}" data-action="{{ route('periodos.destroy', $periodo->id) }}"                                        >
                                    Eliminar
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('periodos.show', $periodo->id) }}" class="btn btn-outline-info btn-sm rounded-pill">
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
                {{ $periodos->links() }}
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
                text: `No podrás revertir esto. El periodo ${id} será eliminado.`,
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