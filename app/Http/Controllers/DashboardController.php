<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        

        $abs = Absensi::all();
        $lembur = Lembur::all();
        $absen = Absensi::paginate(10);
        return view('dashboard', [
            'absen' => $absen,
            'abs' => $abs,
            'lembur' => $lembur,
        ]);
    }
}
