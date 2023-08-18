<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalUserRequest;
use App\Models\JadwalUser;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalUserController extends Controller
{
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

    public function store(JadwalUserRequest $request)
    {
        $jadwal = new JadwalUser();
        
        $jadwal = [
            'user_id' => $request->user_id,
            'shift_id' => $request->shift_id,
            'tanggal' => $request->tanggal,
            'area' => $request->area
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
