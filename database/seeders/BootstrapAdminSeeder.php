<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BootstrapAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'W3lc0m3123!';
        
        User::create([
            'name' => 'admin',
            'email' => 'admin@larablog.com',
            'password' => Hash::make($password),
            'status' => 1,
            'role_id' => User::ADMIN
        ]);
    }
}