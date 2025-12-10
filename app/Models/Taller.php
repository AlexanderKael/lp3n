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
        'latitud',
        'longitud',
        'ciudad',
    ];

    public function tecnicos()
    {
        return $this->hasMany(Tecnico::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function tecnicosUsuarios()
    {
        return $this->hasMany(User::class)->where('role', 'tecnico');
    }

    public function scopeCercanos($query, $lat, $lng, $radio = 10)
    {
        if (!$lat || !$lng) {
            return $query;
        }
        
        return $query->selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitud)) * cos(radians(longitud) - radians(?)) + sin(radians(?)) * sin(radians(latitud)))) AS distancia', [$lat, $lng, $lat])
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->havingRaw('distancia < ?', [$radio])
            ->orderBy('distancia');
    }

    public function horariosDisponibles($fecha)
    {
        $horarios = [];
        
        if (!$this->hora_apertura || !$this->hora_cierre) {
            return $horarios;
        }

        // Convertir hora_apertura y hora_cierre a formato H:i
        $horaApertura = $this->hora_apertura;
        $horaCierre = $this->hora_cierre;
        
        // Si es un objeto Carbon o DateTime, convertir a string
        if (is_object($horaApertura)) {
            $horaApertura = $horaApertura->format('H:i');
        } elseif (strlen($horaApertura) > 5) {
            // Si tiene segundos, tomar solo H:i
            $horaApertura = substr($horaApertura, 0, 5);
        }
        
        if (is_object($horaCierre)) {
            $horaCierre = $horaCierre->format('H:i');
        } elseif (strlen($horaCierre) > 5) {
            $horaCierre = substr($horaCierre, 0, 5);
        }

        // Convertir horas a minutos para facilitar el cálculo
        list($horaInicio, $minutoInicio) = explode(':', $horaApertura);
        list($horaFin, $minutoFin) = explode(':', $horaCierre);
        
        $minutosInicio = (int)$horaInicio * 60 + (int)$minutoInicio;
        $minutosFin = (int)$horaFin * 60 + (int)$minutoFin;
        $intervalo = 30; // 30 minutos

        // Generar horarios disponibles cada 30 minutos basado solo en el horario de atención
        for ($minutos = $minutosInicio; $minutos < $minutosFin; $minutos += $intervalo) {
            $hora = floor($minutos / 60);
            $minuto = $minutos % 60;
            $horaFormato = sprintf('%02d:%02d', $hora, $minuto);
            $horarios[] = $horaFormato;
        }

        return $horarios;
    }

    public function estaAbierto($fecha, $hora)
    {
        if (!$this->hora_apertura || !$this->hora_cierre) {
            return false;
        }

        // Convertir hora_apertura y hora_cierre a formato H:i
        $horaApertura = $this->hora_apertura;
        $horaCierre = $this->hora_cierre;
        
        if (is_object($horaApertura)) {
            $horaApertura = $horaApertura->format('H:i');
        } elseif (strlen($horaApertura) > 5) {
            $horaApertura = substr($horaApertura, 0, 5);
        }
        
        if (is_object($horaCierre)) {
            $horaCierre = $horaCierre->format('H:i');
        } elseif (strlen($horaCierre) > 5) {
            $horaCierre = substr($horaCierre, 0, 5);
        }

        // Convertir horas a minutos para comparación
        list($horaInicio, $minutoInicio) = explode(':', $horaApertura);
        list($horaFin, $minutoFin) = explode(':', $horaCierre);
        list($horaSeleccionada, $minutoSeleccionado) = explode(':', $hora);
        
        $minutosInicio = (int)$horaInicio * 60 + (int)$minutoInicio;
        $minutosFin = (int)$horaFin * 60 + (int)$minutoFin;
        $minutosSeleccionados = (int)$horaSeleccionada * 60 + (int)$minutoSeleccionado;

        // Verificar solo si la hora está dentro del rango de atención
        return $minutosSeleccionados >= $minutosInicio && $minutosSeleccionados < $minutosFin;
    }
}
