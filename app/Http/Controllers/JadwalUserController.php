<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalUserRequest;
use App\Models\Area;
use App\Models\JadwalUser;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalUserController extends Controller
{

    public function __construct(Request $request)
    {
        $this->str = $request->input('str1');
        $this->ended = $request->input('end1');
    }

    public function index()
    {
        $jadwalUser = JadwalUser::orderBy('tanggal', 'asc')->paginate(50);
        return view('admin.jadwalUser.index', compact('jadwalUser'));
    }

    public function create()
    {
        if (Auth::user()->divisi->jabatan->code_jabatan == "MITRA") {
            $user = User::where('kerjasama_id', Auth::user()->kerjasama_id)->get();
        } else {
            $user = User::all();
        }
        $shift = Shift::all();
        return view('admin.jadwalUser.create', compact('user', 'shift'));
    }

    public function processDate(Request $request)
    {
        $area = Area::where('kerjasama_id', Auth::user()->kerjasama_id)->get();
        $str1 = $this->str;
        $end1 = $this->ended;
        $totalHari =  Carbon::parse($this->ended)->diffInDays(Carbon::parse($this->str));
        if($request->has(['str1', 'end1'])){
            if (Auth::user()->divisi->jabatan->code_jabatan == "MITRA") {
                $user = User::where('kerjasama_id', Auth::user()->kerjasama_id)->get();
            } else {
                $user = User::all();
            }
            $jadwal = JadwalUser::all();
            $shift = Shift::all();
            return view('admin.jadwalUser.create', compact('user', 'shift', 'totalHari', 'area', 'jadwal', 'str1', 'end1'));
        }else{
            toastr()->error('Mohon Masukkan Taggal', 'Error');
            return redirect()->back();
        }


        // return redirect()->to(route('leader-jadwal.create')->with('totalHari', $totalHari));
    }

    public function store(JadwalUserRequest $request)
    {
        $jadwal = new JadwalUser();
        
        $jadwal = [
            'user_id' => $request->user_id,
            'shift_id' => $request->shift_id,
            'tanggal' => $request->tanggal,
            'area' => $request->area,
            'status' => $request->status
        ];
        JadwalUser::create($jadwal);
        toastr()->success('Jadwal Berhasil Ditambahkan', 'success');
        return to_route('leader-jadwal.index');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }
 
    public function destroy($id)
    {
        $jadwalId = JadwalUser::findOrFail($id);
        $jadwalId->delete();
        toastr()->warning('Jadwal Telah Dihapus', 'warning');
        return redirect()->back();

    }

    public function exportJadwal(Request $request)
    {
        $tanggalSekarang = Carbon::now();
        $currentMonth = Carbon::parse($this->ended)->month;
        $currentYear = Carbon::parse($this->str)->year;
        $str1 = $this->str;
        $end1 = $this->ended;
        
        $totalHari =  Carbon::parse($this->ended)->diffInDays(Carbon::parse($this->str));
        
        if($request->has(['end1', 'str1'])) {
            
         $expPDF = JadwalUser::when($request->has(['str1', 'end1']), function ($query) use ($str1, $end1) {
            return $query->whereBetween('tanggal', [$str1, $end1]);
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
        $html = view('admin.jadwalUser.export', compact('expPDF', 'base64', 'totalHari','currentYear', 'currentMonth','str1', 'end1'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'jadwal.pdf';

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
