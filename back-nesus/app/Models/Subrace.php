<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subrace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'manual_id',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function character()
    {
        return $this->hasMany(Character::class);
    }

    public function passives(){
        return $this->belongsToMany(Passive::class  , 'subrace_passive')->withPivot('level_required');
    }
}
