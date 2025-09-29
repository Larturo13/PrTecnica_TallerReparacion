<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marca;

class Equipo extends Model
{
    use HasFactory;
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    protected $fillable = ['nombre_marca']; 
    public function getTipoTextoAttribute()
    {
        $tipos = [
            1 => 'Laptop',
            2 => 'PC Escritorio',
            3 => 'Impresora',
            4 => 'Router',
            5 => 'Otro',
        ];

        return $tipos[$this->tipo] ?? 'Desconocido';
    }
}
