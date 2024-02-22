<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    function forgotPassword()
    {
        return view('auth.request-password');
    }

    function PostforgotPassword(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Verander Wachtwoord");
        });

        return redirect(Route('forgotpwd'))->withSuccess("Mail voor het herstellen van wachtwoord gestuurd");
    }

    function ResetPassword($token)
    {
        return view("auth.new-password", compact('token'));
    }

    function PostresetPassword(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|min:6|confirmed",
            "password_confirmation" => "required"
        ],
        [
            'email.exists' => 'Email bestaat niet',
            'email.required' => 'Vul je email in',
            'email.email' => 'Vul je email in',
            'password.required' => 'Vul een wachtwoord in',
            'password.string' => 'Vul een wachtwoord in',
            'password.confirmed' => 'Het wachtwoord komt niet overheen',
            'password_confirmation.required' => 'Bevestig je wachtwoord',
        ]);

        $updatePassword = DB::table('password_resets')
        ->where([
            "email" => $request->email,
            "token" => $request->token
        ])->first();

        if (!$updatePassword){
            return redirect(Route("Resetpwd"))->withErrors("fout");
        }


        User::where("email", $request->email)
        ->update(["password" => Hash::make($request->password)]);

        DB::table("password_resets")
        ->where(["email" => $request->email])->delete();

        return redirect("login")->withSuccess('Wachtwoord opnieuw ingesteld');
    }
}
