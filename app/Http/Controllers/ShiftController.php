<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shift = Shift::paginate(10);
        return view('admin.shift.index', compact('shift'));
    }

    public function create()
    {
        return view('admin.shift.create');
    }

    public function store(ShiftRequest $request)
    {
        
        $shift = new Shift();
        $shift = [
            'jabatan_id'    => $request->jabatan_id,
            'client_id'     => $request->client_id,
            'shift_name'    => $request->shift_name,
            'jam_start'     => $request->jam_start,
            'jam_end'       => $request->jam_end
        ];

        Shift::create($shift);
        toastr()->success('Shift berhasil ditambahkan', 'success');
        return redirect()->to(view('admin.shift.index'));
    }

    public function show($id)
    {
        $shift = Shift::find($id);
        if($shift != null)
        {
            return view('admin.shift.show', compact('shift'));
        }

        toastr()->error('Data Tidak Ditemukan', 'error');
        return redirect()->back();
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        if ($shift != null) {
            return view('admin.shift.edit', compact('shift'));
        }
        toastr()->error('Data tidak ditemukan', 'error');
        return redirect()->back();
    }

    public function update(ShiftRequest $request, $id)
    {
        $shift = [
            'jabatan_id'    => $request->jabatan_id,
            'client_id'     => $request->client_id,
            'shift_name'    => $request->shift_name,
            'jam_start'     => $request->jam_start,
            'jam_end'       => $request->jam_end
        ];

        Shift::findOrFail($id)->update($shift);
        toastr()->success('Shift berhasil diupdate', 'success');
        return view('admin.shift.index');
    }

    public function destroy($id)
    {
        $shift = Shift::find($id);
        if($shift != null)
        {
            $shift->delete();
            toastr()->warning('Data Shift Terhapus', 'warning');
            return redirect()->back();
        }
            toastr()->error('Data Tidak Ditemukan', 'error');
            return redirect()->back();
    }

}
