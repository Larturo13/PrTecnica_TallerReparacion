<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'tecnico_id');
    }
    public function getEstadoServicioNombreAttribute()
    {
        $estados = [
            1 => 'Recibido',
            2 => 'Reparando',
            3 => 'Finalizado',
            4 => 'Entregado'
        ];

        return $estados[$this->estado_servicio] ?? 'Desconocido';
    }


    
    protected $casts = [
        'fecha_recepcion' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];
        protected $fillable = [
        'equipo_id',
        'cliente_id',
        'tecnico_id',
        'fecha_recepcion',
        'problema_reportado',
        'diagnostico',
        'solucion',
        'fecha_entrega',
        'estado_servicio',
        'estado',
    ];
    
}
