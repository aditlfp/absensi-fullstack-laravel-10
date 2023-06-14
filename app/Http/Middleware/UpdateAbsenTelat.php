<?php

namespace App\Http\Middleware;

use App\Models\Absensi;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateAbsenTelat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(Carbon::now() > '11:20:00'){
        $absesi = Absensi::where('shift_id', '=', '1')->get();
        foreach ($absesi as $absen) {
            if($absen){
                $absen->absensi_type_pulang == 'Tidak Absen Pulang';
                $absen->save();
            }
        }
    }
        if(Carbon::now() > '11:20:00'){
        $absesi = Absensi::where('shift_id', '=', '2')->get();
        foreach ($absesi as $absen) {
            if($absen){
                $absen->absensi_type_pulang == 'Tidak Absen Pulang';
                $absen->save();
            }
        }
    }

    return $next($request);
}
}