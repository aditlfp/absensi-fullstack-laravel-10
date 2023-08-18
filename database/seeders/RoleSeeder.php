<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['user', 'admin'];
        foreach($arr as $data => $value){
            $role = new Role();
            $role->name = $value;
            $role->save();
        }
    }
}
