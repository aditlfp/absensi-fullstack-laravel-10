<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportBref as RequestsReportBref;
use App\Models\ReportBref;
use Illuminate\Http\Request;

class ReportBrefController extends Controller
{
    public function index()
    {
        $brief = ReportBref::with('Client')->paginate(50);
        return view('brief.index', compact('brief'));
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
            return view('brief.edit', compact('brief'));
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

        try {
            ReportBref::create($brief);
            toastr()->success('Laporan Brefing Berhasil Dibuat', 'success');
            return to_route('brief.index');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back();
        }
        
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

        try {
            $brief = ReportBref::findOrFail($id);

            $brief->update($briefData);

            toastr()->success('Laporan Brefing Di Update', 'success');
            return to_route('brief.index');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back();
        }
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
