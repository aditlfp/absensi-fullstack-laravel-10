<?php

namespace App\Http\Controllers\SVP_Controller;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Laporan;
use App\Models\Lembur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function indexAbsen()
    {
        $absen = Absensi::paginate(15);
        return view('spv_view/absen/index', compact('absenn'));
    }

    public function indexLaporan()
    {
        $laporan = Laporan::paginate(15);
        return view('spv_view/laporan/index', compact('laporan'));
    }

    public function indexUser()
    {
        $kerjasama = Auth::user()->kerjasama_id;
        $user = User::where('kerjasama_id', $kerjasama)->paginate(15);
        return view('spv_view/laporan/index', compact('user'));
    }

    public function indexLembur()
    {
        $kerjasama = Auth::user()->kerjasama_id;
        $lembur = Lembur::where('kerjasama_id', $kerjasama)->paginate(15);
        return "lembur";
    }
}
