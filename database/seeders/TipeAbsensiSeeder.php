<?php

namespace Database\Seeders;

use App\Models\TipeAbsensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['absensi_masuk', 'absensi_keluar'];
        foreach($arr as $data => $value){
            $tipeabsensi = new TipeAbsensi();
            $tipeabsensi->name = $value;
            $tipeabsensi->save();
        }
    }
}
