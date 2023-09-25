@extends('errors::minimal')

@section('title', __('MAINTENANCE'))
@section('code', '503')
@section('message')
  <div class="flex flex-col">
      <span class="text-center font-bold text-gray-100 text-lg md:text-xl lg:text-2xl">WEB DALAM PERBAIKAN</span>
      <p class="text-center text-sm">Tunggu Beberapa Saat Hingga Server Sudah Siap</p>
  </div>
@endsection
@section('icon')
<div>
    <img src="https://www.svgrepo.com/show/426192/cogs-settings.svg" alt="Logo" class="mb-8 h-40">
</div>
@endsection
