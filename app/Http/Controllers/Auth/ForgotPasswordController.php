<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Mail;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',   // required and email format validation

        ]); // create the validations
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return response()->json([__("L'e-mail doit être une adresse e-mail valide.")], 422);
        }
        $user = User::where('email', $request->email)->first();

        if (!is_null($user)) {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $details = array(
                'firstname' => $request->firstname,
                'token' => $token
            );
            Mail::send('email.forgot-password', ['details' => $details], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Mot de passe perdu');
            });
            return response()->json(["status" => true, "message" => __("Nous vous avons envoyé par e-mail le lien de réinitialisation de votre mot de passe.")], 200);
        } else {
            return response()->json([__("L'adresse e-mail est introuvable.")], 422);
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        $token = $request->token;

        $user = DB::table('password_resets')->where('token', '=', $token)->first();
        if ($user) {
            return view('auth.reset-password', ['token' => $token, 'email' => $user->email]);
        } else return redirect()->route('login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $request->validate([
            'token' => ['required'],
            'password' => ['required'],
        ]);
        $userbytoken = DB::table('password_resets')->where(['token' => $request->token])->first();

        if (!$userbytoken) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $userbytoken->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['token' => $request->token])->delete();

        Mail::send('email.new-password',[], function ($message) use ($userbytoken) {
            $message->to($userbytoken->email);
            $message->subject('Mot de passe changé');
        });
        return view('auth.confirm-password');
    }
}
