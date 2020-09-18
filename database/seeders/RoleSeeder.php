<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'user',
            'description' => 'User user'
        ]);

        Role::create([
            'name' => 'moderator',
            'description' => 'User moderator, '
        ]);

        Role::create([
            'name' => 'admin',
            'description' => 'User admin'
        ]);
    }
}
