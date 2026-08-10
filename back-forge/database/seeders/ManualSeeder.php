<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/manuals'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            
            foreach ($data as $manual) {
                DB::table('manuals')->insertOrIgnore([
                    'manual_code' => $manual['manual_code'],
                    'name' => $manual['name'],
                    'description' => $manual['description'],
                    'system' => $manual['system'],
                    'manual_type' => $manual['manual_type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'is_active' => $manual['is_active'] ?? true,
                    'user_id' => $manual['user_id'] ?? 1, // Asignar un valor predeterminado si no se proporciona
                ]);
            }
        }
    }
}
