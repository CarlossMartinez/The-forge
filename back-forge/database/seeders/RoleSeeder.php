<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $roles = [
            'admin',
            'gestor',
            'user'
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insertOrIgnore([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
