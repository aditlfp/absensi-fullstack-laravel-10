<?php

namespace App\Console\Commands;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\NotificationController;
use Illuminate\Console\Command;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification';

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
        $user = User::all();
        $tmn = Carbon::now();
        
        foreach ($abs as $key) 
        {
           foreach ($user as $items)
           {
               if($key->user_id == $items->id)
               {
                $user = User::where('id', $key->user_id)
                (new NotificationController)->sendNotificationToUser($user);
               }
           }
        }
    }
}
