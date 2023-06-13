<?php

namespace App\Console;

use App\Models\Absensi;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelIgnition\Recorders\LogRecorder\LogMessage;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // // $schedule->command('inspire')->hourly();

        $shiftPagi = Absensi::where('shift_id', '1');
        $shiftSore = Absensi::where('shift_id', '2');
        if ($shiftPagi) {
            $setTime = '14:00:00';

            $schedule->call(function () use ($setTime) {
                $absensi = Absensi::where('absensi_type_pulang', '==', null)
                ->where('keterangan','masuk')
                ->get();

                foreach ($absensi as $data)
                {
                    $data->absensi_type_pulang = 'Tanpa Absen';
                    $data->save();
                }
            })->dailyAt($setTime);
        } elseif($shiftSore) {
            $setClock = '21:00:00';

            $schedule->call(function () use ($setClock) {
                $absensi = Absensi::where('absensi_type_pulang', '==', null)
                ->where('keterangan','masuk')
                ->get();

                foreach ($absensi as $data)
                {
                    $data->absensi_type_pulang = 'Tanpa Absen';
                    $data->save();
                }
            })->dailyAt($setClock);
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
