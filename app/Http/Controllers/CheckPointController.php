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
        $cek = CheckPoint::all();
        return view('check.index', compact('cek'));
    }

    public function createAdmin()
    {
        $user = User::all();
        $client = Client::all();
        return view('admin.check.create', compact('user', 'client'));
    }

    public function create()
    {
        $user = Auth::user()->id;
        $cek = CheckPoint::where('user_id', $user)->get();
        return view('check.create', compact('cek', 'user'));
    }

    public function adminStore(CheckPointRequest $request)
    {
        $cek = new CheckPoint();

        $cek = [
            'user_id' => $request->user_id,
            'check_count' => $request->check_count,
            'client_id' => $request->client_id
        ];

        CheckPoint::create($cek);
        return redirect()->back()->with('msg', 'Data Check Point Disimpan!');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagesData = [];

            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $randomNumber = mt_rand(1, 9999);
                    $fileName = 'image_' . $randomNumber . '.' . $extension;
                    $image->storeAs('images', $fileName, 'public');
                    $imagesData[] = $fileName;
                }
            }
            // dd($imagesData);
            Image::create([
                'check_point_id' => $request->check_point_id,
                'image' => $imagesData
            ]);

            toastr()->success('Berhasil Menambahkan Check Point', 'success');
            return to_route('dashboard.index');
        }
        toastr()->error('Tidak Ada Image Yang TerUpload', 'error');
        return redirect()->back();
          
    }
}
