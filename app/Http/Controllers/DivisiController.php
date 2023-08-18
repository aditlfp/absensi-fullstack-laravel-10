<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisiRequest;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Perlengkapan;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $devisi = Divisi::with('perlengkapan')->paginate(15);
        return view('admin.devisi.index', ['data' => $devisi]);
    }

    public function create()
    {
        $alat = Perlengkapan::all();
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        return view('admin.devisi.create', ['data' => $divisi, 'alat' => $alat, 'jabatan' => $jabatan]);
    }

    public function store(DivisiRequest $request)
    {
        $devisi = new Divisi();
        $devisi = [
            'name' => $request->name,
            'jabatan_id' => $request->jabatan_id
        ];

        Divisi::create($devisi);
        
        toastr()->success('Devisi berhasil dibuat', 'success');
        return redirect()->to(route('devisi.index'));
    }

    public function editEquipment($divisiId)
    {
        
        $divisi = Divisi::findOrFail($divisiId);
        $alat = Perlengkapan::all();
        return view('admin.devisi.add', ['data' => $divisi, 'alat' => $alat]);
    }

    public function addEquipment(Request $request, $divisiId)
    {
        $divisi = Divisi::findOrFail($divisiId);
        $equipmentIds = $request->input('perlengkapan_id', []);

        $divisi->Perlengkapan()->attach($equipmentIds);
        // dd($divisi);
        toastr()->success('Devisi berhasil dibuat', 'success');
        return redirect()->to(route('devisi.index'));
    }

    public function edit($id)
    {
        $jabatan = Jabatan::all();
        $alat = Perlengkapan::all();
        $data = Divisi::findOrFail($id);
        return view('admin.devisi.edit', ['data' => $data, 'alat' => $alat, 'jabatan' => $jabatan]);
    }

    public function update(DivisiRequest $request, $id)
    {
        $dev = Divisi::findOrFail($id);
        $devisi = [
            'name' => $request->name,
            'jabatan_id' => $request->jabatan_id
        ];

        Divisi::findOrFail($id)->update($devisi);
        toastr()->success('Data Telah Ter Update', 'success');
        return redirect()->to(route('devisi.index'));
    }

    public function destroy($id)
    {
        $devisi = Divisi::findOrFail($id);
        $devisi->delete();
        toastr()->warning('Data Telah Terhapus', 'warning');
        return redirect()->back();
    }
}
