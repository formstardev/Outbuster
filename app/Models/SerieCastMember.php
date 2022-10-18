<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieCastMember extends Model
{
    use HasFactory;

    public function Serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
