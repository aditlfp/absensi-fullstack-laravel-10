<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Absensi;
use App\Models\Laporan;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(){
        $user = User::all();
        $absen = Absensi::paginate(5);
        $rating = Rating::all();
        return view('rating.index', compact('user', 'absen', 'rating'));
    }

    public function store(RatingRequest $request){

        $rate = new Rating();

        $rate = [
            'leader_name' => $request->leader_name,
            'mitra_name' => $request->mitra_name,
            'isLeader' => $request->isLeader,
            'isMitra' => $request->isMitra,
            'user_id' => $request->user_id,
            'rate' => $request->rate
        ];

        Rating::create($rate);
        toastr()->success('Berhasil Memberikan Rating', 'succes');
        return redirect()->back();
    }

    
    public function myRate($id)
    {
        try {
            $user_id = Auth::user()->id;
            $rating = Rating::findorFail($user_id);
            return view('rating.myrate', compact('rating'));
        } catch (ModelNotFoundException $e) {
            return view('rating.err404');
        }

    }
    public function rateKerja(Request $request, $id) {
        $absensi = Absensi::where('user_id', $id);
        $laporan = Laporan::where('user_id', $id);
        $rating = Rating::where('user_id', $id);
        return view('rating.riwayat-kerja', compact('absensi', 'laporan'));
    }
}
