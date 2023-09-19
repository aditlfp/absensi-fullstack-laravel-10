<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportBref extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'tanggal',
        'shift',
        'hadir',
        'spv',
        'tl',
        'ocs',
        'tanpa_keterangan',
        'izin_atau_cuti',
        'sakit',
        'off',
        'total_mp',
        'materi_breafing'
    ];

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }


    // Mehtod - Method

    public function findById($id)
    {
        return $this->findOrFail($id);
    }

    public function getAllData()
    {
        return $this->all();
    }

    public function deleteById($id)
    {
        $brief = $this->find($id);

        if($brief){
            $brief->delete();
            return true;
        }

        return false;
    }
}
