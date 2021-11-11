<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FindBuddy;
use App\Models\User;
use App\Models\Subject;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FindBuddyController extends Controller
{
    public function createFindBuddy(Request $request){
        $validator = Validator::make($request->all(), [
            "subject_id" => "required",
            "description" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $check = FindBuddy::where('subject_id', '=',$request->subject_id)->where('user_id','=', Auth::user()->id)->get();
        
        if(count($check)> 0){
            FindBuddy::where('subject_id', '=',$request->subject_id)->where('user_id','=', Auth::user()->id)->delete();
        }

        try {
            $findBuddy = FindBuddy::create([
                'user_id' => Auth::user()->id,
                'subject_id' => $request->subject_id,
                'description' => $request->description,
            ]);

            return response()->json(["status" => "success", "error" => false, "message" => "Success! Find buddy created.", "data"=>$findBuddy], 201);
        }catch(Exception $exception){
            return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
        }
    }

    //get buddy by subject
    public function getFindBuddy(Request $request){
        $list = FindBuddy::where('subject_id', $request->subject_id)->where('user_id', '!=', Auth::user()->id)->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result"], 200);
        }
        for( $i=0 ; $i < count($list); $i++){
            $user = User::where('id',$list[$i]->user_id)->get();
            $subject = Subject::where('id', $list[$i]->subject_id)->get();
            $list[$i]->{'full_name'} = $user[0]->full_name;
            $list[$i]->{'image'} = $user[0]->image;
            $list[$i]->{'email'} = $user[0]->email;
            $list[$i]->{'phone'} = $user[0]->phone;
            $list[$i]->{'birthday'} = $user[0]->birthday;
            $list[$i]->{'gender'} = $user[0]->gender;
            $list[$i]->{'bio'} = $user[0]->description;
            $list[$i]->{'subject'} = $subject;
            $list[$i]->{'subject_name'} = $subject[0]->name;

        }
        return response()->json(["status" => "success", "error" => false,"count" => count($list) ,"message" =>"Success!.", "data"=>$list], 201);
    }

    //get all buddy
    public function getAllBuddy(){
        $list = FindBuddy::where('user_id', '!=', Auth::user()->id)->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result"], 200);
        }
        for( $i=0 ; $i < count($list); $i++){
            $user = User::where('id',$list[$i]->user_id)->get();
            $subject = Subject::where('id', $list[$i]->subject_id)->get();
            $list[$i]->{'full_name'} = $user[0]->full_name;
            $list[$i]->{'image'} = $user[0]->image;
            $list[$i]->{'email'} = $user[0]->email;
            $list[$i]->{'phone'} = $user[0]->phone;
            $list[$i]->{'birthday'} = $user[0]->birthday;
            $list[$i]->{'gender'} = $user[0]->gender;
            $list[$i]->{'bio'} = $user[0]->description;
            $list[$i]->{'subject'} = $subject;
            $list[$i]->{'subject_name'} = $subject[0]->name;

        }
        return response()->json(["status" => "success", "error" => false,"count" => count($list) ,"message" =>"Success!.", "data"=>$list], 201);
    }

    public function getMyFindBuddy(){
        $list = FindBuddy::where('user_id', Auth::user()->id)->get();
        for( $i=0 ; $i < count($list); $i++){
            $subject = Subject::where('id', $list[$i]->subject_id)->get();
            $list[$i]->{'subject_name'} = $subject[0]->name;
        }
        return response()->json(["status" => "success", "error" => false, "message" => "Success! Get list your find buddy successfully!.", "data"=>$list], 200);
    }

    public function delete(Request $request){
        $item = FindBuddy::where('user_id', Auth::user()->id)->where('subject_id', $request->subject_id)->get();
        if(count($item)>0) {
            FindBuddy::where('user_id', Auth::user()->id)->where('subject_id', $request->subject_id)->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no find buddy found."], 404);
    }
}
