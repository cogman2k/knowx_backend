<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roadmap;
use App\Models\Post;
use App\Models\User;
use App\Models\ClassList;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoadmapController extends Controller
{
    public function addRoadmap(Request $request){
        $roadmap = Roadmap::where('class_id', $request->class_id)->get();
        if($roadmap){
            Roadmap::where('class_id', $request->class_id)->delete();
        }
        
        Roadmap::create(['post_id'=>$request->post_id, 'class_id' => $request->class_id]);

        return response()->json(["status" => "success", "message" => "Added to roadmap!"]);
    }

    public function getRoadmap(Request $request){
        $roadmap = Roadmap::where('class_id', $request->class_id)->first();
        if($roadmap){
            $post = Post::where('id', $roadmap->post_id)->first();
            return response()->json(["status" => "success", "message" => "get roadmap successfully!", "data" => $post], 200);
        };
        return response()->json(["status" => "failed", "message" => "get roadmap failed"], 200);
        
    }
}
