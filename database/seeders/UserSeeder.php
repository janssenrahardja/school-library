<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'           => 'admin',
            'email'          => 'admin@library.com',
            'roles'          => 'admin',
            'password'       => Hash::make('admin1234')
        ]);

        User::create([
            'name'           => 'user',
            'email'          => 'user@library.com',
            'roles'          => 'user',
            'password'       => Hash::make('user1234')
        ]);
    }
}
