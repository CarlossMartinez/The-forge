<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class Character_ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/character_item'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            foreach ($data as $d) {
                DB::table('character_item')->insertOrIgnore([
                    'id' => $d['id'],
                    'quantity' => $d['quantity'],
                    'is_equipped' => $d['is_equipped'],
                    'is_attuned' => $d['is_attuned'],
                    'character_id' => $d['character_id'],
                    'item_id' => $d['item_id'],              
                ]);
            }
        }
    }
}
