@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('periodos.create') }}" class="btn btn-outline-secondary">Registrar Periodo</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Periodo</th>
                        <th scope="col">Descripción Corta</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periodos as $periodo)
                    <tr>
                        <td scope="row">{{ $periodo->id }}</td>
                        <td>{{ $periodo->periodo }}</td>
                        <td>{{ $periodo->desccorta }}</td>
                        <td>{{ $periodo->fechaini }}</td>
                        <td>{{ $periodo->fechafin }}</td>
                        <td><a href="{{ route('periodos.edit', $periodo->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('periodos.destroy', $periodo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                        <td><a href="{{ route('periodos.show', $periodo->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $periodos->links() }}
        </div>
    </div>
</div>
