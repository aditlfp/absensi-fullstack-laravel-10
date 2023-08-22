<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerjasama_id',
        'nama_area'
    ];

    public function Kerjasama()
    {
        return $this->belongsTo(Kejasama::class);
    }
}
