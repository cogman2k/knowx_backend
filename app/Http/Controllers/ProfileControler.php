<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ProfileControler extends Controller
{
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            "old_password" => "required",
            "new_password" => "required|min:3",
            "confirm_password" => "required|same:new_password"  
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>'failed',
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }
        $user=auth()->user();
        //var_dump($user->password);  
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);
 
            return response()->json([
                'status'=>'success',
                'message'=>'Password successfully updated',
            ],200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Old password does not matched',
            ],400);
        }
    }
}
