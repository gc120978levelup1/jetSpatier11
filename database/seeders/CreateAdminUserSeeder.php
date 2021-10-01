<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@world.com',
            'password' => Hash::make('password')
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $role = Role::where('name','=','Admin')->get();
        $user = User::create([
            'name' => 'user1',
            'email' => 'user1@world.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role[0]->id);

        $user = User::create([
            'name' => 'user2',
            'email' => 'user2@world.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role[0]->id);
    }
}
