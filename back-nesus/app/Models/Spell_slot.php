<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spell_slot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'spell_level',
        'slots_used',
        'character_id',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
