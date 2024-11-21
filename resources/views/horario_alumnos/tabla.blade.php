@extends('menu2')

@section('contenido2')
<div class="container mt-5">
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="table-responsive-md">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="mb-3"><br>
                    <a href="{{ route('horario_alumnos.create') }}" class="btn btn-outline-secondary">Asignar Nuevo Horario</a>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Grupo Hora</th>
                            <th scope="col">Grupo Dia</th>
                            <th scope="col" colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horarioAlumnos as $horarioAlumno)
                        <tr>
                            <td scope="row">{{ $horarioAlumno->id }}</td>
                            <td>{{ $horarioAlumno->alumno->nombre }} {{ $horarioAlumno->alumno->apellidom }} {{ $horarioAlumno->alumno->apellidop }}</td>
                            <td>{{ $horarioAlumno->grupoHorario->grupo->grupo }}</td>
                            <td>{{ $horarioAlumno->grupoHorario->hora }}</td>
                            @php
                            $diasSemana = [
                                1 => 'Lunes',
                                2 => 'Martes',
                                3 => 'Miércoles',
                                4 => 'Jueves',
                                5 => 'Viernes'
                            ];
                             @endphp
                            <td>{{ $diasSemana[$horarioAlumno->grupoHorario->dia] ?? 'Día no válido' }}</td>                                                    <td>
                                <a href="{{ route('horario_alumnos.edit', $horarioAlumno->id) }}" class="btn btn-outline-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('horario_alumnos.destroy', $horarioAlumno->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $horarioAlumnos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
