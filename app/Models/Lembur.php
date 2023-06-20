<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kerjasama_id',
        'perlengkapan',
        'keterangan',
        'deskripsi',
        'jam_mulai',
        'jam_selesai',
        'image',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Kerjasama(){
        return $this->belongsTo(Kerjasama::class, 'kerjasama_id');
    }

}
