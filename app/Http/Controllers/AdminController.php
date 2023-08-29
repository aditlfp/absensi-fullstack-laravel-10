<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Client;
use App\Models\Divisi;
use App\Models\Kerjasama;
use App\Models\Point;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function __construct(Request $request)
    {
        $this->str = $request->input('str1');
        $this->ended = $request->input('end1');
    }

    public function index(Request $request)
    {
        $user = User::count();
        $client = Client::count();
        $shift = Shift::all();


        return view('admin.index',
        [
            'user' => $user,
            'client' => $client,
            'shift' => $shift
    ]);
    }

    public function absen(Request $request)
    {
        $user = User::all();
        $absenSi = Kerjasama::all();
        $point = Point::all();
        $divisi = Divisi::all();
                
        $absen = Absensi::query();
        $absen->when($request->filterKerjasama, function($query) use($request) {
            return $query->where('kerjasama_id', 'like', '%'. $request->filterKerjasama. '%');
        });
        return view('admin.absen.index',['absen' => $absen->orderBy('tanggal_absen', 'desc')->paginate(25), 'absenSi' => $absenSi, 'point' => $point, 'divisi' => $divisi]);
    }

    public function izin()
    {
        $izin = Absensi::where('keterangan', 'izin')->paginate(5);
        return view('admin.absen.izin', ['izin' => $izin]);
    }

    public function export(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $tanggalSekarang = Carbon::now();
        $totalHari = $tanggalSekarang->daysInMonth;
        $tanggalFormat = Carbon::now()->format('Y-m-d');
        
        $libur = $request->input('libur');

        if($request->has(['libur']) && $libur != null) {
        $dataAbsen = User::with(['absensi' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('tanggal_absen', $currentMonth)->whereYear('tanggal_absen', $currentYear);
        }])->get();
        $dataUser = User::all();
        $all = Absensi::all();
        $user = Absensi::all();
        $aku = Absensi::where('keterangan', 'masuk')->get();
        $absen = Absensi::orderBy('absensi_type_masuk', 'asc')->where('keterangan', 'masuk')->get();

        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $html = view('admin.absen.export', compact('absen','all','base64', 'user', 'dataUser', 'totalHari', 'dataAbsen', 'currentMonth' , 'currentYear', 'libur'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'absensi.pdf';

        if ($request->input('action') == 'download') {
            return response()->download($output, $filename);
        }

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
        }else{
            toastr()->error('Mohon Masukkan Hari Libur', 'error');
            return redirect()->back();
        }
    }

    public function exportWith(Request $request)
    {
        $tanggalSekarang = Carbon::now();
        $currentMonth = Carbon::parse($this->ended)->month;
        $currentYear = Carbon::parse($this->str)->year;
        $dataUser = User::all();
        $divisi = Divisi::all();
        $user = Absensi::all();
        $mit = Kerjasama::all();
        $str1 = $this->str;
        $end1 = $this->ended;
        
        $mitra = $request->input('kerjasama_id');
        $divisiId = $request->input('divisi_id');
        $libur = $request->input('libur');
        // dd($request->all());
        
        $totalHari =  Carbon::parse($this->ended)->diffInDays(Carbon::parse($this->str));
        
        if($request->has(['kerjasama_id','divisi_id', 'libur', 'end1', 'str1'])) {
            
         $expPDF = User::with(['absensi' => function ($query) use ($str1, $end1) {
            return $query->whereBetween('created_at', [$str1, $end1]);
        }, 'jadwalUser' => function ($query) use ($str1, $end1) {
            return $query->whereBetween('created_at', [$str1, $end1]);
        }])->when($mitra, function($query) use ($mitra) {
            return $query->where('kerjasama_id', $mitra);
        })->when($divisiId, function($query) use ($divisiId) {
            return $query->where('devisi_id', $divisiId);
        })->get();


        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $html = view('admin.absen.exportV2', compact('expPDF', 'base64', 'totalHari', 'user', 'dataUser', 'currentYear', 'currentMonth', 'divisi', 'libur', 'str1', 'end1', 'mit', 'mitra'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'absensi.pdf';

        if ($request->input('action') == 'download') {
            return response()->download($output, $filename);
        }

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
                    
        }else{
            toastr()->error('Mohon Masukkan Filter Export', 'error');
            return redirect()->back();
        }
    }

    public function exp(Request $request)
    {
        $all = Absensi::all();
        $izin = Absensi::where('keterangan', 'izin')->get();

        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $html = view('admin.absen.export-izin', compact('izin','all','base64'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'absensi-izin.pdf';

        if ($request->input('action') == 'download') {
            return response()->download($output, $filename);
        }

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
    }
}
