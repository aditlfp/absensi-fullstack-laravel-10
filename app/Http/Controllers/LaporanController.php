<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanRequest;
use App\Models\Kerjasama;
use App\Models\Laporan;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{

    public function __construct(Request $request)
    {
        $this->str = $request->input('str1');
        $this->ended = $request->input('end1');
    }

    public function index()
    {
        try {
            if (Auth::user()->role_id == 1) {
                $laporan = Laporan::paginate(25)->where('user_id', Auth::user()->id);
                return view('laporan.index', ['laporan' => $laporan]);
            }elseif(Auth::user()->role_id == 2)
            {
                $mitra = Kerjasama::all();
                $laporan = Laporan::paginate(25);
                return view('laporan.index', ['laporan' => $laporan, 'mitra' => $mitra]);
            }elseif(Auth::user()->divisi->jabatan->code_jabatan == 'MITRA'){
                $ker = Auth::user()->kerjasama->client_id;
                $laporan = Laporan::where('client_id', $ker)->paginate(25);
                return view('laporan.index', ['laporan' => $laporan]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    public function create()
    {
        $user = Auth::user()->kerjasama_id;
        $ruangan = Ruangan::where('kerjasama_id', $user)->get();
        $laporan = Laporan::all();
        return view('laporan.create', ['laporan' => $laporan, 'ruangan' => $ruangan]);
    }

    public function store(LaporanRequest $request)
    {
        $laporan = new Laporan();

        $laporan = [
            'user_id' => $request->user_id,
            'client_id' => $request->client_id,
            'ruangan_id' => $request->ruangan_id,
            'image1' => $request->image1,
            'image2' => $request->image2,
            'image3' => $request->image3,
            'keterangan' => $request->keterangan
        ];

        try {
            if ($request->hasFile('image1')) {
                $laporan['image1'] = UploadImage($request, 'image1');
            }
            if ($request->hasFile('image2')) {
                $laporan['image2'] = UploadImage($request, 'image2');
            }
            if ($request->hasFile('image3')) {
                $laporan['image3'] = UploadImage($request, 'image3');
            }
            Laporan::create($laporan);
            toastr()->success('Laporan Berhasil Disimpan', 'success');
            return to_route('laporan.index');
        } catch (\Throwable $th) {
            toastr()->error('Image Must Be Insert', 'error');
            return redirect()->back();
        }

    }

    public function destroy($id) // Admin
    {

        try {
            $laporan = Laporan::findOrFail($id);
                if ($laporan->image1) {
                    Storage::disk('public')->delete('images/'.$laporan->image1);
                }
                if ($laporan->image2) {
                    Storage::disk('public')->delete('images/'.$laporan->image2);
                }
                if ($laporan->image3) {
                    Storage::disk('public')->delete('images/'.$laporan->image3);
                }
            $laporan->delete();
            toastr()->warning('Laporan Berhasil Dihapus', 'warning');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Laporan Tidak Ditemukan', 'error');
        }
    }

    public function test()
    {
        $totalHari = 20;
        $str1 = Carbon::now()->format('Y-m-d');
        $end1 = Carbon::now()->format('Y-m-d');
        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $expPDF = Laporan::all();
        return view('laporan.export', compact('expPDF', 'str1', 'end1', 'base64', 'totalHari'));
    }

    public function exportWith(Request $request)
    {
        $tanggalSekarang = Carbon::now();
        $currentMonth = Carbon::parse($this->ended)->month;
        $currentYear = Carbon::parse($this->str)->year;
        $str1 = $this->str;
        $end1 = $this->ended;
        
        $mitra = $request->input('client_id');
        // dd($request->all());
        
        $totalHari =  Carbon::parse($this->ended)->diffInDays(Carbon::parse($this->str));
        
        if($request->has(['client_id', 'end1', 'str1'])) {
            
         $expPDF = User::with(['Laporan' => function ($query) use ($str1, $end1) {
            return $query->whereBetween('created_at', [$str1, $end1]);
        }])->when($mitra, function($query) use ($mitra) {
            return $query->where('kerjasama_id', $mitra);
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
        $html = view('laporan.export', compact('expPDF', 'base64', 'totalHari', 'currentYear', 'currentMonth', 'str1', 'end1'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'laporan.pdf';

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
}
