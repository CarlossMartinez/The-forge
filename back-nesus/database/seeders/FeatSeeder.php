<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class FeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/feats'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $feat) {
                DB::table('feats')->insertOrIgnore([
                    'id' => $feat['id'],
                    'manual_code' => $feat['manual_code'],
                    'name' => $feat['name'],
                    'description' => $feat['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
