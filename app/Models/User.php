<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Stripe\Coupon;
use Stripe\Stripe;
use Laravel\Cashier\Billable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'is_verified',
        'is_deleted',
        'stripe_id',
        'pm_type',
        'pm_last_four',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'datetime:Y-m-d',
    ];

    public function UserCountry()
    {
        return $this->belongsTo(GpCountry::class,'country_id');
    }


    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    
    public function current_plan()
    {
        $subscription = Subscription::select('plans.*', 'subscriptions.name AS subscriptions_type','subscriptions.stripe_id', 'subscriptions.ends_at')->join('plans', 'plans.stripe_plan_id', 'subscriptions.stripe_price', 'left')
            ->where('user_id', $this->id)->where('stripe_status', 'active')->first();
        if ($subscription) {
            if(is_null($subscription->ends_at) || $subscription->ends_at >= date("Y-m-d"))
                return $subscription;
            else return null;
        } else {
            return null;
        }
    }

    public function checkSubscription()
    {
        // return $this->subscriptions()->active()->get()->first();
        return Subscription::where('user_id', $this->id)->where('stripe_status', 'active')->first();
    }
    
}
