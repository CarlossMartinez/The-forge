<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'level',
        'experience',
        'hp_max',
        'hp_current',
        'hp_temp',
        'alignment',
        'image',
        'user_id',
        'race_id',
        'subrace_id',
        'background_id',
        'clase_id',
        'subclass_id',
        'manual_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function subclass()
    {
        return $this->belongsTo(Subclass::class);
    }

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function passives()
    {
        return $this->belongsToMany(passive::class, 'character_skills')
            ->withPivot('value');
    }
    public function proeficiencies()
    {
        return $this->belongsToMany(Proeficiencie::class, 'character_proeficiencie');
    }

    public function stats(){
        return $this->belongsToMany(Stat::class, 'character_stats')->withPivot('value');
    }

    public function feats(){
        return $this->belongsToMany(Feat::class, 'character_feats');  
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'character_items')->withPivot('quantity', 'is_equipped', 'is_attuned'); 
    }

    public function spells(){
        return $this->belongsToMany(Spell::class, 'character_spells')->withPivot('is_prepared'); 
    }

    public function folders(){
        return $this->belongsToMany(Folder::class, 'character_folders');
    }
}