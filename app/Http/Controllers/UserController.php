<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;


class UserController extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:3",
            "phone" => "required|min:10"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => $request->first_name . " ".$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]); 
        event(new Registered($user));
        return response()->json(["status" => "success", "error" => false, "message" => "Success! User registered."], 201);
    }

    /**
     * User Login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:3"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('token')->accessToken;
                return response()->json(
                    [
                        "status" => "success",
                        "error" => false,
                        "message" => "Success! you are logged in.",
                        "token" => $token,
                    ]
                );
            }
            return response()->json(["status" => "failed", "message" => "Failed! invalid credentials."], 404);
        }
        catch(Exception $e) {
            return response()->json(["status" => "failed", "message" => $e->getMessage()], 404);
        }
    }

    /**
     * Logged User Data Using Auth Token
     *
     * @return void
     */
    public function user() {
        try {
            $user = Auth::user();
            return response()->json(["status" => "success", "error" => false, "data" => $user], 200);
        }
        catch(NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

    /**
    * Logout Auth User
    *
    * @param Request $request
    * @return void
    */
    public function logout() {

        if(Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! You are logged out."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! You are already logged out."], 403);
    }

    public function verified(){
        // return response()->json(["status" => "success", "message" => "Chúc mừng bạn đã xác nhận email thành công!"]);
        return view('verified');
    }

    // public function forgotPassword(Request $request){
    //     $input = $request->only('email');
    //     $validator = Validator::make($input, [
    //         'email' => "required|email"
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors());
    //     }
    //     $response = Password::sendResetLink($input);
    
    //     $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
        
    //     return response()->json($message);
    // }

    // public function passwordReset(Request $request){
    //     $input = $request->only('email','token', 'password', 'password_confirmation');
    //     $validator = Validator::make($input, [
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors());
    //     }
    //     $response = Password::reset($input, function ($user, $password) {
    //         $user->password = Hash::make($password);
    //         $user->save();
    //     });
    //     $message = $response == Password::PASSWORD_RESET ? 'Password reset successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
    //     return response()->json($message);
    // }
    public function forgotPassword(Request $request)
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
    
}