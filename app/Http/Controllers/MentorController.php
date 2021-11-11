<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\User;
use App\Models\Subject;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MentorController extends Controller
{
    public function createMentor(Request $request){
        $validator = Validator::make($request->all(), [
            "subject_id" => "required",
            "description" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        $check = Mentor::where('subject_id', '=',$request->subject_id)->where('user_id','=', Auth::user()->id)->get();
        
        if(count($check)> 0){
            Mentor::where('subject_id', '=',$request->subject_id)->where('user_id','=', Auth::user()->id)->delete();
        }

        try {
            $mentor = Mentor::create([
                'user_id' => Auth::user()->id,
                'subject_id' => $request->subject_id,
                'description' => $request->description,
            ]);

            return response()->json(["status" => "success", "error" => false, "message" => "Success! Mentor created.", "data"=>$mentor], 201);
        }catch(Exception $exception){
            return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
        }
    }

    public function getListMyMentor(){
        $list = Mentor::where('user_id', Auth::user()->id)->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result", "data"=>[]], 200);
        }
        for( $i=0 ; $i < count($list); $i++){
            $subject = Subject::where('id', $list[$i]->subject_id)->get();
            $list[$i]->{'subject_name'} = $subject[0]->name;

        }
        return response()->json(["status" => "success", "error" => false, "message" => "Success! Get list subject metoring success!.", "data"=>$list], 200);
    }

    public function getMentorBySubject(Request $request){
        $list = Mentor::where('subject_id', $request->subject_id)->where('user_id', '!=', Auth::user()->id)->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result", "data"=>[]], 200);
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

    public function getAllMentor(){
        $list = Mentor::where('user_id', '!=', Auth::user()->id)->get();
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
        return response()->json(["status" => "success", "error" => false,"count" => count($list) ,"message" =>"Success! .", "data"=>$list], 201);
    }

    public function delete(Request $request){
        $item = Mentor::where('user_id', Auth::user()->id)->where('subject_id', $request->subject_id);
        if($item) {
            $item->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no subject you mentoring found."], 404);
    }
}
