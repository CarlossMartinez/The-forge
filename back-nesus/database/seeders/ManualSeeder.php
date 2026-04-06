<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::files(public_path('data/manuals'));
        
        if(!$files) return;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);
            DB::table('manuals')->insert([
                'id' => $this->LastManualId() + $data['id'],
                'name' => $data['name'],
                'descripction' => $data['description'],
                'system' => $data['system'],
                'manual_type' => $data['manual_type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    function LastManualId()
    {
        $last = DB::table('manuals')->latest('id')->first();
        return $last ? $last->id : 0;
    }
}
