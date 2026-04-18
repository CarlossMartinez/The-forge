<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Character_SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/character_spell'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('character_spell')->insertOrIgnore([
                    'id' => $d['id'],
                    'is_prepared' => $d['is_prepared'],
                    'character_id' => $d['character_id'],
                    'spell_id' => $d['spell_id'],              
                ]);
            }
        }
    }
}
