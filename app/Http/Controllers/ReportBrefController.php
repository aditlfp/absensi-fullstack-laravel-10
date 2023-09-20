<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportBref as RequestsReportBref;
use App\Models\ReportBref;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('brief.create');
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

        $briefId = $request->id;

        $brief = ReportBref::updateOrCreate(
        [
            'id' => $briefId
        ],
        [
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
        ]);
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

    public function akuEdit(Request $request)
    {
        $where = array('id' => $request->id);
        $brief  = ReportBref::where($where)->first();
      
        return Response()->json($brief);
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
