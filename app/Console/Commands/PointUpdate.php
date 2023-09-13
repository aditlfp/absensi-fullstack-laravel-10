<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Point;
use Illuminate\Console\Command;

class PointUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:point-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $abs = Absensi::all();
        $point = Point::all();
        
    
        foreach ($abs as $key) 
        {
            if ($key->keterangan == 'masuk' && $key->point_id == null) 
            {
                foreach ($point as $value) 
                {
                    if ($key->kerjasama->client_id == $value->client_id) 
                    {
                        $pid = Point::where('client_id', $key->kerjasama->client_id)->get();
                        foreach ($pid as $i)
                        {
                            Absensi::where('id', $key->id)->update(['point_id' => $i->id]);
                        }
                    }
                }
            }
        }
    }
}
