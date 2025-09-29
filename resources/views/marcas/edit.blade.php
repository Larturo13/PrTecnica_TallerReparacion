@extends('layouts.app')

@section('title', 'Editar Marca')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Marca #{{ $marca->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="needs-validation" action="{{ route('marcas.update', $marca->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-sm-6">
                <label class="form-label">Nombre Marca</label>
                <input type="text" class="form-control" name="nombre_marca" value="{{ old('nombre_marca', $marca->nombre_marca) }}" required>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-end mt-3">
                <button class="btn btn-primary btn-lg" type="submit">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection
