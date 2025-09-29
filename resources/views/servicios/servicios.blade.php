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
          <h1 class="h2">Servicios</h1>
        </div>
        <div class="row g-5">
          <div class="">
            <h4 class="mb-3">Formulario de Servicios</h4>
            <!-- <form class="needs-validation" novalidate> -->
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
            <form class="needs-validation" action="{{ route('servicios.store')}}" method="POST"> 
                @csrf
              <div class="row g-3">
                <div class="col-sm-4">
                  <label class="form-label">ID del Equipo</label>
                  <input type="text" class="form-control" placeholder="" name="equipo_id" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-sm-4">
                  <label class="form-label">ID del Cliente</label>
                  <input type="text" class="form-control" placeholder="" name="cliente_id" required/>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Tecnico</label>
                    <select class="form-select" name="tecnico_id" id="">
                        @foreach ($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->nombre_completo}}</option>
                        @endforeach
                    </select>
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <div class="col-12">
                  <label class="form-label">Problema Reportado</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder=""
                    name="problema_reportado"
                    required
                  />
                  <div class="invalid-feedback">
                    Requerido
                  </div>
                </div>
                <!-- <div class="col-12">
                  <label class="form-label">Diagnostico</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder=""
                    name="diagnostico"
                  />
                    <div class="invalid-feedback">
                        Requerido
                    </div>
                </div>
                <div class="col-12">
                  <label class="form-label">Solucion</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder=""
                    name="solucion"
                  />
                    <div class="invalid-feedback">
                        Requerido
                    </div>
                </div> -->
                <div class="row g-3 align-items-end">
                    <div class="col-sm-4">
                        <label class="form-label">Fecha de Ingreso</label>
                        <input type="date" class="form-control" name="fecha_recepcion" required/>
                        <div class="invalid-feedback">Requerido</div>
                    </div>
                    <!-- <div class="col-sm-5">
                        <label class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" name="fecha_entrega"/>
                        <div class="invalid-feedback">Requerido</div>
                    </div> -->
                    <div class="col-8 d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                  <label class="form-label">Estado del Servicio</label>
                    <select class="form-select name="estado_servicio" id="">
                        <option value="1">Recibido</option>
                        <option value="2">Reparando</option>
                        <option value="3">Finalizado</option>
                        <option value="4">Entregado</option>
                    </select>
                    <div class="invalid-feedback">
                    Requerido
                  </div>
                </div> -->

            </form>
            <h4 class="mb-3">Listado de Servicios</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID del Equipo</th>
                        <th scope="col">ID del Cliente</th>
                        <th scope="col">Tecnico Asignado</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Problema Reportado</th>
                        <th scope="col">Estado del Servicio</th>
                        <th scope="col">Diagnostico</th>
                        <th scope="col">Solucion</th>
                        <th scope="col">Fecha de Entrega</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($servicios as $index => $servicio)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $servicio->equipo_id }}</td>
                            <td>{{ $servicio->cliente_id }}</td>
                            <td>{{ $servicio->tecnico->nombre_completo ?? 'Sin asignar' }}</td>
                            <td>{{ $servicio->fecha_recepcion }}</td>
                            <td>{{ $servicio->problema_reportado }}</td>
                            <td>{{ $servicio->estado_servicio_nombre }}</td>
                            <td>{{ $servicio->diagnostico }}</td>
                            <td>{{ $servicio->solucion }}</td>
                            <td>{{ $servicio->fecha_entrega }}</td>
                            <td>
                                <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            </td>
                            <td>
                              <form action="{{ route('servicios.eliminarEstado', $servicio->id) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('PUT')
                                  <button type="submit" class="btn btn-danger btn-sm"
                                      onclick="return confirm('¿Estás seguro que deseas cambiar el estado de este servicio?')">
                                      Eliminar
                                  </button>
                              </form>
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay servicios registrados</td>
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