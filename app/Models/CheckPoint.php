<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'divisi_id',
        'type_check',
        'img',
        'deskripsi'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
