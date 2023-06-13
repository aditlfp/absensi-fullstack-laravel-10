<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'value',
        'experied',
        'approve1',
        'approve2',
        'approve3',
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function User()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

}
