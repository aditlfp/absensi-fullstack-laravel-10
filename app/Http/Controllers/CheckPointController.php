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
        $image = Image::all();
        return view('check.index', compact('cek', 'image'));
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
    public function create(Request $request)
    {
        $user = $request->query('id');
        $cek = CheckPoint::where('id', $user)->get();
        $foto = Image::all();
        return view('check.create', compact('cek', 'user', 'foto'));
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

    public function editByAuth(Request $request)
    {
        $user = $request->query('id');
        $cek = CheckPoint::where('id', $user)->get();
        $foto = []; // Inisialisasi $foto sebagai array kosong.
        $name = [];
        foreach ($cek as $key) {
            $fotoArr = Image::where('check_point_id', $key->id)->get(); // Mengambil data foto berdasarkan $key->id.
            foreach ($fotoArr as $fotoItem) {
                    $foto[] = $fotoItem;
            }
        }
        foreach ($cek as $value) {
            foreach ($value->name as $names) {
                $name[] = $names;
            }
        }
        // dd($foto);

        return view('check.edit', compact('user', 'cek', 'foto', 'name'));
    }

    public function update(Request $request, $id)
    {
        $newImagesData = [];
        $existingImages = Image::where('check_point_id', $id)->pluck('image')->toArray();

        // Cek apakah ada file baru di request
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $randomNumber = mt_rand(1, 9999);
                    $fileName = 'image_' . $randomNumber . '.' . $extension;
                    $image->storeAs('images', $fileName, 'public');
                    $newImagesData[] = $fileName;
                }
                // Hapus file lama jika ada request->oldImage
                if ($request->oldImage) {
                    foreach ($request->oldImage as $foto) {
                        Storage::disk('public')->delete('images/' . $foto);
                    }
                }else{
                    if (is_array($existingImages[0])) {
                        $allImages = array_merge($existingImages[0], $newImagesData);
                    } else {
                        $allImages = array_merge($existingImages, $newImagesData);
                    }
                }
            }
    
            if (is_array($existingImages[0])) {
                $allImages = array_merge($existingImages[0], $newImagesData);
            } else {
                $allImages = array_merge($existingImages, $newImagesData);
            }

            // dd($allImages);
            Image::where('check_point_id', $id)->update([
                'image' => $allImages
            ]);
    
            toastr()->success('Berhasil Mengupdate', 'success');
            return to_route('checkpoint-user.index');
        } else {
            toastr()->error('Tidak Ada Image Yang TerUpload', 'error');
            return redirect()->back();
        }
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
            return to_route('checkpoint-user.index');
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
