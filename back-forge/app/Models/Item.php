<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'rarity',
        'wheight',
        'value',
        'manual_code',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_item')->withPivot('quantity', 'is_equipped','is_attuned');
    }
}
