<?php

namespace App\Http\Controllers;

use App\Models\CheckPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckPointController extends Controller
{
   public function index()
   {
    $currentMonth = Carbon::now()->month;
    $cek = CheckPoint::whereMonth('created_at', $currentMonth)->paginate(90);
    return view('check.index', compact('cek'));

   }

   public function create()
   {

    return view('check.create');

   }

   public function store(Request $request)
   {
        $cek = new CheckPoint();

        $cek = [
            'user_id' => $request->user_id,
            'divisi_id' => $request->divisi_id,
            'type_check' => $request->type_check,
            'img' => $request->img,
            'deskripsi' => $request->deskripsi
        ];
        
        if($request->hasFile('img'))
        {
            $cek['img'] = UploadImage($request, 'img');
        }else{
            toastr()->error('Foto harus ditambahkan', 'error');
        }

        try {
            CheckPoint::create($cek);
            toastr()->success('Data Berhasil Ditambahkan', 'succes');
            return to_route('checkpoint-user.index');

        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
        
   }

   public function edit($id)
   {

    $cek = CheckPoint::findOrFail($id);
    return view('check.edit', compact('cek'));

   }

   public function update(Request $request, $id)
   {

    $cek = [
        'user_id' => $request->user_id,
        'divisi_id' => $request->divisi_id,
        'type_check' => $request->type_check,
        'img' => $request->img,
        'deskripsi' => $request->deskripsi
    ];

    if($request->hasFile('img'))
        {
            if($request->oldimage)
            {
                Storage::disk('public')->delete('images/' . $request->oldimage);
            }

            $cek['img'] = UploadImage($request, 'img');
        }else{
            $cek['img'] = $request->oldimage;
        }
         try {
            CheckPoint::findOrFail($id)->update($cek);
            toastr()->success('Data berhasil diedit', 'success');
            return redirect()->to(route('checkpoint-user.index'));

        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Tidak Ada', 'error');
           return redirect()->back();
        }
   }

   public function destroy($id)
   {

    try {
        $cek = CheckPoint::findOrFail($id);
        if ($cek->img != null) {

            Storage::disk('public')->delete('images/'.$cek->img);

            $cek->delete();
            toastr()->warning('Data Telah Dihapus', 'warning');
            return redirect()->back();
        }else{
            toastr()->error('Foto Tidak Ditemukan', 'error');
        }
    } catch (\Illuminate\Database\QueryException $e) {
        toastr()->error('Data Tidak Ditemukan', 'error');
        return redirect()->back();
    }

   }
}
