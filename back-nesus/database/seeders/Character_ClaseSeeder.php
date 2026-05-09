<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Character_ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/character_clase'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('character_clase')->insertOrIgnore([
                    'character_id' => $d['character_id'],
                    'clase_id' => $d['clase_id'],
                    'subclass_id' => $d['subclass_id'],
                    'level' => $d['level'],            
                ]);
            }
        }
    }
}
