<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnicos';

    protected $fillable = [
        'nombre',
        'especialidad',
        'taller_id',
        'horario_disponible_inicio',
        'horario_disponible_fin',
        'dias_disponibles',
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
