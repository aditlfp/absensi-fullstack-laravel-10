<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Models\Divisi;
use App\Models\Kerjasama;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $kerjasama = Kerjasama::all();
        $client = Client::all();
        $user = User::with('Kerjasama');
        $user->when($request->filterKerjasama, function($query) use($request) {
            return $query->where('kerjasama_id', 'like', '%'. $request->filterKerjasama. '%');
        });

        return view('admin.user.index', ['user' => $user->paginate(5000), 'kerjasama' => $kerjasama, 'client' => $client]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dev = Divisi::all();
        $data = Kerjasama::all();
        return view('admin.user.create', compact('data', 'dev')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user = [
            'kerjasama_id' => $request->kerjasama_id,
            'devisi_id' => $request->devisi_id,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'image'     => $request->image,
            'nama_lengkap' => $request->nama_lengkap
        ];

        if ($request->hasFile('image')) {
            $user['image'] = UploadImage($request, 'image');
        }
        try {
            User::create($user);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
        toastr()->success('User Berhasil Ditambahkan', 'succes');
        return redirect()->back();
            
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dev = Divisi::all();
        $client = Client::all();
        $user = User::find($id);
        $dataUser = User::findOrFail($id);
        if ($user != null) {
            return view('admin.user.edit', compact('user', 'client', 'dev', 'dataUser'));
        }
        toastr()->error('Data tidak tidak ditemukan', 'error');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = [
            'kerjasama_id' => $request->kerjasama_id,
            'name'      => $request->name,
            'devisi_id' => $request->devisi_id,
            'email'     => $request->email,
            'image'     => $request->image,
            'nama_lengkap' => $request->nama_lengkap
        ];

        if($request->hasFile('image'))
        {
            if($request->oldimage)
            {
                Storage::disk('public')->delete('images/' . $request->oldimage);
            }

            $user['image'] = UploadImage($request, 'image');
        }else{
            $user['image'] = $request->oldimage;
        }
        try {
            User::findOrFail($id)->update($user);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
    
        toastr()->success('Data Berhasil diupdate', 'success');
        return to_route('users.index');
    }

    public function show($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user != null) {
            if ($user->image == null) {
                toastr()->error('Image Tidak Ditemukan', 'error');
            }
                if ($user->image) {
                    Storage::disk('public')->delete('images/'.$user->image);
                }
            $user->delete();
            toastr()->warning('Data User Telah Dihapus', 'warning');
            return redirect()->back();
        }else{
          toastr()->error('Data Tidak Ditemukan', 'error');
          return redirect()->back();
        }
        
    }
}
