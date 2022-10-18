<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieRatingSystem extends Model
{
    use HasFactory;

    public function Serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function CertificationCountry()
    {
        return $this->belongsTo(GpCountry::class,'certification_country_id');
    }
}
