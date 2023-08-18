<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jabatan::factory()->create([
            'divisi_id' => '1',
            'code_jabatan' => 'AD001',
            'type_jabatan' => 'manajemen',
            'name_jabatan' => 'admin',
        ]);
        \App\Models\Jabatan::factory()->create([
            'divisi_id' => '1',
            'code_jabatan' => 'AD001',
            'type_jabatan' => 'manajemen',
            'name_jabatan' => 'leader',
        ]);
        \App\Models\Jabatan::factory()->create([
            'divisi_id' => '1',
            'code_jabatan' => 'SVP-P',
            'type_jabatan' => 'manajemen',
            'name_jabatan' => 'spv',
        ]);
    }
}
