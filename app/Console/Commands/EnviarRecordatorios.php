<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnviarRecordatorios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citas:recordatorios';

    protected $description = 'Enviar recordatorios de citas para mañana';

    public function handle()
    {
        $manana = now()->addDay()->format('Y-m-d');
        
        $citas = \App\Models\Cita::where('fecha', $manana)
            ->where('estado_progreso', 'pendiente')
            ->with(['user', 'taller'])
            ->get();

        $enviadas = 0;

        foreach ($citas as $cita) {
            \App\Models\Notificacion::create([
                'user_id' => $cita->user_id,
                'titulo' => 'Recordatorio de Cita',
                'mensaje' => 'Recordatorio: Tienes una cita mañana a las ' . date('H:i', strtotime($cita->hora)) . ' en ' . $cita->taller->nombre,
                'leida' => false,
            ]);
            $enviadas++;
        }

        $this->info("Se enviaron {$enviadas} recordatorios de citas.");
        
        return 0;
    }
}
