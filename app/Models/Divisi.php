<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function Perlengkapan()
    {
        return $this->belongsToMany(Perlengkapan::class, 'divisi_perlengkapan');
    }
}
