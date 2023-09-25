<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AbsenUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:absen-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'how to run = php artisan scheduler:work';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Handle to auto send absensi_type_pulang when time has passed
        $kantor = Shift::where('client_id', 1)->first(); 
        $shift = Shift::all();
        $abs = Absensi::all();
        $user = User::all();

        // Handle the case where if not present pulang
        // if != client Kantor

        foreach ($user as $u) {
            $userId = $u->id;
            foreach ($abs as $key) {
                if ($key->user_id == $userId && $key->kerjasama->client_id != 1) {
                    foreach ($shift as $s) {
                        if($key->shift_id == $s->id && $key->absensi_type_masuk > $s->jam_start && $key->keterangan != 'izin') 
                        {
                            Absensi::where('id', $key->id)->update(['keterangan' => 'telat']);
                        }
                        if($key->shift_id == $s->id && $key->absensi_type_pulang == null && Carbon::now()->format('H:m:s') > $key->shift->jam_end && $key->keterangan != 'izin') 
                        {
                            Absensi::where('id', $key->id)->update(['absensi_type_pulang' => 'Tidak Absen Pulang']);
                        }
                    }  
                }
            }
        }

    //Handle Shift Kantor

        if ($kantor && Carbon::now()->format('H:m:s') > '08:00:00') {
            if ($kantor != null) {
                foreach ($abs as $key) {
                    if ($key->absensi_type_masuk > '08:01:00' && $key->shift->client_id == 1 && $key->absensi_type_pulang == null && $key->keterangan == 'masuk') {
                        Absensi::where('id', $key->id)->update(['keterangan' => 'telat']);
                    }elseif($key->absensi_type_masuk > '08:01:00' && $key->shift->client_id == 1 && $key->absensi_type_pulang != null && $key->keterangan == 'masuk') {
                        Absensi::where('id', $key->id)->update(['keterangan' => 'telat']);
                    }  
                }
            }
        }

        if ($kantor && Carbon::now()->format('H:m:s') > '17:00:00') {
            if ($kantor != null) {
                foreach ($abs as $key) {
                    if (Carbon::now()->format('H:m:s') > '17:00:00' && $key->shift->client_id == 1 && $key->absensi_type_pulang == null) {
                        Absensi::where('id', $key->id)->update(['absensi_type_pulang' => 'Tidak Absen Pulang']);
                    }
                }
            }
        }
       
    }
}