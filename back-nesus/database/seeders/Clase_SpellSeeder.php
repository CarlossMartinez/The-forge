<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Clase_SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/clase_spell'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('clase_spell')->insertOrIgnore([
                    'id' => $d['id'],
                    'clase_id' => $d['clase_id'],
                    'spell_id' => $d['spell_id'],              
                ]);
            }
        }
    }
}
