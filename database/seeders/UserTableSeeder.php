<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jitesh Meniya', 
            'email' => 'jiteshmeniya99@gmail.com',
            'nii' => 'IT32087217', 
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);
         
        $role = Role::find(1);

        $permissions = Permission::pluck('id', 'id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        $user1 = User::create([
            'name' => 'Ahmad', 
            'email' => 'ahmad@gmail.com',
            'nii' => '122377798368', 
            'role' => 'dosen',
            'password' => Hash::make('12345678')
        ]);
         
        $role1 = Role::find(1);

        $permissions1 = Permission::pluck('id', 'id')->all();
   
        $role1->syncPermissions($permissions1);
     
        $user1->assignRole([$role1->id]);
    }
}
