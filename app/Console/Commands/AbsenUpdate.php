<?php

namespace App\Console\Commands;

use App\Models\Absensi;
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
        $pagi = Absensi::where('shift_id', 1)->get();
        $sore = Absensi::where('shift_id', 2)->get();

        foreach ($pagi as $i){
            if (Carbon::now() >= '14:00:00'){
                if ($i->absensi_type_pulang == null && $i->keterangan == 'masuk') {
                    Absensi::where('id', $i->id)->update(['absensi_type_pulang' => 'Tidak Absen Pulang']);
                }
            }
        }
        foreach ($sore as $i){
            if (Carbon::now() >= '21:00:00'){
                if ($i->absensi_type_pulang == null && $i->keterangan == 'masuk') {
                    Absensi::where('id', $i->id)->update(['absensi_type_pulang' => 'Tidak Absen Pulang']);
                }
            }
        }
    }
}
