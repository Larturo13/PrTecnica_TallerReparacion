@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
  <body class="bg-body-tertiary">
    <div class="container">
      <main>
        <div class="py-5 text-center">
          <h1 class="h2">Usuarios</h1>
        </div>
        <div class="row g-5">
          <div class="">
            <h4 class="mb-3">Formulario de Usuarios</h4>
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
            <form class="needs-validation" action="{{ route('usuarios.store')}}" method="POST"> 
                @csrf
              <div class="row g-3">
                <div class="col-sm-3">
                  <label class="form-label">Nombre Completo</label>
                  <input type="text" class="form-control" placeholder="" name="nombre_completo" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Usuario</label>
                  <input type="text" class="form-control" placeholder="" name="usuario" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Contraseña</label>
                  <input type="password" class="form-control" placeholder="" name="password" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Confirmar Contraseña</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder=""
                    name="password_confirmation"
                    required
                  />
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-sm-4">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" required/>
                        <div class="invalid-feedback">Requerido</div>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" required/>
                        <div class="invalid-feedback">Requerido</div>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                    </div>
                </div>


            </form>
            <h4 class="mb-3">Listado de Usuarios</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($usuarios as $index => $usuario)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $usuario->nombre_completo }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            </td>
                            <td>
                            <form action="{{ route('usuarios.eliminarEstado', $usuario->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro que deseas cambiar el estado de este usuario?')">
                                    Eliminar
                                </button>
                            </form>
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay usuarios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
@endsection