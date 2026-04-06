<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class SubraceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/subraces'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $subrace) {
                DB::table('subraces')->insertOrIgnore([
                    'id' => $subrace['id'],
                    'manual_code' => $subrace['manual_code'],
                    'name' => $subrace['name'],
                    'description' => $subrace['description'],
                    'race_id' => $subrace['race_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
