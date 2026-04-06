<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class SubclasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/subclasses'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $subclasse) {
                DB::table('subclasses')->insertOrIgnore([
                'id' => $subclasse['id'],
                'clase_id' => $subclasse['clase_id'],
                'name' => $subclasse['name'],
                'description' => $subclasse['description'],
                
                'manual_code' => $subclasse['manual_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }
        }
    }
}
