<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\Kerjasama;
use Illuminate\Http\Request;


class AreaController extends Controller
{
    public function index()
    {
        $area = Area::paginate(50);
        return view('admin.area.index', compact('area'));
    }

    public function create()
    {
        $kerjasama = Kerjasama::all();
        return view('admin.area.create', compact('kerjasama'));
    }

    public function store(AreaRequest $request)
    {
        $area = new Area();

        $area = [
            'kerjasama_id' => $request->kerjasama_id,
            'nama_area' => $request->nama_area
        ];

        Area::create($area);
        toastr()->success('Data Area Berhasil Dibuat', 'success');
        return to_route('area.index');
        
    }

    public function edit($id)
    {
        $kerjasama = Kerjasama::all();
        $area = Area::findOrFail($id);
        return view('admin.area.edit', compact('area', 'kerjasama'));
    }

    public function update(Request $request, $id)
    {
        $area = [
            'kerjasama_id' => $request->kerjasama_id,
            'nama_area' => $request->nama_area
        ];

        $areaId = Area::findOrFail($id);
        $areaId->update($area);
        toastr()->success('Data Area Berhasil Di Edit', 'success');
        return to_route('area.index');

    }

    public function destroy($id)
    {
        $areaId = Area::findOrFail($id);
        $areaId->delete();
        toastr()->warning('Data Area Berhasil delete', 'warning');
        return redirect()->back();
    }
}
