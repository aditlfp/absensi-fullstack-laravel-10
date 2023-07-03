<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(){
        $user = User::all();
        $absen = Absensi::paginate(5);
        $rating = Rating::all();
        return view('rating.index', compact('user', 'absen', 'rating'));
    }

    public function store(Request $request){

        $rate = new Rating();

        $rate = [
            'user_id' => $request->user_id,
            'rate' => $request->rate
        ];

        Rating::create($rate);
        toastr()->success('Berhasil Memberikan Rating', 'succes');
        return redirect()->back();
    }

    
    public function myRate($id){

        $user_id = Auth::user()->id;
        $rating = Rating::findorFail($user_id);
        return view('rating.myrate', compact('rating'));
        
    }
}
