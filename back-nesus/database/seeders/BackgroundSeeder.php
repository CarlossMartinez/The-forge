<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class BackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/backgrounds'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $background) {
                DB::table('backgrounds')->insertOrIgnore([
                    'id' => $background['id'],
                    'manual_code' => $background['manual_code'],
                    'name' => $background['name'],
                    'description' => $background['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
