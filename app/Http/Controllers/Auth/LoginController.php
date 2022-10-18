<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle account login request
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return with 422 status

        } else {
            $user = User::where('email', $request->email)->where('is_deleted', 0)->first();
            if ($user) {
                if ($user->is_verified) {
                    //validations are passed try login using laravel auth attemp
                    if (Auth::attempt($request->only(["email", "password"]))) {
                        return response()->json(["status" => true, "redirect_location" => url("/account/profile")]);
                    } else {
                        return response()->json([["Invalid credentials"]], 422);
                    }
                } else {
                    return response()->json([["Cette adresse e-mail n'a pas été vérifiée."]], 422);
                }
            } else {
                return response()->json([["Invalid credentials"]], 422);
            }
        }
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
