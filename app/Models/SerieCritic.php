<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieCritic extends Model
{
    use HasFactory;

    public function Serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function SerieCriticName()
    {
        return $this->belongsTo(MpArtworkCritic::class,'serie_critic_name_id');
    }
}
