@extends('layouts.app')

@section('title', 'Editar Equipo')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Equipo #{{ $equipo->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="needs-validation" action="{{ route('equipos.update', $equipo->id) }}" method="POST"> 
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-sm-3">
                <label class="form-label">Marca</label>
                <select class="form-select" name="marca_id" required>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ $equipo->marca_id == $marca->id ? 'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Requerido</div>
            </div>

            <div class="col-sm-3">
                <label class="form-label">Cliente</label>
                <input type="text" class="form-control" name="cliente_id" value="{{ $equipo->cliente_id }}" required/>
                <div class="invalid-feedback">Requerido</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tipo de Equipo</label>
                <select class="form-select" name="tipo" required>
                    <option value="1" {{ $equipo->tipo == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="2" {{ $equipo->tipo == 'PC Escritorio' ? 'selected' : '' }}>PC Escritorio</option>
                    <option value="3" {{ $equipo->tipo == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                    <option value="4" {{ $equipo->tipo == 'Router' ? 'selected' : '' }}>Router</option>
                    <option value="5" {{ $equipo->tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-3">
                <label class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="{{ $equipo->modelo }}" required/>
                <div class="invalid-feedback">Requerido</div>
            </div>

            <div class="row g-3 align-items-end">
                <div class="col-sm-6">
                    <label class="form-label">Número de Serie</label>
                    <input type="text" class="form-control" name="numero_serie" value="{{ $equipo->numero_serie }}" required/>
                    <div class="invalid-feedback">Requerido</div>
                </div>

                <div class="col-6 d-flex justify-content-end">
                    <button class="btn btn-primary btn-lg" type="submit">Actualizar</button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
