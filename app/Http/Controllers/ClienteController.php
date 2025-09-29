<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::where('estado', '!=', 0)->latest()->get();
        //


        return view('clientes.clientes', compact('clientes'));
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
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'direccion' => 'required|string|max:200',
                'telefono' => 'nullable|regex:/^[0-9]{8,15}$/',
                'correo' => 'required|string|max:100',
            ]);

            $cliente = new cliente;
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->correo = $request->correo;
            $cliente->estado = $request->estado ?? 1;
            $cliente->save();

            return redirect()->route('clientes.index')
                            ->with('success', 'Cliente agregado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                            ->with('error', 'No se pudo guardar el Cliente: '.$e->getMessage());
        }
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'direccion' => 'required|string|max:200',
            'telefono' => 'nullable|regex:/^[0-9]{8,15}$/',
            'correo' => 'required|string|max:100',
        ]);


        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;

        $cliente->save();


        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }

    public function eliminarEstado(Cliente $cliente)
    {
        $cliente->estado = 0; // cambiar a inactivo
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
