<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'plan_id',
        'expiration_date',
        'transaction_id',
    ];
    public function user_name()
    {
        $user = User::where('id', $this->user_id)->first();
        if($user){
            if(!is_null($user->name) && $user->name != "") return $user->name;
            else return $user->email;            
        }else{
            return "No Such User";
        }
    }
}
