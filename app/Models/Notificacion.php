<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'titulo',
        'mensaje',
        'user_id',
        'leida',
    ];

    protected $casts = [
        'leida' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
