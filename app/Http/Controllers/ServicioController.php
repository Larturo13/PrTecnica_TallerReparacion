<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\Equipo;
use App\Models\Cliente;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicios = Servicio::where('estado', '!=', 0)->latest()->get();
        $usuarios = Usuario::all();
        //


        return view('servicios.servicios', compact('servicios', 'usuarios'));
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

                'equipo_id' => 'required|exists:equipos,id',
                'cliente_id' => 'required|exists:clientes,id',
                'tecnico_id' => 'required|exists:usuarios,id',
                'fecha_recepcion' => 'required|date',
                'problema_reportado' => 'required|string|max:250',

            ]);

            $servicio = new Servicio;
            $servicio->equipo_id = $request->equipo_id;
            $servicio->cliente_id = $request->cliente_id;
            $servicio->tecnico_id = $request->tecnico_id;
            $servicio->fecha_recepcion = $request->fecha_recepcion;
            $servicio->problema_reportado = $request->problema_reportado;
            $servicio->estado_servicio = $request->estado_servicio ?? 1;
            $servicio->estado = $request->estado ?? 1;
            $servicio->save();

            return redirect()->route('servicios.index')
                            ->with('success', 'Servicio agregado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('servicios.index')
                            ->with('error', 'No se pudo guardar el servicio: '.$e->getMessage());
        }
    }

    public function edit(Servicio $servicio)
    {
        $usuarios = Usuario::all(); 
        return view('servicios.edit', compact('servicio', 'usuarios'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'tecnico_id' => 'required|exists:usuarios,id',
            'fecha_recepcion' => 'required|date',
            'problema_reportado' => 'required|string|max:250',
            'diagnostico' => 'nullable|string|max:250',
            'solucion' => 'nullable|string|max:250',
            'fecha_entrega' => 'nullable|date',
            'estado_servicio' => 'required|integer',
            'estado' => 'required|boolean',
        ]);


        $servicio -> equipo_id = $request->equipo_id;
        $servicio -> cliente_id = $request->cliente_id;
        $servicio -> tecnico_id = $request->tecnico_id;
        $servicio -> fecha_recepcion = $request->fecha_recepcion;
        $servicio -> problema_reportado = $request->problema_reportado;
        $servicio -> diagnostico = $request->diagnostico;
        $servicio -> solucion = $request->solucion;
        $servicio -> fecha_entrega = $request->fecha_entrega;
        $servicio -> estado_servicio = $request->estado_servicio;
        $servicio -> estado = $request->estado;
        $servicio->save();

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }
    public function EliminacionEstado(Servicio $servicio)
    {
        $servicio->estado = $servicio->estado ? 0 : 1;
        $servicio->save();

        $mensaje = $servicio->estado ? 'Servicio activado correctamente' : 'Servicio eliminado correctamente';

        return redirect()->route('servicios.index')->with('success', $mensaje);
    }

}
