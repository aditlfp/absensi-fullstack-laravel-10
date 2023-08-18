<?php

namespace App\Http\Controllers;

use App\Http\Requests\LokasiRequest;
use App\Models\Client;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::paginate(10);
        return view('admin.lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        $client = Client::all();
        return view('admin.lokasi.create', compact('client'));
    }

    public function store(LokasiRequest $request)
    {
        $lokasi = new Lokasi();

        $lokasi = [
            'client_id' => $request->client_id,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'radius' => $request->radius
        ];

        Lokasi::create($lokasi);
        toastr()->success('Berhasil Menambahkan Lokasi', 'success');
        return to_route('lokasi.index');
    }

    public function edit($id)
    {
        $client = Client::all();
        $lokasiId = Lokasi::findOrFail($id);
        return view('admin.lokasi.edit', compact('lokasiId', 'client'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = [
            'client_id' => $request->client_id,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'radius' => $request->radius
        ];

        $lokasiId = Lokasi::findOrFail($id);
        $lokasiId->update($lokasi);
        toastr()->success('Berhasil Mengupdate Lokasi', 'success');
        return to_route('lokasi.index');
    }

    public function destroy($id)
    {
        $lokasiId = Lokasi::findOrFail($id);
        $lokasiId->delete();
        toastr()->warning('Berhasil Mendelete Lokasi', 'warning');
        return redirect()->back();
    }
}
