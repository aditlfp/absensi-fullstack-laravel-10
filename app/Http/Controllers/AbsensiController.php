<?php

namespace App\Http\Controllers;
use GeoIP;
use App\Http\Requests\AbsensiRequest;
use App\Models\Absensi;
use App\Models\Client;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\TipeAbsensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Torann\GeoIP\Facades\GeoIP as FacadesGeoIP;

class AbsensiController extends Controller
{


    public function index(Request $request)
    {
        $ipAddress = $request->ip();
        $location = FacadesGeoIP::getLocation($ipAddress);
        $dev = Divisi::all();
        $client = Client::all();
        $shift = Shift::all();
        return view('absensi.index', ['shift' => $shift, 'user' => $location, 'client' => $client, 'dev' => $dev]);
    }

    public function store(AbsensiRequest $request)
    {
        // Get Data Image With base64{{  }}
            $img = $request->image;
            $folderPath = "public/images/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $formatName = uniqid() . '-data';
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $formatName . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);
        // End Get Data Image With base64


        // Sementara
            $user_id = $request->user_id;
            $kerjasama_id = $request->kerjasama_id;
            $shift_id = $request->shift_id;
            $perlengkapan = $request->perlengkapan;
            $keterangan = $request->keterangan;
            $absensi_type_masuk = $request->absensi_type_masuk;
            $deskripsi = $request->deskripsi;
        // end Sementara

        $absensi = new Absensi();

        $absensi = [
            'user_id' => $user_id,
            'kerjasama_id' => $kerjasama_id,
            'shift_id' => $shift_id,
            'perlengkapan' => $perlengkapan,
            'keterangan' => $keterangan,
            'absensi_type_masuk' => Carbon::now()->format('H:i:s'),
            'image' => $fileName,
            'deskripsi' => $deskripsi,
        ];

        Absensi::create($absensi);
        toastr()->success('Berhasil Absen Hari Ini', 'succes');
        return redirect()->to(route('dashboard.index'));
    }

    public function updatePulang(Request $request, $id)
    {
        $absensi = Absensi::find($id);

        if ($absensi) {
            $absensi->absensi_type_pulang = Carbon::now()->format('H:i:s');
            $absensi->save();

            toastr()->success('Berhasil Absen Pulang Hari Ini', 'succes');
            return redirect()->to(route('dashboard.index'));
        } else {
            toastr()->success('Gagal Absen Pulang', 'errorr');
            return redirect()->back();
        }
    }

    public function updateAbsenPulang($id)
    {
        $currentTime = Carbon::now()->format('H:i:s');
        $timeLimit = Carbon::parse('11:26:00'); // Waktu batas absen pulang
        $absensi = Absensi::findOrFail($id);
        $absensi->whereNull('absensi_type_pulang')->update(['absensi_type_pulang' => 'belum Absen Pulang']);
        $absensi->save();
        return response()->json(['success' => true]);

        // if ($currentTime > $timeLimit) {
        //     $absensi = Absensi::whereNull('absensi_type_pulang')->update(['absensi_type_pulang' => 'Tanpa Absen Pulang']);
        //     $absensi->save();
        // }
    }
}
