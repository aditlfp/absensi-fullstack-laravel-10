<?php

namespace App\Http\Controllers\LEADER_Controller;

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
        $kerjasama = Auth::user()->kerjasama_id;
        $absen = Absensi::orderBy('tanggal_absen', 'asc')->where('kerjasama_id', $kerjasama)->paginate(15);
        return view('leader_view/absen/index', compact('absen'));
    }

    public function indexLaporan()
    {
        $kerjasama = Auth::user()->kerjasama->client_id;
        $laporan = Laporan::where('client_id', $kerjasama)->paginate(15);
        return view('leader_view/laporan/index', compact('laporan'));
    }

    public function indexUser()
    {
        $kerjasama = Auth::user()->kerjasama_id;
        $user = User::where('kerjasama_id', $kerjasama)->paginate(15);
        return view('leader_view/user/index', compact('user'));
    }

    public function indexLembur()
    {
        $kerjasama = Auth::user()->kerjasama_id;
        $lembur = Lembur::where('kerjasama_id', $kerjasama)->paginate(15);
        return view('leader_view/lembur/index', compact('lembur'));
    }
}
