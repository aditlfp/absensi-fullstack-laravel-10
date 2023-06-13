<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perlengkapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'divisi_id'
    ];

    public function Divisi() : BelongsToMany
    {
        return $this->belongsToMany(Divisi::class, 'divisi_perlengkapan');
    }
}
