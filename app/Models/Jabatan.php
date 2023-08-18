<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'divisi_id',
        'code_jabatan',
        'type_jabatan',
        'name_jabatan',
    ];

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    public function Shift()
    {
        return $this->hasMany(Shift::class);
    }
}
