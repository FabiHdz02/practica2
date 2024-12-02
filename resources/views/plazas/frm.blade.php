@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Formulario */
    .container h2, 
    .container h5, 
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
            <!-- Errores de validación -->
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
                        Registrar Plaza
                    @elseif ($accion == 'E')
                        Editar Plaza
                    @elseif ($accion == 'D')
                        Eliminar Plaza
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('plazas.store') : 
                    ($accion == 'E' ? route('plazas.update', $plaza->id) : 
                    route('plazas.destroy', $plaza->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Detalles de la Plaza -->
                <h5 class="fw-bold">Detalles de la Plaza</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- ID Plaza -->
                    <div class="col-md-6 mb-3">
                        <label for="idplaza" class="form-label">ID Plaza</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="idplaza" 
                            name="idplaza" 
                            value="{{ old('idplaza', $plaza->idplaza ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("idplaza")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre Plaza -->
                    <div class="col-md-6 mb-3">
                        <label for="nombreplaza" class="form-label">Nombre Plaza</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombreplaza" 
                            name="nombreplaza" 
                            value="{{ old('nombreplaza', $plaza->nombreplaza ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("nombreplaza")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sección: Botones -->
                <div class="text-center mt-4">
                    @if ($accion == 'C' || $accion == 'E')
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                            {{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}
                        </button>
                    @elseif ($accion == 'D')
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">Eliminar</button>
                    @endif
                    <a href="{{ route('plazas.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
