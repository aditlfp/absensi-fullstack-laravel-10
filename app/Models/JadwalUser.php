<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
        'tanggal',
        'area'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
