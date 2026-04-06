<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/items'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $item) {
                DB::table('items')->insertOrIgnore([
                    'id' => $item['id'],
                    'manual_code' => $item['manual_code'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'type' => $item['type'],
                    'rarity' => $item['rarity'],
                    'weight' => $item['weight'],
                    'value' => $item['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
