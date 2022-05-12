<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CommentPost;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CommentPostController extends Controller
{
    public function createComment(Request $request){
        $validator = Validator::make($request->all(), [
            "post_id" => "required",
            "comment" => "required",
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        CommentPost::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
        ]);

        DB::table('posts')->where('id', $request->post_id)->increment('comment');

        // tăng xp user 
        DB::table('users')->where('id', Auth::user()->id)->increment('xp');

        return response()->json(["status" => "success", "error" => false, "message" => "Success! Comment created!."], 201);
    }

    public function getListComment(Request $request){
        $listComment = CommentPost::where('post_id', $request->post_id)->orderBy('created_at','desc')->get();
        if(count($listComment) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing result"], 200);
        }
        for( $i=0 ; $i < count($listComment); $i++){
            $user = User::where('id',$listComment[$i]->user_id)->get();
            $listComment[$i]->{'full_name'} = $user[0]->full_name;
            $listComment[$i]->{'image'} = $user[0]->image;
        }
        return response()->json(["status" => "success", "error" => false,"count" => count($listComment) ,"message" =>"Success!.", "data" => $listComment], 201);
    }

    public function removeComment(Request $request){
        if($request->id){
            $removedComment = CommentPost::where('id', $request->id)->delete();
            return response()->json(["status" => "success", "message" => "Deleted this comment"]);
        }
        return response()->json(["status" => "failed", "comment not found!"], 200);
    }
}
