<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/folders'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $reg) {
                DB::table('folders')->insertOrIgnore([
                    'id' => $reg['id'],
                    'user_id' => $reg['user_id'],
                    'name' => $reg['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
