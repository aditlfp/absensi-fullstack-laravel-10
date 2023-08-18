<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuanganRequest;
use App\Models\Kerjasama;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::paginate(10);
        return view('admin.ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        $kerjasama = Kerjasama::all();
        return view('admin.ruangan.create', compact('kerjasama'));
    }

    public function store(RuanganRequest $request)
    {
        $ruangan = new Ruangan();

        $ruangan = [
            'kerjasama_id' => $request->kerjasama_id,
            'nama_ruangan' => $request->nama_ruangan
        ];

        Ruangan::create($ruangan);
        toastr()->success('Data Ruangan Dibuat', 'success');
        return to_route('ruangan.index');
    }

    public function edit($id)
    {
        $kerjasama = Kerjasama::all();
        $ruanganId = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit', compact('ruanganId', 'kerjasama'));
    }

    public function update(Request $request, $id)
    {
        $ruangan = [
            'kerjasama_id' => $request->kerjasama_id,
            'nama_ruangan' => $request->nama_ruangan
        ];

        $ruanganId = Ruangan::findOrFail($id);
        $ruanganId->update($ruangan);
        toastr()->success('Data Ruangan TerUpdate', 'success');
        return to_route('ruangan.index');
    }

    public function destroy($id)
    {
        $ruanganId = Ruangan::findOrFail($id);
        $ruanganId->delete();
        toastr()->warning('Data Ruangan Deleted', 'warning');
        return redirect()->back();
    }
}
