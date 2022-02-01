<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'admin',
            'mahasiswa',
            'dosen'

        ];

        foreach ($data as $permission) {
            Role::create(['name' => $permission]);
        }
        
    }
}
