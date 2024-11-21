@extends('menu2')

@section('contenido2')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

            @if ($accion == 'C')
                <h2 class="text-center">Registrar Tipo de Pago</h2>
                <form action="{{ route('tipopagos.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editar Tipo de Pago</h2>
                <form action="{{ route('tipopagos.update', $tipoPago->id) }}" method="POST">
                @csrf
                @method('PUT')
            @endif

            @csrf

            <div class="row mb-3">
                <label for="tipopago" class="col-sm-4 col-form-label">Tipo de Pago:</label>
                <div class="col-sm-8">
                    <select class="form-select" id="tipopago" name="tipopago">
                        <option value="" disabled selected>Seleccione un tipo de pago</option>
                        <option value="Banco" {{ old('tipopago', $tipoPago->tipopago) == 'Banco' ? 'selected' : '' }}>Banco</option>
                        <option value="Transferencia" {{ old('tipopago', $tipoPago->tipopago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                    </select>
                    @error('tipopago')
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>            

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('tipopagos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
