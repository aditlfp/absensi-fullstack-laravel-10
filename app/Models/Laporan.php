<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'ruangan_id',
        'image1',
        'image2',
        'image3',
        'keterangan'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
