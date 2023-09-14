<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nama_lengkap',
        'kerjasama_id',
        'email',
        'password',
        'image',
        'devisi_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
     public function hasReceivedNotificationToday()
    {
        return $this->last_notification_date === Carbon::today()->toDateString();
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function Kerjasama()
    {
        return $this->belongsTo(Kerjasama::class, 'kerjasama_id', 'id');
    }

    public function Absensi()
    {
        return $this->hasMany(Absensi::class);
    }
    public function Divisi()
    {
        return $this->belongsTo(Divisi::class, 'devisi_id', 'id');
    }
    public function JadwalUser(): HasMany
    {
        return $this->hasMany(JadwalUser::class);
    }

    public function CheckPoint()
    {
        return $this->hasMany(User::class);
    }
    public function Rating()
    {
        return $this->hasMany(Rating::class);
    }
    
}
