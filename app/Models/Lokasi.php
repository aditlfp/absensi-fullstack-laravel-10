<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'latitude',
        'longtitude',
        'radius'
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
}
