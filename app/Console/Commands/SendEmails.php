<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class SendEmails extends Command
{
    protected $signature = 'emails:send';
    protected $description = 'Sending emails to the users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $details = array(
                'firstname' => $user->firstname,
                'token' => $token
            );
            User::where('id',$user->id)->update(['password'=>'']);

            Mail::send('email.reset-password', ['details' => $details], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Réinitialisez votre mot de passe');
            });
        }

        $this->info('The emails are send successfully!');
    }
}
