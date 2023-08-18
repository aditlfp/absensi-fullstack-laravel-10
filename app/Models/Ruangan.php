<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerjasama_id',
        'nama_ruangan'
    ];

    public function Kerjasama()
    {
        return $this->belongsTo(Kerjasama::class);
    }
}
