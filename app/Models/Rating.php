<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'leader_name',
        'mitra_name',
        'isLeader',
        'isMitra',
        'user_id',
        'rate_mitra',
        'rate_leader',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
