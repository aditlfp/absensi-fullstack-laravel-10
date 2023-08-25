<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $izin = Izin::where('user_id', $user)->get();

        return view('absensi.izin.index', ['izin' => $izin->paginate(30)]);
    }

    public function indexAdmin()
    {
        $izin = Izin::paginate(50);
        return view('admin.absen.izin', compact('izin'));
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
}
