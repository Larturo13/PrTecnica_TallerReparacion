<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Marca;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $equipos = Equipo::where('estado', '!=', 0)->latest()->get();
        $marcas = Marca::all();
        //


        return view('equipos.equipos', compact('equipos' ,'marcas'));
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
                'marca_id' => 'required|exists:marcas,id',
                'cliente_id' => 'required|exists:clientes,id',
                'tipo' => 'required|integer',
                'modelo' => 'required|string|max:50',
                'numero_serie' => 'required|string|max:50|unique:equipos,numero_serie',
            ]);

            $equipo = new equipo;
            $equipo->marca_id = $request->marca_id;
            $equipo->cliente_id = $request->cliente_id;
            $equipo->tipo = $request->tipo;
            $equipo->modelo = $request->modelo;
            $equipo->numero_serie = $request->numero_serie;
            $equipo->estado = $request->estado ?? 1;
            $equipo->save();

            return redirect()->route('equipos.index')
                            ->with('success', 'Equipo agregado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('equipos.index')
                            ->with('error', 'No se pudo guardar el Equipo: '.$e->getMessage());
        }
    }

    public function edit(Equipo $equipo)
    {
        $marcas = Marca::all(); 
        return view('equipos.edit', compact('equipo', 'marcas'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'numero_serie' => 'required|string|max:50|unique:equipos,numero_serie,' . $equipo->id,
        ]);

        $equipo->marca_id = $request->marca_id;
        $equipo->cliente_id = $request->cliente_id;
        $equipo->tipo = $request->tipo;
        $equipo->modelo = $request->modelo;
        $equipo->numero_serie = $request->numero_serie;
        $equipo->save();


        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente');
    }

    public function eliminarEstado(Equipo $equipo)
    {
        $equipo->estado = 0; // cambiar a inactivo
        $equipo->save();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente');
    }
}
