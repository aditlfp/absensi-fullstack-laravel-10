<?php

namespace App\Http\Controllers;
use App\Http\Requests\AbsensiRequest;
use App\Models\Absensi;
use App\Models\Client;
use App\Models\Divisi;
use App\Models\JadwalUser;
use App\Models\Lokasi;
use App\Models\Point;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbsensiNotification;
// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $dev = Divisi::all();
        $client = Client::all();
        $shift = Shift::all();
        $jadwal = JadwalUser::where('user_id', $user)->get();
        $absensi = Absensi::where('user_id',$user)->latest()->get();
        // dd($absensi);
        $harLok = Lokasi::where('client_id', Auth::user()->kerjasama->client_id)->first();
        return view('absensi.index', compact('shift', 'client', 'dev', 'absensi', 'harLok', 'jadwal'));
    }

    public function store(AbsensiRequest $request)
    {
        // Get Data Image With base64
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
            $latUser = $request->lat_user;
            $longUser = $request->long_user; // 125950.0
            // $latUser = -7.864453554822072;  
            // $longUser = 111.49581153034036; //13316.0

        // Sementara
            $user_id = $request->user_id;
            $kerjasama_id = $request->kerjasama_id;
            $shift_id = $request->shift_id;
            $perlengkapan = json_encode($request->perlengkapan);
            $keterangan = $request->keterangan;
            $absensi_type_masuk = $request->absensi_type_masuk;
            $deskripsi = $request->deskripsi;
        // end Sementara

        $harLok = Lokasi::where('client_id', Auth::user()->kerjasama->client_id)->first();
        // dd($harLok);
        $latMitra = $harLok->latitude;
        $longMitra = $harLok->longtitude;
        $jarak = $this->distance($latMitra, $longMitra, $latUser, $longUser);
        $radius = round($jarak['meters']);
       
        // dd($radius);
        if ($radius <= $harLok->radius) {
        $absensi = new Absensi();

        $absensi = [
            'user_id' => $user_id,
            'kerjasama_id' => $kerjasama_id,
            'shift_id' => $shift_id,
            'perlengkapan' => $perlengkapan,
            'keterangan' => $keterangan,
            'absensi_type_masuk' => Carbon::now()->format('H:i:s'),
            'tanggal_absen' => Carbon::now()->format('Y-m-d'),
            'image' => $fileName,
            'deskripsi' => $deskripsi,
            'last_notification_date' => Carbon::today()->toDateString(),
        ];

        Absensi::create($absensi);
        toastr()->success('Berhasil Absen Hari Ini', 'succes');
        
        $users = Auth::user();
        
        // // Mail::send('emails.test', [], function ($message) use ($users) {
        // //     $message->to($users->email)
        // //         ->subject('Notifikasi Berhasil Absensi');
        // // });
        
        Mail::to($users->email)->queue(new AbsensiNotification);

        return redirect()->to(route('dashboard.index'));            
        }else {
            toastr()->error('Kamu Diluar Radius', 'Error');
            return redirect()->back();  
        }
                    
    }

    public function updatePulang(Request $request, $id)
    {
        $absensi = Absensi::find($id);
        
        $latUser = $request->lat_user;
        $longUser = $request->long_user;
        
        $harLok = Lokasi::where('client_id', Auth::user()->kerjasama->client_id)->first();
        // dd($harLok);
        $latMitra = $harLok->latitude;
        $longMitra = $harLok->longtitude;
        $jarak = $this->distance($latMitra, $longMitra, $latUser, $longUser);
        $radius = round($jarak['meters']);
        
         if ($radius <= $harLok->radius) {
        
            if ($absensi) {
                $absensi->absensi_type_pulang = Carbon::now()->format('H:i:s');
                $absensi->save();
    
                toastr()->success('Berhasil Absen Pulang Hari Ini', 'succes');
                return redirect()->to(route('dashboard.index'));
            } else {
                toastr()->success('Gagal Absen Pulang', 'errorr');
                return redirect()->back();
            }
         } else {
            toastr()->error('Kamu Diluar Radius', 'Error');
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

    public function historyAbsensi(Request $request)
    {
        
        $filter = $request->search;
        $filter2 = Carbon::parse($filter);
        
        if ($filter) {
            $user = Auth::user()->id;
            $abs = Absensi::all();
            $pointId = Point::all();
            $point = Absensi::whereNotNull('point_id')->where('user_id', $user)->whereMonth('created_at', $filter2->month)->get();
            $absen = Absensi::where('user_id', $user)->whereMonth('created_at', $filter2->month)->paginate(31);
        } else {
            $mon = Carbon::now()->month;
            $user = Auth::user()->id;
            $abs = Absensi::all();
            $pointId = Point::all();
            $point = Absensi::whereNotNull('point_id')->where('user_id', $user)->whereMonth('created_at', $mon)->get();
            $absen = Absensi::where('user_id', $user)->whereMonth('created_at', $mon)->paginate(15);
        }
        
        return view('absensi.history', [
            'absen' => $absen,
            'abs' => $abs,
            'point' => $point,
            'pointId' => $pointId
        ]);
    }
    
    public function historyAbsenFilter(Request $request)
    {
        $user = Auth::user()->id;
        $abs = Absensi::all();
        $pointId = Point::all();
        $point = Absensi::whereNotNull('point_id')->where('user_id', $user)->whereMonth('created_at', $parse->month)->get();
        $absen = Absensi::query();
       
        return view('absensi.history', [
            'absen' => $absen,
            'abs' => $abs,
            'point' => $point,
            'pointId' => $pointId
        ]);
    }

    public function claimPoint(Request $request, $id)
    {
        $absen = [
            'point_id' => $request->point_id,
        ];
        $absensiId = Absensi::findOrFail($id);
        $absensiId->update($absen);
        toastr()->success('Point Diclaim', 'success');
        return redirect()->back();
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
         // Konversi ke radian
         $lat1Rad = deg2rad($lat1);
         $lon1Rad = deg2rad($lon1);
         $lat2Rad = deg2rad($lat2);
         $lon2Rad = deg2rad($lon2);
 
         // Haversine formula
         $deltaLat = $lat2Rad - $lat1Rad;
         $deltaLon = $lon2Rad - $lon1Rad;
         $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($deltaLon / 2) * sin($deltaLon / 2);
         $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
         $earthRadius = 6371000; // Radian bumi dalam meter
         $meters = $earthRadius * $c;
 
         return compact('meters');
    }
}
