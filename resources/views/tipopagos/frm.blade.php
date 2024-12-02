@extends('menu2')

@section('contenido2')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #fff;
        padding: 30px 0;
        text-align: center;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .container h1, 
    .container label, 
    .container .form-control, 
    .container .btn {
        font-family: 'Poppins', sans-serif;
    }

    /* Encabezados */
    .container h1 {
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
    .form-select {
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
</style>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">
            @if ($accion == 'C')
                Registrar Tipo de Pago
            @elseif ($accion == 'E')
                Editar Tipo de Pago
            @endif
        </h1>
    </div>
</section>

<section class="tech-stack">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
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

                <!-- Formulario -->
                <form 
                    action="{{ $accion == 'C' ? route('tipopagos.store') : route('tipopagos.update', $tipoPago->id) }}" 
                    method="POST" 
                    class="p-5 rounded shadow-lg bg-gradient"
                    style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
                >
                    @csrf
                    @if ($accion == 'E') @method('PUT') @endif

                    <!-- Tipo de Pago -->
                    <div class="row mb-3">
                        <label for="tipopago" class="col-sm-4 col-form-label">Tipo de Pago:</label>
                        <div class="col-sm-8">
                            <select 
                                class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                                id="tipopago" 
                                name="tipopago" 
                                required
                                {{ $accion == 'D' ? 'disabled' : '' }}
                            >
                                <option value="" disabled selected>Seleccione un tipo de pago</option>
                                <option 
                                    value="Banco" 
                                    {{ old('tipopago', $tipoPago->tipopago ?? '') == 'Banco' ? 'selected' : '' }}
                                >Banco</option>
                                <option 
                                    value="Transferencia" 
                                    {{ old('tipopago', $tipoPago->tipopago ?? '') == 'Transferencia' ? 'selected' : '' }}
                                >Transferencia</option>
                            </select>
                            @error('tipopago')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                            {{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}
                        </button>
                        <a href="{{ route('tipopagos.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection