<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckPointRequest;
use App\Http\Requests\ImageRequest;
use App\Models\CheckPoint;
use App\Models\Client;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPointController extends Controller
{
    public function index()
    {

    }

    public function createAdmin()
    {
        $user = User::all();
        $client = Client::all();
        return view('admin.check.create', compact('user', 'client'));
    }

    public function create()
    {
        $cek = CheckPoint::all();
        $user = Auth::user()->id;
        return view('check.create', compact('cek', 'user'));
    }

    public function adminStore(CheckPointRequest $request)
    {
        $cek = new CheckPoint();

        $cek = [
            'user_id' => $request->user_id,
            'check-count' => $request->check_count,
            'client_id' => $request->client_id
        ];

        CheckPoint::create($cek);
        return redirect()->back()->with('msg', 'Data Check Point Disimpan!');
    }

    public function store(ImageRequest $request)
    {

        $img = new Image();

        $img = [
            'check_point_id' => $request->check_point_id,
            'image' => $request->image
        ];

        if ($request->hasFile('image')) {
            $img['image'] = UploadImage($request, 'image');
        }

        Image::create($img);
        return "Data Disimpan Cuy";

    }
}
