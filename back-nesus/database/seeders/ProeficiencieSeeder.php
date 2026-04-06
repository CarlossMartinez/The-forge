<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ProeficiencieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/proeficiencies'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $proeficiencie) {
                DB::table('proeficiencies')->insertOrIgnore([
                    'id' => $proeficiencie['id'],
                    'manual_code' => $proeficiencie['manual_code'],
                    'name' => $proeficiencie['name'],
                    'description' => $proeficiencie['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
