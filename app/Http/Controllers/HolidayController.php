<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayRequest;
use App\Models\Holiday;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
   public function index()
   {

        $holiday = Holiday::orderBy('tanggal_libur', 'desc')->paginate(15);
        return view('admin.holiday.index', ['holiday' => $holiday]);
   }

   public function create()
   {
        return view('admin.holiday.create');
   }

   public function store(HolidayRequest $request)
   {
        $holiday = new Holiday();

        $holiday = [
            'name' => $request->name,
            'tanggal_libur' => $request->tanggal_libur
        ];

        Holiday::create($holiday);
        toastr()->success('Berhasil Menambahkan Hari Libur', 'success');
        return to_route('holiday.index');
   }

   public function edit($id)
   {
    try {
        $holidayId = Holiday::findorFail($id);
        return view('admin.holiday.edit', ['holiday' => $holidayId]);
    } catch (ModelNotFoundException $th) {
        toastr()->error('Hari Libur Tidak Ditemukan', 'error');
        return redirect()->back();
    }
   }

   public function update(Request $request, $id)
   {
        $holiday = [
            'name' => $request->name,
            'tanggal_libur' => $request->tanggal_libur
        ];

        $holidayId = Holiday::findorFail($id);
        $holidayId->update($holiday);
        toastr()->success('Hari Libur Telah Di Update', 'success');
        return to_route('holiday.index');

   }

   public function destroy($id)
   {
        try {
            $holidayId = Holiday::findorFail($id);
            $holidayId->delete();
            toastr()->warning('Hari Libur Telah Di Delete', 'warning');
            return redirect()->back();
        } catch (ModelNotFoundException $th) {
            toastr()->error('Hari Libur Tidak Ditemukan', 'error');
            return redirect()->back();
        }
   }
}
