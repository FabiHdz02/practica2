@extends('menu2')

@section('contenido2')

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('turnos.create') }}" class="btn btn-outline-secondary">Registrar Turno</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Código Canal</th>
                        <th>Alumno</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ $turno->id }}</td>
                        <td>{{ $turno->fecha }}</td>
                        <td>{{ $turno->hora }}</td>
                        <td>{{ $turno->codigocanal }}</td>
                        <td>{{ $turno->alumno->nombre }}</td>
                        <td><a href="{{ route('turnos.edit', $turno->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $turnos->links() }}
        </div>
    </div>
</div>

@endsection
