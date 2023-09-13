<?php

namespace App\Http\Controllers;

use App\Http\Requests\KerjasamaRequest;
use App\Models\Client;
use App\Models\Kerjasama;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::paginate(10);
        return view('admin.kerjasama.index', ['kerjasama' => $kerjasama]);
    }

    public function create()
    {
        $client = Client::all();
        $kerjasama = Kerjasama::all();
        return view('admin.kerjasama.create', compact('client', 'kerjasama'));
    }

    public function store(KerjasamaRequest $request)
    {

        $kerjasama = new Kerjasama();
        $kerjasama = [
            'client_id' => $request->client_id,
            'value' => $request->value,
            'experied' => $request->experied,
            'approve1' => $request->approve1,
            'approve2' => $request->approve2,
            'approve3' => $request->approve3,
        ];

        if ($kerjasama) {
        try {
            Kerjasama::create($kerjasama);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
            toastr()->success('Kerjasama Berhasil Dibuat', 'succes');
            return redirect()->back();
        }
            toastr()->error('Some fields Error');
            return view('admin.kerjasama.create');
    }

    public function show($id)
    {
        $kerjasama = Kerjasama::find($id);
        if ($kerjasama != null) {
            return view('admin.kerjasama.show', ['kerjasama' => $kerjasama]);
        }
        toastr()->error('Data Tidak Ditemukan', 'error');
        return view('admin.kerjasama.index');
    }

    public function edit($id)
    {
        $client = Client::all();
        $kerjasama = Kerjasama::find($id);
        if ($kerjasama != null) {
            return view('admin.kerjasama.edit', ['kerjasama' => $kerjasama, 'client' => $client]);
        }
            toastr()->error('Data Tidak Ditemukan', 'error');
            return view('admin.kerjasama.index');

    }

    public function update(Request $request, $id)
    {
        $kerjasama = [
            'client_id' => $request->client_id,
            'value' => $request->value,
            'experied' => $request->experied,
            'approve1' => $request->approve1,
            'approve2' => $request->approve2,
            'approve3' => $request->approve3,
        ];
        try {
            Kerjasama::findOrFail($id)->update($kerjasama);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
            toastr()->success('Data Berhasil Di Update', 'success');
            return redirect()->to(route('kerjasamas.index'));
    }

    public function destroy($id)
    {
        $kerjasama = Kerjasama::find($id);
        if ($kerjasama != null) {
            $kerjasama->delete();
            toastr()->warning('Data Telah Dihapus', 'warning');
            return redirect()->back();
        }
            toastr()->error('Data Tidak Ditemukan', 'error');
            return view('admin.kerjasama.index');
    }
}
