<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class spellSlots extends Model
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
    protected $hidden = ['created_at', 'updated_at'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
