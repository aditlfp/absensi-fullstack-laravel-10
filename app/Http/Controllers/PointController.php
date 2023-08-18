<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointRequest;
use App\Models\Absensi;
use App\Models\Client;
use App\Models\Point;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        $point = Point::paginate(20);
        return view('point.index', ['point' => $point]);
    }

    public function create()
    {
        $client = Client::all();
        return view('point.create', ['client' => $client]);
    }

    public function store(PointRequest $request)
    {
        $point = [
            'client_id' => $request->client_id,
            'sac_point' => $request->sac_point
        ];

        Point::create($point);
        toastr()->success('Point Berhasil Ditambahkan', 'success');
        return to_route('point.index');
    }

    public function edit($id)
    {
        $pointId = Point::findOrFail($id);
        $client = Client::all();
        return view('point.edit', ['point' => $pointId, 'client' => $client]);
    }

    public function update(Request $request, $id)
    {
        $point = [
            'client_id' => $request->client_id,
            'sac_point' => $request->sac_point
        ];

        $pointId = Point::findOrFail($id);
        $pointId->update($point);
        toastr()->success('Point Berhasil Diedit','success');
        return to_route('point.index');
    }

    public function destroy($id)
    {
        $pointId = Point::findOrFail($id);
        $pointId->delete();
        toastr()->warning('Point Telah Terhapus', 'warning');
        return redirect()->back();
    }

     
    public function myPoint($id)
    {
        try {
            $point = Point::all();
            $user_id = Auth::user()->id;
            $absen = Absensi::findOrFail($user_id);
            return view('point.sac_point', compact('absen'));
        } catch (ModelNotFoundException $e) {
            return view('point.err404');
        }

    }
}
