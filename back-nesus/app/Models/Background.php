<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
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

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function proeficiencies()
    {
        return $this->belongsToMany(Proeficiencie::class, 'background_proficiency');
    }
}
