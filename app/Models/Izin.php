<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kerjasama_id',
        'shift_id',
        'alasan_izin',
        'img',
        'status_aprrove'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Kerjasama()
    {
        return $this->belongsTo(Kerjasama::class);
    }

    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
