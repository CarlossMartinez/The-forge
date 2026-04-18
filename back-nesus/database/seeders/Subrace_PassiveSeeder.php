<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Subrace_PassiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/subrace_passive'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('subrace_passive')->insertOrIgnore([
                    'id' => $d['id'],
                    'subrace_id' => $d['subrace_id'],
                    'passive_id' => $d['passive_id'],              
                ]);
            }
        }
    }
}
