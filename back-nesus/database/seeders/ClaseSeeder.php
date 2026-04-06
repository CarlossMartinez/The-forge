<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/classes'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $clase) {
                DB::table('clases')->insertOrIgnore([
                'id' => $clase['id'],
                'name' => $clase['name'],
                'description' => $clase['description'],
                'hit_die' => $clase['hit_die'],
                'spellcaster' => $clase['spellcaster'],
                'spellcasting_ability' => $clase['spellcasting_ability'],
                'manual_code' => $clase['manual_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }
        }
    }
}
