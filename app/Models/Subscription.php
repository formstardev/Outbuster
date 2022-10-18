<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscription_date' => 'datetime:Y-m-d',
        'subscription_expiration_date' => 'datetime:Y-m-d',
    ];

    public function SubscriptionUser()
    {
        return $this->belongsTo(User::class,'subscription_user_id');
    }

    public function SubscriptionPlan()
    {
        return $this->belongsTo(Plan::class,'subscription_plan_id');
    }
}
