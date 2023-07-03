<?php

namespace App\Http\Controllers;

use App\Http\Requests\LemburRequest;
use App\Models\Divisi;
use App\Models\Kerjasama;
use App\Models\Lembur;
use App\Models\User;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LemburController extends Controller
{
    public function index()
    {
        $user = User::all();
        $dev = Divisi::all();
        $kerjasama = Kerjasama::all();
        $lembur = Lembur::all();
        $absensi = Absensi::all();
        return view('lembur.index', compact('user', 'kerjasama', 'dev', 'lembur', 'absensi'));
    } 

    public function store(LemburRequest $request)
    {
        // Get Data Image With base64
        $img = $request->image;
        $folderPath = "public/images/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $formatName = uniqid() . '-data-lembur';
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . '.png';
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
    // End Get Data Image With base64


    // Sementara
        $user_id = $request->user_id;
        $kerjasama_id = $request->kerjasama_id;
        $perlengkapan = json_encode($request->perlengkapan);
        $keterangan = $request->keterangan;
        $deskripsi = $request->deskripsi;
        $jam_mulai = $request->jam_mulai;
    // end Sementara

    $lembur = new lembur();

    $lembur = [
        'user_id' => $user_id,
        'kerjasama_id' => $kerjasama_id,
        'perlengkapan' => $perlengkapan,
        'keterangan' => $keterangan,
        'deskripsi' => $deskripsi,
        'jam_mulai' => $jam_mulai,
        'image' => $fileName,
    ];

    // dd($lembur);
    Lembur::create($lembur);
    toastr()->success('Berhasil Absen Lembur', 'succes');
    return redirect()->to(route('dashboard.index'));

    }

    public function update(Request $request, $id)
    {
        $lembur = Lembur::find($id);

        if ($lembur) {
            $lembur->jam_selesai = Carbon::now()->format('H:i:s');
            $lembur->save();

            toastr()->success('Berhasil Mengakhiri Lembur', 'succes');
            return redirect()->to(route('dashboard.index'));
        } else {
            toastr()->success('Gagal Absen Pulang', 'errorr');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $lembur = Lembur::findOrFail($id);
        if ($lembur != null) {
            if ($lembur->image == null) {
                toastr()->error('Image Tidak Ditemukan', 'error');
            }
                if ($lembur->image) {
                    Storage::disk('public')->delete('images/'.$lembur->image);
                }
        }
        toastr()->warning('Data Berhasil Dihapus !', 'warning');
        return redirect()->back();
    }

    public function lemburIndexAdmin(){
        $lembur = Lembur::paginate(25);
        return view('admin.lembur.index', ['lembur' => $lembur]);
    }

    public function lemburIndexUser(){
        $lembur = Lembur::paginate(25);
        return view('lembur.history', ['lembur' => $lembur]);
    }


}
