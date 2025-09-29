@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
  <body class="bg-body-tertiary">
    <div class="container">
      <main>
        <div class="py-5 text-center">
          <h1 class="h2">Equipos</h1>
        </div>
        <div class="row g-5">
          <div class="">
            <h4 class="mb-3">Formulario de Equipos</h4>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
            <form class="needs-validation" action="{{ route('equipos.store')}}" method="POST"> 
                @csrf
              <div class="row g-3">
                <div class="col-sm-3">
                  <label class="form-label">Marca</label>
                    <select class="form-select" name="marca_id" id="">
                        @foreach ($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre_marca}}</option>
                        @endforeach
                    </select>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Cliente</label>
                  <input type="text" class="form-control" placeholder="" name="cliente_id" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo de Equipo</label>
                    <select class="form-select" name="tipo" required>
                        <option value="1" {{ isset($equipo) && $equipo->tipo == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="2" {{ isset($equipo) && $equipo->tipo == 'PC Escritorio' ? 'selected' : '' }}>PC Escritorio</option>
                        <option value="3" {{ isset($equipo) && $equipo->tipo == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                        <option value="4" {{ isset($equipo) && $equipo->tipo == 'Router' ? 'selected' : '' }}>Router</option>
                        <option value="5" {{ isset($equipo) && $equipo->tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('tipo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Modelo</label>
                  <input type="text" class="form-control" placeholder="" name="modelo" required/>
                  <div class="invalid-feedback">
                    Requerido
                    </div>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-sm-6">
                    <label class="form-label">Número de Serie</label>
                    <input type="text" class="form-control" placeholder="" name="numero_serie" required/>
                    <div class="invalid-feedback">
                        Requerido
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                    </div>
                </div>


            </form>
            <h4 class="mb-3">Listado de Equipos</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Número de Serie</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($equipos as $index => $equipo)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $equipo->marca->nombre_marca ?? 'Sin Marca' }}</td> 
                            <td>{{ $equipo->cliente_id }}</td>
                            <td>{{ $equipo->tipo_texto }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->numero_serie }}</td>
                            <td>
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            </td>
                            <td>
                            <form action="{{ route('equipos.eliminarEstado', $equipo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro que deseas cambiar el estado de este equipo?')">
                                    Eliminar
                                </button>
                            </form>
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay equipos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
@endsection