<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'feedback_resolution_date' => 'datetime:Y-m-d',
    ];

    public function FeedbackUser()
    {
        return $this->belongsTo(User::class,'feedback_user_id');
    }
}
