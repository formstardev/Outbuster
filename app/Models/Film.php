<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function FilmCastMember()
    {
        return $this->hasMany(FilmCastMember::class);
    }

    public function FilmCrewMember()
    {
        return $this->hasMany(FilmCrewMember::class);
    }

    public function FilmCritic()
    {
        return $this->hasMany(FilmCritic::class);
    }

    public function FilmRatingSystem()
    {
        return $this->hasMany(FilmRatingSystem::class);
    }
    public function film_country()
    {
        return $this->belongsTo(GpCountry::class, 'film_country_id');
    }
    
}
