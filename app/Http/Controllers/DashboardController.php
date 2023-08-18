<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kerjasama;
use App\Models\Lembur;
use App\Models\Rating;
use App\Models\Point;
use App\Models\Lokasi;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'shift' => $shift
        ]);
    }

}
