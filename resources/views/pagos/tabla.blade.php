@extends('menu2')

@section('contenido2')

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('pagos.create') }}" class="btn btn-outline-secondary">Registrar Pago</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Monto</th>
                        <th>Fecha de Pago</th>
                        <th>Comprobante</th>
                        <th>Tipo de Pago</th>
                        <th>Alumno</th>
                        <th colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->monto }}</td>
                        <td>{{ $pago->fechapago }}</td>
                        <td>{{ $pago->comprobante }}</td>
                        <td>{{ $pago->tipopago->tipopago }}</td>
                        <td>{{ $pago->alumno->nombre }}</td>
                        <td><a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pagos->links() }}
        </div>
    </div>
</div>

@endsection
