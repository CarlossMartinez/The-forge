<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\Race;
use App\Models\Subrace;
use App\Models\Background;
use App\Models\Clase;
use App\Models\Subclass;
use App\Models\Manual;
use App\Models\Stat;
use App\Models\Spell;
use App\Models\Item;
use App\Models\Feat;
use App\Models\Passive;
use App\Models\Proeficiencie;
use App\Models\Folder;
use App\Models\spellSlots;
class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'level', 'experience',
        'hp_max', 'hp_current', 'hp_temp', 'alignment',
        'image', 'enabled', 'user_id', 'race_id', 'subrace_id',
        'background_id', 'clase_id', 'subclass_id', 'manual_code',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function subrace()
    {
        return $this->belongsTo(Subrace::class);
    }

    public function background()
    {
        return $this->belongsTo(Background::class);
    }

    public function subclass()
    {
        return $this->belongsTo(Subclass::class, 'subclass_id');
    }

    public function manual()
    {
        return $this->belongsTo(Manual::class, 'manual_code', 'manual_code');
    }

    public function stats()
    {
        return $this->belongsToMany(Stat::class, 'character_stat')
                    ->withPivot('value');
    }

    public function spells()
    {
        return $this->belongsToMany(Spell::class, 'character_spell')
                    ->withPivot('is_prepared');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'character_item')
                    ->withPivot('quantity', 'is_equipped', 'is_attuned');
    }

    public function feats()
    {
        return $this->belongsToMany(Feat::class, 'character_feat');
    }

    public function passives()
    {
        return $this->belongsToMany(Passive::class, 'character_passive');
    }

    public function proeficiencies()
    {
        return $this->belongsToMany(
            Proeficiencie::class,
            'character_proeficiencie',
            'character_id',
            'proeficiencie_id'
        );
    }
    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'character_clase')
            ->withPivot('level', 'subclass_id')
            ->withTimestamps();
    }
    public function folders()
    {
        return $this->belongsToMany(Folder::class, 'character_folder');
    }

    public function spellSlots()
    {
        return $this->hasMany(spellSlots::class);
    }
}