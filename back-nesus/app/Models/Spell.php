<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'level',
        'school',
        'casting_time',
        'range',
        'components',
        'duration',
        'manual_code',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_spell')->withPivot('is_prepared');
    }

    public function subclasses()
    {
        return $this->belongsToMany(Subclass::class, 'subclass_spell');
    }

    public function classes()
    {
        return $this->belongsToMany(Clase::class, 'class_spell');
    }

}
