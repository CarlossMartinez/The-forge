<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Character_ProeficiencieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/character_proeficiencie'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('character_proeficiencie')->insertOrIgnore([
                    'id' => $d['id'],
                    'character_id' => $d['character_id'],
                    'proeficiencie_id' => $d['proeficiencie_id'],              
                ]);
            }
        }
    }
}
