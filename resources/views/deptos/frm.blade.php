@extends("menu2")

@section("contenido2")

<ul>
  @foreach ($errors->all() as $error)
      <li>
        {{ $error }}
      </li>
  @endforeach
</ul>

@if ($accion == 'C')
<h2>Registrando Departamento</h2>
<form action="{{ route('deptos.store') }}" method="POST">
@elseif ($accion == 'E')
<h2>Editando Departamento</h2>
<form action="{{ route('deptos.update', $departamento->iddepto) }}" method="POST">
@elseif ($accion == 'D')
<h2>Eliminar Departamento</h2>
<form action="{{ route('deptos.destroy', $departamento) }}" method="POST">
@endif

@csrf
    <div class="row mb-3">
      <label for="iddepto" class="col-sm-3 col-form-label">ID Departamento: </label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="iddepto" name="iddepto" value="{{ old('iddepto', $departamento->iddepto) }}" {{$des}}>
        @error("iddepto")
          <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
      </div>
    </div>

    <div class="row mb-3">
        <label for="nombredepto" class="col-sm-3 col-form-label">Nombre Departamento: </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="nombredepto" name="nombredepto" value="{{ old('nombredepto', $departamento->nombredepto) }}" {{$des}}>
          @error("nombredepto")
            <p class="text-danger">Error en: {{ $message }}</p>
          @enderror 
        </div>
    </div>

    <div class="row mb-3">
        <label for="nombremediano" class="col-sm-3 col-form-label">Nombre Mediano: </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="nombremediano" name="nombremediano" value="{{ old('nombremediano', $departamento->nombremediano) }}" {{$des}}>
          @error("nombremediano")
            <p class="text-danger">Error en: {{ $message }}</p>
          @enderror 
        </div>
    </div>

    <div class="row mb-3">
        <label for="nombrecorto" class="col-sm-3 col-form-label">Nombre Corto: </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $departamento->nombrecorto) }}" {{$des}}>
          @error("nombrecorto")
            <p class="text-danger">Error en: {{ $message }}</p>
          @enderror 
        </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
      <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</form> 

@endsection
