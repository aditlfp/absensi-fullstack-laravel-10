<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_point_id',
        'image'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function CheckPoint()
    {
        return $this->belongsTo(CheckPoint::class);
    }
}
