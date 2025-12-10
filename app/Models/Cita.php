<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'fecha',
        'hora',
        'servicio',
        'estado',
        'estado_progreso',
        'taller_id',
        'tecnico_id',
        'tecnico_user_id',
        'user_id',
        'placa_vehiculo',
        'descripcion',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tecnicoUser()
    {
        return $this->belongsTo(User::class, 'tecnico_user_id');
    }

    public function scopeDisponibles($query)
    {
        return $query->whereNull('tecnico_user_id')->where('estado', 'pendiente');
    }

    public function getTecnicoAsignadoAttribute()
    {
        if ($this->tecnico_user_id) {
            return $this->tecnicoUser;
        }
        if ($this->tecnico_id) {
            return $this->tecnico;
        }
        return null;
    }

    public function estaDisponible($fecha, $hora)
    {
        $existe = self::where('taller_id', $this->taller_id)
            ->where('fecha', $fecha)
            ->where('hora', $hora)
            ->where('id', '!=', $this->id)
            ->exists();
        
        return !$existe;
    }
}
