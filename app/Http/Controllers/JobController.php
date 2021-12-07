<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Bookmark;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "position" => "required",
            "content" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        else{
            try {
                $job = Job::create([
                    "title" => $request->title,
                    "position" => $request->position,
                    "content" => $request->content,
                    "user_id" => Auth::user()->id,
                 ]);
    
                return response()->json(["status" => "success", "error" => false, "message" => "Success! Job created."], 201);
            }
            catch(Exception $exception) {
                return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
            }
        }
    }

    public function getNewestJob(){
        $list = Job::orderBy('created_at','desc')->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result"], 200);
        }
        for( $i=0 ; $i < count($list); $i++){
            $user = User::where('id',$list[$i]->user_id)->get();
            $list[$i]->{'full_name'} = $user[0]->full_name;
            $list[$i]->{'user_image'} = $user[0]->image;
        }
        return response()->json(["status" => "success", "error" => false, "count"=> count($list),"data" => $list], 200); 
    }

    public function show(Request $request)
    {
        $job = Job::find($request->id); 

        if($job) {
            return response()->json(["status" => "success", "error" => false, "data" => $job, "user"=>User::find($job->user_id)], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! no job found."], 404);
    }

}
