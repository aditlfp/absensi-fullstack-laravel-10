<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use App\Models\Izin;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $izin = Izin::where('user_id', $user)->paginate(30);

        return view('absensi.izin.index', ['izin' => $izin]);
    }

    public function indexLead()
    {
        $user = Auth::user()->kerjasama_id;
        $izin = Izin::where('kerjasama_id', $user)->paginate(30);

        return view('leader_view.absen.izin', ['izin' => $izin]);
    }

    public function indexAdmin()
    {
        $izin = Izin::paginate(50);
        return view('admin.absen.izin', compact('izin'));
    }

    public function show($id)
    {
        $izinId = Izin::findOrFail($id);
        return view('absensi.izin.detail', compact('izinId'));
    }

    public function create()
    {
        $shift = Shift::all();

        return view('absensi.izin.create', compact('shift'));
    }

    public function store(IzinRequest $request)
    {
        $izin = new Izin();

        $izin = [
            'user_id' => $request->user_id,
            'kerjasama_id' => $request->kerjasama_id,
            'shift_id' => $request->shift_id,
            'alasan_izin' => $request->alasan_izin,
            'img' => $request->img,
        ];

        if ($request->hasFile('img')) {
            $izin['img'] = UploadImage($request, 'img');
        }else{
            toastr()->error('Image harus ditambahkan', 'error');
        }
            Izin::create($izin);
            toastr()->success('Data izin Berhasil Disimpan', 'success');
            return redirect()->to(route('data-izin.index'));
    }

    public function updateSuccess($id)
    {
        $izin = [
            'approve_status' => 'Accept'
        ];
        $izinId = Izin::findOrFail($id);
        $izinId->update($izin);
        return redirect()->back()->with('msg', 'Berhasil Meng Approve');

    }

    public function updateDenied($id)
    {
        $izin = [
            'approve_status' => 'Denied'
        ];
        $izinId = Izin::findOrFail($id);
        $izinId->update($izin);
        return redirect()->back()->with('msg', 'Berhasil Me Denied Approve');
    }

    public function deleteAdmin($id)
    {
        $izinId = Izin::findOrFail($id);
        $izinId->delete();
        toastr()->warning('Data Izin Dihapus', 'warning');
        return redirect()->back();
    }
}
