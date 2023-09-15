<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckPointRequest;
use App\Models\CheckPoint;
use App\Models\Client;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckPointController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $cek = CheckPoint::where('user_id', $user)->get();
        return view('check.index', compact('cek'));
    }
    public function indexAdmin()
    {
        $cek = CheckPoint::with(['User', 'Client'])->get();
        return view('admin.check.index', compact('cek'));
    }

    // ADMIN HANDLE REQUEST CREATE
    public function createAdmin()
    {
        $user = User::all();
        $client = Client::all();
        return view('admin.check.create', compact('user', 'client'));
    }

    // USER HANDLE REQUEST IMAGE CP
    public function create()
    {
        $user = Auth::user()->id;
        $cek = CheckPoint::where('user_id', $user)->get();
        return view('check.create', compact('cek', 'user'));
    }

    // ADMIN HANDLE REQUEST STORE NEW COUNT CP
    public function adminStore(CheckPointRequest $request)
    {
        $dataName = [];
        foreach ($request->input('name') as $value) {
            $dataName[] = $value;
        }
        CheckPoint::create([
            'user_id' => $request->user_id,
            'check_count' => $request->check_count,
            'client_id' => $request->client_id,
            'name' => $dataName
        ]);
        return redirect()->back()->with('msg', 'Check Point Berhasil Dibuat');
    }

    public function editAdmin($id)
    {
        $cek = CheckPoint::findOrFail($id);
        return view('admin.check.edit', compact('cek'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $cek = [
            'user_id' => $request->user_id,
            'check_count' => $request->check_count,
            'client_id' => $request->client_id,
            'name' => $request->name
        ];

        $cekId = CheckPoint::findOrFail($id);
        $cekId->update($cek);
        toastr()->success('Check Point' . $cekId->name . 'Berhasil Di Update', 'success');
        return to_route('admin.cp.index');
    }


    // USER HANDLE REQUEST IMAGE CP
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

    public function destroy($id)
    {
        $client = Image::findOrFail($id);
        $arrayData = $client->image;

        if ($arrayData == null) {
            toastr()->error('Logo Tidak Ditemukan', 'error');
        }
        if ($arrayData) {
            foreach ($arrayData as $value) {
                Storage::disk('public')->delete('images/'.$value);
            }
        }

        toastr()->warning('Check Point Anda Terhapus Permanent', 'warning');
        return redirect()->back();
    }
    public function lihatFoto($id) {
        $cek = CheckPoint::where('id', $id)->get();
        return view('check.lihatFoto', compact('cek'));
    }
}
