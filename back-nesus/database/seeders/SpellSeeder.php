<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/spells'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $spell) {
                DB::table('spells')->insertOrIgnore([
                    'id' => $spell['id'],
                    'manual_code' => $spell['manual_code'],
                    'name' => $spell['name'],
                    'description' => $spell['description'],
                    'level' => $spell['level'],
                    'school' => $spell['school'],
                    'casting_time' => $spell['casting_time'],
                    'range' => $spell['range'],
                    'components' => $spell['components'],
                    'duration' => $spell['duration'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
