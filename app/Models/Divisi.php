<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jabatan_id',
    ];

    public function Perlengkapan()
    {
        return $this->belongsToMany(Perlengkapan::class, 'divisi_perlengkapan');
    }
    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    
    public function User()
    {
        return $this->hasMany(User::class);
    }

}
