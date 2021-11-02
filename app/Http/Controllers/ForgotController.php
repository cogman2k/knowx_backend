<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    public function forgotPassword(ForgotRequest $request)
    {
        $email = $request->email;
        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'Email Invalid'
            ], 404);
        }
        $token = rand(10, 100000);
        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);
            Mail::send('Mail.forgotMail', ['token' => $token], function (Message $message) use ($email) {
                $message->to($email);
                $message->subject('Reset your password');
            });
            return response([
                'message' => 'Check your email!'
            ]);
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    
    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');
        if ($passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Invalid token!'
            ], 400);
        }
        /** @var User $user */
        if (!$user = User::where('email', $passwordResets->mail)->first()) {
            return response([
                'message' => 'User doesnt exist!'
            ], 404);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response([
            'message' => 'Successfully!'
        ], 400);
    }
}
