<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = Usuario::where('estado', '!=', 0)->latest()->get();
        //


        return view('usuarios.usuarios', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nombre_completo' => 'required|string|max:100',
                'usuario' => 'required|string|max:100|unique:usuarios,usuario',
                'password' => 'required|string|min:6|confirmed',
                'correo' => 'required|email|unique:usuarios,correo',
                'telefono' => 'nullable|regex:/^[0-9]{8,15}$/',
            ]);

            $usuario = new usuario;
            $usuario->nombre_completo = $request->nombre_completo;
            $usuario->usuario = $request->usuario;
            $usuario->password = bcrypt($request->password);
            $usuario->correo = $request->correo;
            $usuario->telefono = $request->telefono;
            $usuario->estado = $request->estado ?? 1;
            $usuario->save();

            return redirect()->route('usuarios.index')
                            ->with('success', 'Usuario agregado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                            ->with('error', 'No se pudo guardar el Usuario: '.$e->getMessage());
        }
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'usuario' => 'required|string|max:50',
            'correo' => 'required|string|max:100',
            'telefono' => 'nullable|regex:/^[0-9]{8,15}$/',
            'password' => 'nullable|string|min:6|confirmed',
            'password_actual' => 'nullable|string',
        ]);
        if ($request->filled('password_actual') || $request->filled('password')) {

        if (!Hash::check($request->password_actual, $usuario->password)) {
            return back()
                ->withErrors(['password_actual' => 'La contraseña actual no es correcta'])
                ->withInput();
        }

        $usuario->password = Hash::make($request->password);
        }

        $usuario->nombre_completo = $request->nombre_completo;
        $usuario->usuario = $request->usuario;
        $usuario->correo = $request->correo;
        $usuario->telefono = $request->telefono;
        $usuario->save();


        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function eliminarEstado(Usuario $usuario)
    {
        $usuario->estado = 0; // cambiar a inactivo
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

}
