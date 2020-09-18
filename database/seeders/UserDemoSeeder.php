<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDemoSeeder extends Seeder
{

    // Run the database seeds. 
    // @return void 
    public function run()
    {


        $user = new User();
        $user->name = 'userDemo';
        $user->email = 'user@demo.com';
        $user->password = Hash::make('123456789');
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());

        $moderator = new User();
        $moderator->name = 'moderatorDemo';
        $moderator->email = 'moderator@demo.com';
        $moderator->password = Hash::make('123456789');
        $moderator->save();
        $moderator->roles()->attach(Role::where('name', 'moderator')->first());

        $admin = new User();
        $admin->name = 'adminDemo';
        $admin->email = 'admin@demo.com';
        $admin->password = Hash::make('123456789');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());
    }
}
