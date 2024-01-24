<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = ['title'];

    public function newEloquentBuilder($query)
    {
        return new ProfessionQuery($query);
    }

    public function profiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'skill_profession');
    }
}
