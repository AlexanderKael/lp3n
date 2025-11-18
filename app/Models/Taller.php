<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'talleres';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'hora_apertura',
        'hora_cierre',
        'dias_atencion',
    ];

    public function tecnicos()
    {
        return $this->hasMany(Tecnico::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
