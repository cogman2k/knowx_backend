<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\ClassList;
use App\Models\Member;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function getClassInfo(Request $request){
        $class = ClassList::where("id", $request->class_id)->first();
        if($class){

            return response()->json(["status" => "success", "data" => $class], 200);
        }
        return response()->json(["status" => "failed"], 200);
    }

    public function isMentor(Request $request){
        $mentor = ClassList::where('user_id', Auth::user()->id)->where('id', $request->class_id)->first();
        if($mentor){
            return response()->json(["status" => "isMentor", "data" => $mentor], 200);
        }
        return response()->json(["status" => "notMentor"], 200);
    }

    public function addMember(Request $request){
        $user = Member::where("user_id", "=",  $request->user_id)->where("class_id", "=", $request->class_id)->get();
        // var_dump($user);
        if(count($user) > 0){
            return response()->json(["status" => "added", "message" => "This person was already in the class!"], 200);
        }
        else{
            Member::create([
                'user_id' => $request->user_id,
                'class_id' => $request->class_id
            ]);

            return response()->json(["status" => "success", "message" => "add member successfully!"], 200);
        }

        return response()->json(["status" => "failed", "message" => "add user to class failed!"], 200);
    }

    public function removeMember(Request $request){
        $member = Member::where("user_id", $request->user_id)->where("class_id", $request->class_id)->delete();

        if($member){

            return response()->json(["status" => "success", "message" => "remove member successfully!"], 200);
        }
        
        return response()->json(["status" => "failed", "message" => "remove member failed!"], 200);

    }

    public function getMembers(Request $request){
        $members = Member::where("class_id", $request->class_id)->orderBy('created_at', 'desc')->get();
        $data = [];
        for ( $i = 0; $i < count($members); $i++){
            $data[$i] = User::find($members[$i]->user_id);
        }
        $user_id = DB::table("class_lists")->where("id", "=" , $request->class_id)->first();
        $author = User::where("id", "=" , $user_id->user_id)->first();
        return response()->json(["status" => "success", "data" => $data, "count" => count($data), "author" => $author], 200);
    }

    public function getClass(){
        $classAuthor = [];
        $classAuthor = ClassList::where('user_id', Auth::user()->id)->get();
        $members = Member::where('user_id', Auth::user()->id)->get();
        $classMember = [];
        for($i = 0; $i < count($members); $i++){
            $tmp = ClassList::where("id", $members[$i]->class_id)->first();
            array_push($classMember, $tmp);
        }
        if(count($classAuthor) > 0 && count($classMember) > 0){
            $class = array_merge($classAuthor, $classMember);
            return response()->json(["status" => "success1", "data" => $class], 200);
        }
        if(count($classMember) > 0 && count($classAuthor) === 0){
            return response()->json(["status" => "success2", "data" => $classMember], 200);
        }
        if(count($classMember) === 0 && count($classAuthor) > 0){
            return response()->json(["status" => "success3", "data" => $classAuthor], 200);
        }
        return response()->json(["status" => "failed", "data" => []], 200);
    }
}
