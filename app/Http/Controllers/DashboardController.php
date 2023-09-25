<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalUser;
use App\Models\Kerjasama;
use App\Models\Lembur;
use App\Models\Lokasi;
use App\Models\Point;
use App\Models\Rating;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $abs = Absensi::all();
        $lembur = Lembur::latest('jam_selesai')->get();
        $kerjasama = Kerjasama::all();
        $absen = Absensi::all();
        $rate = Rating::all();
        $user = Auth::user()->id;
        $point = Point::all();
        $shift = Shift::all();
        $jadwalUser = JadwalUser::all();
        $harLok = Lokasi::where('client_id', Auth::user()->kerjasama->client_id)->first();
        return view('dashboard', [
            'absen' => $absen,
            'abs' => $abs,
            'lembur' => $lembur,
            'kerjasama' => $kerjasama,
            'rate' => $rate,
            'user' => $user,
            'point' => $point,
            'harLok' => $harLok,
            'shift' => $shift,
            'jadwalUser' => $jadwalUser,
        ]);
    }
    
    public function sendTestEmail()
    {
        // $users = 'aditya.budilfp11@gmail.com';
        
        // Mail::send('emails.test', [], function ($message) use ($users) {
        //     $message->to($users)
        //         ->subject('Ini adalah email uji coba');
        // });
        
        // Mail::to($users)->queue(new AbsensiNotification);
        
        // $user->last_notification_date = Carbon::today()->toDateString();
        // $user->save();

    }

}
