<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show Profile View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'profile';
        return view('accounts.profile.index', compact('page_name'));
    }

    /**
     * Update Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'email' => "required|email",
        ]);
        $image = '';
        if (isset($request->image)) {
            $getFileExt   = $request->image->getClientOriginalExtension();
            $image =   time() . '.' . $getFileExt;
            $request->image->storeAs('media/parameters/user/avatars', $image, 'public');
            $image = 'media/parameters/user/avatars/' . $image;
        }
        $birthday =  $request['date_of_birth'];
        $birthday = str_replace('/', '-', $birthday);
        $birthday = date('Y-m-d', strtotime($birthday));
        if ($request['password'] != '') {
            $data = [
                'username' => $request['username'],
                'email' => $request['email'],
                'date_of_birth' => $birthday,
                'gender' => $request['gender'],
                'country_id' => $request['country_id'],
                'address' => $request['address'],
                'zip_code' => $request['zip_code'],
                'city' => $request['city'],
                'newsletter_subscription' => $request['newsletter_subscription'],
                'password' => bcrypt($request['password']),
                'avatar' => $image
            ];
        } else {
            $data = [
                'username' => $request['username'],
                'email' => $request['email'],
                'date_of_birth' => $birthday,
                'gender' => $request['gender'],
                'country_id' => $request['country_id'],
                'address' => $request['address'],
                'zip_code' => $request['zip_code'],
                'city' => $request['city'],
                'newsletter_subscription' => $request['newsletter_subscription'],
                'avatar' => $image
            ];
        }

        User::where('id', Auth::id())->update($data);
        return redirect()->back();
    }
}
