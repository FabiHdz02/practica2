@extends('menu2')

@section('contenido2')

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('tipopagos.create') }}" class="btn btn-outline-secondary">Registrar Tipo de Pago</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de Pago</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipopagos as $tipopago)
                    <tr>
                        <td scope="row">{{ $tipopago->id }}</td>
                        <td>{{ $tipopago->tipopago }}</td>
                        <td><a href="{{ route('tipopagos.edit', $tipopago->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('tipopagos.destroy', $tipopago->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tipopagos->links() }}
        </div>
    </div>
</div>

@endsection
