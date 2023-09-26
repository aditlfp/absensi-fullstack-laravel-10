<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-image';

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
                
        $twoMonthsAgo = Carbon::now()->subMonths(2);

        $absensi = Absensi::where('tanggal_absen', '<', $twoMonthsAgo)
            ->get();

        foreach ($absensi as $value) {
            $dataImg = $value->image;
            Storage::disk('public')->delete('images/'.$dataImg);
        }

    }
}
