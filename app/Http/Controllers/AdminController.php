<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Client;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = User::count();
        $client = Client::count();

        return view('admin.index',
        [
            'user' => $user,
            'client' => $client,
    ]);
    }

    public function absen()
    {
        $absen = Absensi::orderBy('keterangan', 'asc')->get();
        return view('admin.absen.index', compact('absen'));
    }

    public function izin()
    {
        $izin = Absensi::where('keterangan', 'izin')->paginate(5);
        return view('admin.absen.izin', ['izin' => $izin]);
    }

    public function export(Request $request)
    {
        $all = Absensi::all();
        $absen = Absensi::orderBy('absensi_type_masuk', 'asc')->where('keterangan', 'masuk')->get();
        $izin = Absensi::where('keterangan', 'izin')->get();

        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $html = view('admin.absen.export', compact('absen', 'izin','all','base64'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'absensi.pdf';

        if ($request->input('action') == 'download') {
            return response()->download($output, $filename);
        }

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
    }

    public function exp(Request $request)
    {
        $all = Absensi::all();
        $izin = Absensi::where('keterangan', 'izin')->get();

        $path = 'logo/sac.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $html = view('admin.absen.export-izin', compact('izin','all','base64'))->render();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        $filename = 'absensi-izin.pdf';

        if ($request->input('action') == 'download') {
            return response()->download($output, $filename);
        }

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
    }
}
