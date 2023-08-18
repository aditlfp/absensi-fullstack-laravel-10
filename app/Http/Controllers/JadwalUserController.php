<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalUserRequest;
use App\Models\JadwalUser;
use Illuminate\Http\Request;

class JadwalUserController extends Controller
{
    public function index()
    {
        $jadwalUser = JadwalUser::paginate(50);
        return view('admin.jadwalUser.index', compact('jadwalUser'));
    }

    public function create()
    {

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
