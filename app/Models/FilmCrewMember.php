<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCrewMember extends Model
{
    use HasFactory;

    public function Film()
    {
        return $this->belongsTo(Film::class);
    }
}
