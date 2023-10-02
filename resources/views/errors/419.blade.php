@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('icon')
    <div class="bg-red-500 p-3 rounded-md my-5">
        <a class="btn btn-primary btn-xs sm:btn-md" href="{{ route('login')}}">KEMBALI KE LOGIN</a>
    </div>
@endsection
