<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $fillable = ['name', 'description', 'system', 'manual_type'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_manuals')
            ->withPivot('enabled')
            ->withTimestamps();
    }

    public function classes()
    {
        return $this->hasMany(Clase::class, 'manual_id');
    }

    public function subclasses()
    {
        return $this->hasMany(Subclass::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }

    public function subraces()
    {
        return $this->hasMany(Subrace::class);
    }

    public function backgrounds()
    {
        return $this->hasMany(Background::class);
    }

    public function feats()
    {
        return $this->hasMany(Feat::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function spells()
    {
        return $this->hasMany(Spell::class);
    }
}