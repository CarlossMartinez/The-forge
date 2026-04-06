<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'manual_code',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function character()
    {
        return $this->hasMany(Character::class);
    }

    public function subraces()
    {
        return $this->hasMany(Subrace::class);
    }

    public function passives(){
        return $this->belongsToMany(Passive::class  , 'race_passive');
    }
}

