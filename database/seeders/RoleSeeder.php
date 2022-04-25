<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        $someRoles = ['ADMIN', 'PUBLISHER'];

        for ($i=0; $i < count($someRoles); $i++) { 
            # code...
            Role::create([
                'role_name' => $someRoles[$i]
            ]);
        }
    }
}
