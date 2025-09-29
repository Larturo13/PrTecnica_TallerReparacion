<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marcas = Marca::where('estado', '!=', 0)->latest()->get();
        //


        return view('marcas.marcas', compact('marcas'));
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
                'nombre_marca' => 'required|string|max:50',
            ]);

            $marca = new marca;
            $marca->nombre_marca = $request->nombre_marca;
            $marca->estado = $request->estado ?? 1;
            $marca->save();

            return redirect()->route('marcas.index')
                            ->with('success', 'Marca agregado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('marcas.index')
                            ->with('error', 'No se pudo guardar el Marca: '.$e->getMessage());
        }
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre_marca' => 'required|string|max:50',
        ]);


        $marca->nombre_marca = $request->nombre_marca;

        $marca->save();


        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca actualizado correctamente');
    }

    public function eliminarEstado(Marca $marca)
    {
        $marca->estado = 0; // cambiar a inactivo
        $marca->save();

        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminado correctamente');
    }
}
