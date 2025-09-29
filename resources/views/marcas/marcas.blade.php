@extends('layouts.app')

@section('title', 'Marcas')

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
          <h1 class="h2">Marcas</h1>
        </div>
        <div class="row g-5">
          <div class="">
            <h4 class="mb-3">Formulario de Marcas</h4>
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
            <form class="needs-validation" action="{{ route('marcas.store')}}" method="POST"> 
                @csrf
              <div class="row g-3">
                
                <div class="row g-3 align-items-end">
                    <div class="col-sm-6">
                    <label class="form-label">Nombre Marca</label>
                    <input type="text" class="form-control" placeholder="" name="nombre_marca" required/>
                    <div class="invalid-feedback">
                        Requerido
                    </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                    </div>
                </div>


            </form>
            <h4 class="mb-3">Listado de Marcas</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de Marca</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($marcas as $index => $marca)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $marca->nombre_marca}}</td> 
                            <td>
                                <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            </td>
                            <td>
                            <form action="{{ route('marcas.eliminarEstado', $marca->id) }}" method="POST" class="d-inline">
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
                            <td colspan="4" class="text-center">No hay clientes registrados</td>
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