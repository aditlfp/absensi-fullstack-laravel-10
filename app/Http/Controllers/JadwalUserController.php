<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalUserRequest;
use App\Models\JadwalUser;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
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
        $jadwalUser = JadwalUser::paginate(50);
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
        $str1 = $this->str;
        $end1 = $this->ended;
        $totalHari =  Carbon::parse($this->ended)->diffInDays(Carbon::parse($this->str));
        if($request->has(['str1', 'end1'])){
            if (Auth::user()->divisi->jabatan->code_jabatan == "MITRA") {
                $user = User::where('kerjasama_id', Auth::user()->kerjasama_id)->get();
            } else {
                $user = User::all();
            }
            $shift = Shift::all();
            return view('admin.jadwalUser.create', compact('user', 'shift', 'totalHari'));
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
        return to_route('jadwal.index');
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
}
