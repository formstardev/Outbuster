<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmRatingSystem extends Model
{
    use HasFactory;

    public function Film()
    {
        return $this->belongsTo(Film::class);
    }

    public function CertificationCountry()
    {
        return $this->belongsTo(GpCountry::class,'certification_country_id');
    }
}
