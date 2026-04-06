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
            DB::table('clases')->insert([
                'id' => $this->LastCharId() + $data['id'],
                'name' => $data['nombre'],
                'descripction' => $data['descripction'],
                'hit_die' => $data['hit_die'],
                'spellcaster' => $data['spellcaster'],
                'spellcasting_ability' => $data['spellcasting_ability'],
                'manual_id' => $data['manual_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function LastCharId()
    {
        $last = DB::table('clases')->latest('id')->first();
        return $last ? $last->id : 0;
    }
}
