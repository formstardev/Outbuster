<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerificationToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Mail;


class RegisterController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:users,email',   // required and email format validation
            'password' => 'required|min:8', // required and number field validation
            'password_confirmation' => 'required|same:password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database

            $user = User::create([
                'username' => $request->firstname . ' ' . $request->lastname,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                'password' =>  bcrypt($request->password),
            ]);

            $token = Str::random(64);

            UserVerificationToken::create([
                'user_id' => $user->id,
                'token' => $token
            ]);

            $email = $request->email;
            $details = array(
                'firstname' => $request->firstname,
                'token' => $token
            );
            Mail::send('email.verify', ['details' => $details], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Vérification');
            });

            return response()->json([
                "status" => true,
                "msg" => "Pour valider votre inscription, veuillez-vous connecter à votre messagerie afin de confirmer votre adresse e-mail.",
                "redirect_location" => url("/")
            ]);
        }
    }
    // public function email()
    // {
    //     $details = array(
    //         'firstname' => 'firstname',
    //         'token' => 'token',
    //     );
    //     return view('email.verify', compact('details'));
    // }
    public function verifyAccount($token)
    {
        $verifyUser = UserVerificationToken::where('token', $token)->first();

        $message = 'Sorry your e-mail cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->is_verified) {
                $user->is_verified =  1;
                $user->email_verified_at =  Carbon::now();
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }


            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->route('home')->with('error', $message);
    }
}
