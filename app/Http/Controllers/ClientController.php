<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::paginate(20);
        return view('admin.client.index', compact('client'));
    }

    public function create()
    {
        $client = Client::all();
        $user = User::all();
        return view('admin.client.create', compact('client', 'user'));
    }

    public function store(ClientRequest $request)
    {
        $client = new Client();

        $client = [
            'name' => $request->name,
            'address' => $request->address,
            'province' => $request->province,
            'kabupaten' => $request->kabupaten,
            'zipcode' => $request->zipcode,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'logo' => $request->logo,
        ];

        if ($request->hasFile('logo')) {
            $client['logo'] = UploadImage($request, 'logo');
        }else{
            toastr()->error('Logo harus ditambahkan', 'error');
        }
        try {
            Client::create($client);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
            toastr()->success('Client Berhasil Ditambahkan', 'success');
            return redirect()->to(route('data-client.index'));

    }

    public function show($id)
    {
        $client = Client::find($id);
        if ($client != null) {
            return view('admin.client.show', compact('client'));
        }
        toastr()->error('Data Tidak Ditemukan', 'error');
        return redirect()->back();
    }

    public function edit($id)
    {
        $client = Client::find($id);
        if ($client != null) {
            return view('admin.client.edit', compact('client'));
        }
        toastr()->error('Data Tidak Ditemukan', 'error');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $client = [
            'name' => $request->name,
            'address' => $request->address,
            'province' => $request->province,
            'kabupaten' => $request->kabupaten,
            'zipcode' => $request->zipcode,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            // 'logo' => $request->logo,

        ];

        if($request->hasFile('logo'))
        {
            if($request->oldimage)
            {
                Storage::disk('public')->delete('images/' . $request->oldimage);
            }

            $client['logo'] = UploadImage($request, 'logo');
        }else{
            $client['logo'] = $request->oldimage;
        }
         try {
            Client::findOrFail($id)->update($client);
        } catch(\Illuminate\Database\QueryException $e){
           toastr()->error('Data Sudah Ada', 'error');
           return redirect()->back();
        }
        toastr()->success('Client berhasil diedit', 'success');
        return redirect()->to(route('data-client.index'));
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if ($client != null) {
            if ($client->logo == null) {
                toastr()->error('Logo Tidak Ditemukan', 'error');
            }
                if ($client->logo) {
                    Storage::disk('public')->delete('images/'.$client->logo);
                }
        }
        $client->delete();
        toastr()->error('Data Tidak Ditemukan', 'error');
        return redirect()->back();
    }
}
