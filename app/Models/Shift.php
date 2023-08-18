<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'jabatan_id',
        'client_id',
        'shift_name',
        'jam_start',
        'jam_end',
    ];

    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function Absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
