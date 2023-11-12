<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@app.com',
            'image'=>'default.png',
            'password' => bcrypt('123456'),
        ]);
        $user->addRole('super_admin');

    }
}
