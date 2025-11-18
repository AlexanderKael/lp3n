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
        'taller_id',
        'tecnico_id',
        'user_id',
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
}
