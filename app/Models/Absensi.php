<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kerjasama_id',
        'shift_id',
        'perlengkapan',
        'keterangan',
        'absensi_type_masuk',
        'absensi_type_pulang',
        'image',
        'deskripsi'

    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Kerjasama()
    {
        return $this->belongsTo(Kerjasama::class, 'kerjasama_id', 'id');
    }

    public function Shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function TipeAbsensi()
    {
        return $this->belongsTo(TipeAbsensi::class, 'tipe_id', 'id');
    }

}
