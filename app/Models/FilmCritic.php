<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCritic extends Model
{
    use HasFactory;

    public function Film()
    {
        return $this->belongsTo(Film::class);
    }

    public function FilmCriticName()
    {
        return $this->belongsTo(MpArtworkCritic::class,'film_critic_name_id');
    }
}
