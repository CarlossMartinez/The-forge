<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/characters'));
        
        if(!$files) return;
        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('characters')->insertOrIgnore([
                    'id' => $d['id'],
                    'manual_code' => $d['manual_code'],
                    'name' => $d['name'],
                    'description' => $d['description'],
                    'level' => $d['level'],
                    'experience' => $d['experience'],
                    'hp_max' => $d['hp_max'],
                    'hp_current' => $d['hp_current'],
                    'hp_temp' => $d['hp_temp'],
                    'alignment' => $d['alignment'],
                    'image' => $d['image'],
                    'race_id' => $d['race_id'],
                    'subrace_id' => $d['subrace_id'],
                    'clase_id' => $d['clase_id'],
                    'subclass_id' => $d['subclass_id'],
                    'background_id' => $d['background_id'],
                    'user_id' => $d['user_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
