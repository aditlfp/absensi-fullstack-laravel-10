<?php

namespace App\Http\Controllers;

use App\DataTables\ReportBrefDataTable;
use App\Http\Requests\ReportBref as RequestsReportBref;
use App\Models\ReportBref;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportBrefController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(ReportBref::select('*'))
            ->addColumn('action', 'components/bref-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('brief.index');
    }

    public function edit($id)
    {
        $briefid = new ReportBref();
        try {
            $brief = $briefid->findById($id);
            return response()->json($brief, 200);
        } catch (\Throwable $th) {
            toastr()->error($th, 'error');
            return redirect()->back();
        }
    }

    public function store(RequestsReportBref $request)
    {
        $brief = new ReportBref();

        $brief = [
            'client_id' => $request->client_id,
            'tanggal' => $request->tanggal,
            'shift' => $request->shift,
            'hadir' => $request->hadir,
            'spv' => $request->spv,
            'tl' => $request->tl,
            'ocs' => $request->ocs,
            'tanpa_keterangan' => $request->tanpa_keterangan,
            'izin_atau_cuti' => $request->izin_atau_cuti,
            'sakit' => $request->sakit,
            'off' => $request->off,
            'total_mp' => $request->total_mp,
            'materi_breafing' => $request->materi_breafing
        ];

        ReportBref::create($brief);
        return response()->json($brief, 200);
    }

    public function update(Request $request, $id)
    {
        $briefData = [
            'client_id' => $request->client_id,
            'tanggal' => $request->tanggal,
            'shift' => $request->shift,
            'hadir' => $request->hadir,
            'spv' => $request->spv,
            'tl' => $request->tl,
            'ocs' => $request->ocs,
            'tanpa_keterangan' => $request->tanpa_keterangan,
            'izin_atau_cuti' => $request->izin_atau_cuti,
            'sakit' => $request->sakit,
            'off' => $request->off,
            'total_mp' => $request->total_mp,
            'materi_breafing' => $request->materi_breafing
        ];

        $brief = ReportBref::findOrFail($id);

        $brief->update($briefData);

        return response()->json($brief, 200);

    }

    public function destroy($id)
    {
        $brief = new ReportBref();

        $brief->deleteById($id);

        if ($brief) {
            return response()->json($brief, 200);
        }else {
            return response()->json(  401);
        }
    }
}
