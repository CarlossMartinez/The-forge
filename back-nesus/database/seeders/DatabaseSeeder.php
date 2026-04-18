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

            Character_SpellSeeder::class,

            Character_FeatSeeder::class,

            Character_PassiveSeeder::class,

            Character_ProeficiencieSeeder::class,

            Character_StatSeeder::class,

            Character_ItemSeeder::class,

            Character_FolderSeeder::class,

            Background_ProeficiencieSeeder::class,

            Race_PassiveSeeder::class,

            Spell_SlotSeeder::class,

            Subclass_PassiveSeeder::class,

            Subclass_SpellSeeder::class,

            Subrace_PassiveSeeder::class,

            Clase_SpellSeeder::class,

            
        ]);
    }
}
