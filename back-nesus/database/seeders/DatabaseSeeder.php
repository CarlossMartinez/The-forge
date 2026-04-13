<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ManualSeeder::class,
           
            ClaseSeeder::class,

            SubclasseSeeder::class,

            RoleSeeder::class,

            UserSeeder::class,

            RaceSeeder::class,

            SubraceSeeder::class,

            PassiveSeeder::class,

            ProeficiencieSeeder::class,
            
            StatSeeder::class,

            FeatSeeder::class,

            SpellSeeder::class,

            ItemSeeder::class,

            BackgroundSeeder::class,

            FolderSeeder::class,

            CharacterSeeder::class,

            Clase_PassiveSeeder::class,

            Clase_ProeficiencieSeeder::class,
        ]);
    }
}
