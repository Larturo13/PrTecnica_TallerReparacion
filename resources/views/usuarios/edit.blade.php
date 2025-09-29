@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Usuario #{{ $usuario->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" name="nombre_completo" value="{{ old('nombre_completo', $usuario->nombre_completo) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" class="form-control" name="usuario" value="{{ old('usuario', $usuario->usuario) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" class="form-control" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required pattern="[0-9]{8,15}">
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña actual</label>
        <input type="password" class="form-control" name="password_actual">
    </div>

    <div class="mb-3">
        <label class="form-label">Nueva Contraseña (opcional)</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

</div>
@endsection
