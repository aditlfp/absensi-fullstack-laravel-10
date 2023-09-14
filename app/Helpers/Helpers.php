<?php

use Illuminate\Support\Facades\Storage;

function UploadImage($request, $NameFile)
{

    $file = $request->file($NameFile);
    if ($file != null && $file->isValid()) {
    $extensions = $file->getClientOriginalExtension();
    $randomNumber = mt_rand(1, 999999999999);
    $rename = 'data' . $randomNumber . '.' . $extensions;
    $file->storeAs('images', $rename, 'public');

    return $rename;
    }
}

function toRupiah($angka)
{
    return "Rp.". number_format($angka, 0, '.','.');
}
