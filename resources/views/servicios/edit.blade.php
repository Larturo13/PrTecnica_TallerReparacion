@extends('layouts.app')

@section('title', 'Editar Servicio')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Servicio #{{ $servicio->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" class="needs-validation">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-sm-4">
                <label class="form-label">ID del Equipo</label>
                <input type="text" class="form-control" name="equipo_id" value="{{ $servicio->equipo_id }}" required>
            </div>

            <div class="col-sm-4">
                <label class="form-label">ID del Cliente</label>
                <input type="text" class="form-control" name="cliente_id" value="{{ $servicio->cliente_id }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Técnico</label>
                <select class="form-select" name="tecnico_id" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $usuario->id == $servicio->tecnico_id ? 'selected' : '' }}>
                            {{ $usuario->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Problema Reportado</label>
                <input type="text" class="form-control" name="problema_reportado" value="{{ $servicio->problema_reportado }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Diagnóstico</label>
                <input type="text" class="form-control" name="diagnostico" value="{{ $servicio->diagnostico }}">
            </div>

            <div class="col-12">
                <label class="form-label">Solución</label>
                <input type="text" class="form-control" name="solucion" value="{{ $servicio->solucion }}">
            </div>

            <div class="col-6">
                <label class="form-label">Fecha de Recepción</label>
                <input type="date" class="form-control" name="fecha_recepcion" value="{{ $servicio->fecha_recepcion->format('Y-m-d') }}" required>
            </div>

            <div class="col-6">
                <label class="form-label">Fecha de Entrega</label>
                <input type="date" class="form-control" name="fecha_entrega" value="{{ $servicio->fecha_entrega ? $servicio->fecha_entrega->format('Y-m-d') : '' }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Estado del Servicio</label>
                <select class="form-select" name="estado_servicio">
                    <option value="1" {{ $servicio->estado_servicio == 1 ? 'selected' : '' }}>Recibido</option>
                    <option value="2" {{ $servicio->estado_servicio == 2 ? 'selected' : '' }}>Reparando</option>
                    <option value="3" {{ $servicio->estado_servicio == 3 ? 'selected' : '' }}>Finalizado</option>
                    <option value="4" {{ $servicio->estado_servicio == 4 ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <select class="form-select" name="estado">
                    <option value="1" {{ $servicio->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $servicio->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('servicios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
