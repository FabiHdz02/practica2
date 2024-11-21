@extends('menu2')

@section('contenido2')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">
                {{ $accion == 'C' ? 'Registrar Pago' : 'Editar Pago' }}
            </h2>

            <form action="{{ $accion == 'C' ? route('pagos.store') : route('pagos.update', $pago->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($accion == 'E')
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="monto">Monto:</label>
                    <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="{{ old('monto', $pago->monto ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="fechapago">Fecha de Pago:</label>
                    <input type="date" class="form-control" id="fechapago" name="fechapago" value="{{ old('fechapago', $pago->fechapago ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="comprobante">Comprobante:</label>
                    <input type="file" class="form-control" id="comprobante" name="comprobante" accept=".pdf,.png">
                    @error('comprobante')
                        <div class="text-danger">Error: {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo_pago_id">Tipo de Pago:</label>
                    <select class="form-select" id="tipo_pago_id" name="tipo_pago_id" required>
                        <option value="" disabled selected>Seleccione un tipo de pago</option>
                        @foreach ($tipoPagos as $tipoPago)
                            <option value="{{ $tipoPago->id }}" {{ old('tipo_pago_id', $pago->tipo_pago_id ?? '') == $tipoPago->id ? 'selected' : '' }}>
                                {{ $tipoPago->tipopago }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alumno_id">Alumno:</label>
                    <select class="form-select" id="alumno_id" name="alumno_id" required>
                        <option value="" disabled selected>Seleccione un alumno</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('alumno_id', $pago->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

@endsection
