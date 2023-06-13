<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi_Perlengkapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'divisi_id',
        'perlengkapan_id',
    ];
}
