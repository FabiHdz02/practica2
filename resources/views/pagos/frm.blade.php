@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Estilo del formulario */
    .container h2,
    .container label,
    .container .form-control,
    .container .btn {
        font-family: 'Poppins', sans-serif;
    }

    /* Encabezados */
    .container h2 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 20px;
    }

    /* Etiquetas */
    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
    }

    /* Campos de entrada */
    .form-control, .form-select {
        font-weight: 400;
        font-size: 0.9rem;
        padding: 10px 15px;
    }

    /* Botones */
    .btn {
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
    }

    /* Línea de sección */
    .section-divider {
        width: 60px;
        height: 4px;
        background: #007bff;
        margin-top: -5px;
        margin-bottom: 20px;
        border-radius: 2px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Mensajes -->
            @if(session('mensaje'))
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    {{ session('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger shadow rounded mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Título dinámico -->
            <div class="text-center mb-4">
                <h2 class="text-dark fw-bold">
                    @if ($accion == 'C')
                        Registrar Pago
                    @elseif ($accion == 'E')
                        Editar Pago
                    @elseif ($accion == 'D')
                        Eliminar Pago
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('pagos.store') : 
                    ($accion == 'E' ? route('pagos.update', $pago->id) : 
                    route('pagos.destroy', $pago->id)) 
                }}" 
                method="POST" 
                enctype="multipart/form-data" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Tipo de Pago -->
                <h5 class="fw-bold">Información del Pago</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo_pago_id" class="form-label">Tipo de Pago:</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="tipo_pago_id" 
                            name="tipo_pago_id" 
                            {{ $accion == 'D' ? 'disabled' : 'required' }}
                        >
                            <option value="" disabled {{ old('tipo_pago_id', $pago->tipo_pago_id ?? '') == '' ? 'selected' : '' }}>Seleccione un tipo de pago</option>
                            @foreach ($tipoPagos as $tipoPago)
                                <option 
                                    value="{{ $tipoPago->id }}" 
                                    {{ old('tipo_pago_id', $pago->tipo_pago_id ?? '') == $tipoPago->id ? 'selected' : '' }}
                                >
                                    {{ $tipoPago->tipopago }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Monto -->
                    <div class="col-md-6 mb-3">
                        <label for="monto" class="form-label">Monto:</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="monto" 
                            name="monto" 
                            value="{{ old('monto', $pago->monto ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : 'required' }}
                        >
                    </div>
                </div>

                <!-- Fecha de Pago -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fechapago" class="form-label">Fecha de Pago:</label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechapago" 
                            name="fechapago" 
                            value="{{ old('fechapago', $pago->fechapago ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : 'required' }}
                        >
                    </div>

                    <!-- Comprobante -->
                    <div class="col-md-6 mb-3" id="comprobante-container" style="visibility: hidden; height: 0; overflow: hidden;">
                        <label for="comprobante" class="form-label">Comprobante:</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="comprobante" 
                            name="comprobante" 
                            accept=".pdf,.png,.jpg" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                    </div>
                </div>

                <!-- Alumno -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="alumno_id" class="form-label">Alumno:</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="alumno_id" 
                            name="alumno_id" 
                            {{ $accion == 'D' ? 'disabled' : 'required' }}
                        >
                            <option value="" disabled selected>Seleccione un alumno</option>
                            @foreach ($alumnos as $alumno)
                                <option 
                                    value="{{ $alumno->id }}" 
                                    {{ old('alumno_id', $pago->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}
                                >
                                    {{ $alumno->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center">
                    @if($accion == 'C' || $accion == 'E')
                        <button type="submit" class="btn btn-primary">{{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}</button>
                    @elseif($accion == 'D')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    @endif
                    <a href="{{ route('pagos.index') }}" id="regresarButton" class="btn btn-secondary">Regresar</a>

                    <script>
                        // Obtener la URL de referencia
                        const referer = document.referrer;
                    
                        // Verificar si la URL contiene 'horario_alumnos'
                        if (referer.includes('horario_alumnos')) {
                            // Si contiene 'horario_alumnos', modificar el enlace para redirigir a 'horario_alumnos.index'
                            document.getElementById('regresarButton').setAttribute('href', '{{ route('horario_alumnos.index') }}');
                        }
                        // Verificar si la URL contiene 'alumnos'
                        else if (referer.includes('alumnos')) {
                            // Si contiene 'alumnos', modificar el enlace para redirigir a 'alumnos.index'
                            document.getElementById('regresarButton').setAttribute('href', '{{ route('alumnos.index') }}');
                        }
                        // Verificar si la URL contiene 'documentaciones'
                        else if (referer.includes('documentaciones')) {
                            // Si contiene 'documentaciones', modificar el enlace para redirigir a 'documentaciones.index'
                            document.getElementById('regresarButton').setAttribute('href', '{{ route('documentacions.index') }}');
                        }
                        // Agregar más condiciones para otras rutas según sea necesario
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipoPagoSelect = document.getElementById('tipo_pago_id');
        const comprobanteContainer = document.getElementById('comprobante-container');

        tipoPagoSelect.addEventListener('change', function() {
            const transferenciaId = {{ $tipoPagos->where('tipopago', 'Transferencia')->first()->id ?? 'null' }};
            if (this.value == transferenciaId) {
                comprobanteContainer.style.visibility = 'visible';
                comprobanteContainer.style.height = 'auto';
            } else {
                comprobanteContainer.style.visibility = 'hidden';
                comprobanteContainer.style.height = '0';
            }
        });

        const initialValue = tipoPagoSelect.value;
        if (initialValue == {{ $tipoPagos->where('tipopago', 'Transferencia')->first()->id ?? 'null' }}) {
            comprobanteContainer.style.visibility = 'visible';
            comprobanteContainer.style.height = 'auto';
        }
    });
</script>

@endsection