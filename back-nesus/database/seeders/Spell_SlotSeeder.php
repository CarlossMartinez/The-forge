<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Spell_SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/spell_slots'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('spell_slots')->insertOrIgnore([
                    'spell_level' => $d['spell_level'],
                    'slots_used' => $d['slots_used'],
                    'character_id' => $d['character_id'],             
                ]);
            }
        }
    }
}
