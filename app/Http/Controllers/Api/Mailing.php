<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RecoveryPasswordApp;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class Mailing extends Controller
{

    // Create function send email to user, recibe email params and validate exist in table users, generate token in table password_resets
    // and send email with token to user

    public function sendMail(Request $request, $email)
    {
        $user = User::where('email', $email)->first();

        if ($user == null) {
//            return response()->json(['message' => 'User not found'], 404);
            return response()->json(['message' => 'ok', 'status' => 'ok']);
        } else {
            $token =  uniqid(rand(), true);
            $token = substr($token, 0, 5);

//            DB::table('password_resets')->where('email', $email)->delete();
            DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]);

            Mail::to($email)->send(new RecoveryPasswordApp($user->name, $token));

            return response()->json(['message' => 'Email sent', 'status' => 'send']);
        }
    }

}
