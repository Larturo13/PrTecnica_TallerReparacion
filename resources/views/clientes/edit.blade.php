@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Cliente #{{ $cliente->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="needs-validation" action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-sm-6">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="{{ old('apellido', $cliente->apellido) }}" required>
                @error('apellido')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" value="{{ old('correo', $cliente->correo) }}" required>
                @error('correo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required pattern="[0-9]{8,15}">
                @error('telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                @error('direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-end mt-3">
                <button class="btn btn-primary btn-lg" type="submit">Actualizar Cliente</button>
            </div>
        </div>
    </form>
</div>
@endsection
