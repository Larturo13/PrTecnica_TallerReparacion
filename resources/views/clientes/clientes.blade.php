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
          <h1 class="h2">Clientes</h1>
        </div>
        <div class="row g-5">
          <div class="">
            <h4 class="mb-3">Formulario de Clientes</h4>
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
            <form class="needs-validation" action="{{ route('clientes.store')}}" method="POST"> 
                @csrf
              <div class="row g-3">
                <div class="col-sm-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" class="form-control" placeholder="" name="nombre" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Apellido</label>
                  <input type="text" class="form-control" placeholder="" name="apellido" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Direccion</label>
                  <input type="text" class="form-control" placeholder="" name="direccion" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-sm-6">
                    <label class="form-label">Telefono</label>
                    <input type="text" class="form-control" placeholder="" name="telefono" required/>
                    <div class="invalid-feedback">
                        Requerido
                    </div>
                    </div>
                    <div class="col-sm-3">
                    <label class="form-label">Correo</label>
                    <input type="email" class="form-control" placeholder="" name="correo" required/>
                    <div class="invalid-feedback">
                        Requerido
                    </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                    </div>
                </div>


            </form>
            <h4 class="mb-3">Listado de Clientes</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($clientes as $index => $cliente)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $cliente->nombre}}</td> 
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->correo }}</td>
                            <td>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            </td>
                            <td>
                            <form action="{{ route('clientes.eliminarEstado', $cliente->id) }}" method="POST" class="d-inline">
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