<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function SerieCastMember()
    {
        return $this->hasMany(SerieCastMember::class);
    }

    public function SerieCrewMember()
    {
        return $this->hasMany(SerieCrewMember::class);
    }

    public function SerieCritic()
    {
        return $this->hasMany(SerieCritic::class);
    }

    public function SerieEpisode()
    {
        return $this->hasMany(SerieEpisode::class);
    }

    public function SerieRatingSystem()
    {
        return $this->hasMany(SerieRatingSystem::class);
    }
}
