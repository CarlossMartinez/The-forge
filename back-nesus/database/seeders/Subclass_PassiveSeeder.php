<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Subclass_PassiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/subclass_passive'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('subclass_passive')->insertOrIgnore([
                    'id' => $d['id'],
                    'subclass_id' => $d['subclass_id'],
                    'passive_id' => $d['passive_id'],              
                ]);
            }
        }
    }
}
