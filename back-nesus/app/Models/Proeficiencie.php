<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proeficiencie extends Model
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
    public function backgrounds()
    {
        return $this->belongsToMany(Background::class, 'background_proficiencie');
    }

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'class_proficiencie');
    }

    public function characters()
    {
        return $this->belongsToMany(character::class, 'class_proficiencie');
    }
}
