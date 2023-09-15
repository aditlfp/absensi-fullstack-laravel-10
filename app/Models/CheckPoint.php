<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_count',
        'name',
        'client_id'
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Image()
    {
        return $this->hasMany(Image::class);
    }
}
