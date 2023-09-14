<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MitraMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->divisi->jabatan->code_jabatan != "MITRA")
        {
            toastr()->error('Anda Tidak Memiliki Wewenang', 'error');
            session()->flush();
            Auth::logout();
            return redirect()->to(route('login'));
        }
        return $next($request);
    }
}
