<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerlengkapanRequest;
use App\Models\Perlengkapan;
use Illuminate\Http\Request;

class PerlengkapanController extends Controller
{
    public function index()
    {
        $data = Perlengkapan::paginate(25);
        return view('admin.perlengkapan.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.perlengkapan.create');
    }

    public function store(PerlengkapanRequest $request)
    {
        $names = $request->input('name');
        foreach ($names as $name) 
        {
            Perlengkapan::create([
                'name' => $name,
            ]);
        }
        toastr()->success('Perlengkapan Berhasil dibuat', 'success');
        return redirect()->to(route('perlengkapan.index'));
    }

    public function edit($id)
    {
        $data = Perlengkapan::findOrFail($id);
        return view('admin.perlengkapan.edit', ['data' => $data]);
    }

    public function update(PerlengkapanRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
        ];

        Perlengkapan::findOrFail($id)->update($data);
        toastr()->success('Data berhasil di Update!', 'success');
        return redirect()->to(route('perlengkapan.index'));
    }

    public function destroy($id)
    {
        $data = Perlengkapan::findOrFail($id);
        $data->delete();
        toastr()->warning('Data Terhapus!!', 'warning');
        return redirect()->back();
    }
}
