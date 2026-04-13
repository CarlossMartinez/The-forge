<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Clase_PassiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/classes_passives'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('clase_passive')->insertOrIgnore([
                    'id' => $d['id'],
                    'level_required' => $d['level_required'],
                    'clase_id' => $d['clase_id'],
                    'passive_id' => $d['passive_id'],              
                ]);
            }
        }
    }
}
