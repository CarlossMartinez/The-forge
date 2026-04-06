<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/users'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $user) {
                DB::table('users')->insertOrIgnore([
                'id' => $user['id'],
                'github_id' => $user['github_id'],
                'username' => $user['username'],
                'image' => $user['image'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'remember_token' => $user['remember_token'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }
        }
    }
}
