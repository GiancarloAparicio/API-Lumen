<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDemoSeeder extends Seeder
{

    // Run the database seeds. 
    // @return void 
    public function run()
    {

        User::create([
            'name' => 'userDemo',
            'email' => 'user@demo.com',
            'password' => Hash::make('123456789')
        ]);

        User::create([
            'name' => 'moderatorDemo',
            'email' => 'moderator@demo.com',
            'password' => Hash::make('123456789')
        ]);

        User::create([
            'name' => 'adminDemo',
            'email' => 'admin@demo.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
