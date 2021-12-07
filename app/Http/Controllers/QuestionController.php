<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\LikeQuestion;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Auth::user()->questions;
        return response()->json([
            "status" => "success",
            "error" =>  false,
            "count" => count($questions),
            "data" => $questions,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'hashtag' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try{
            $question = Question::create([
                'title' => $request->title,
                'hashtag' => $request->hashtag,
                'content' => $request->content,
                'user_id' => Auth::user()->id
            ]);
            return response()->json(["status" => "success", "error" => false, "message" => "Question created successfully!"], 201);
        }
        catch(Exception $exception) {
            return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = question::find($id); 

        if($question) {
            return response()->json(["status" => "success", "error" => false, "data" => $question, "user"=>User::find($question->user_id)], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! no question found."], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Auth::user()->questions->find($id);

        if($question) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'hashtag' => 'required',
                'content' => 'required'
            ]);

            if($validator->fails()) {
                return $this->validationErrors($validator->errors());
            }

            $question['title'] = $request->title;
            $question['hashtag'] = $request->hashtag;
            $question['content'] = $request->content;
            $question->save();
            
            return response()->json(["status" => "success", "error" => false, "message" => "Success! question updated."], 201);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no question found."], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Auth::user()->questions->find($id);
        if($question) {
            $question->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! question deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no question found."], 404);
    }

     //get newest question 
    public function getNewestQuestion(){
        $list = Question::orderBy('created_at','desc')->get();
        if(count($list) == 0){
            return response()->json(["status" => "failed", "message"=>"Nothing question result"], 200);
        }
        for( $i=0 ; $i < count($list); $i++){
            $user = User::where('id',$list[$i]->user_id)->get();
            $list[$i]->{'full_name'} = $user[0]->full_name;
            $list[$i]->{'user_image'} = $user[0]->image;
        }
        return response()->json(["status" => "success", "error" => false, "count"=> count($list),"data" => $list], 200);
    }

    public function getQuestionByUserId(Request $request){
        $questions = DB::table('questions')->where('user_id', $request->user_id)->get();
        if(count($questions)>0){
            return response()->json(["status" => "success", "error" => false, "count"=> count($questions), "data" => $questions], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! no question found."], 200);
    }

    public function questionLike(Request $request)
    {
        $user = Auth::user();  

        $validator = Validator::make($request->all(), [
            "question_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };
        $like = DB::table('like_questions')->where('user_id', '=', $user->id)->where('question_id', '=', $request->question_id)->get();

        if (count($like)>0) {
            DB::table('like_questions')->where('user_id', '=', $user->id)->where('question_id', '=', $request->question_id)->delete();
            if($like){
            DB::table('questions')->decrement('like');
            }

            return response()->json(["status" => "success", "type" => "dislike", "error" => false, "message" => "Successfully dislike question."], 201);
        }
        LikeQuestion::create([
            'user_id'=>$user->id,
            'question_id' => $request->question_id,
        ]);
        DB::table('questions')->increment('like');
        return response()->json(["status" => "success", "type" => "like", "error" => false, "message" => "Successfully like question."], 404);

    }

    public function checkLike(Request $request){
        $like = LikeQuestion::where('user_id', Auth::user()->id)
                            ->where('question_id', $request->post_id)->get();
        if(count($like)>0){
            return response()->json(["status" => "success", "error" => false, "result" => true], 200);
        }
        return response()->json(["status" => "success", "error" => false, "result" => false], 200);
    }

    public function getLike(){
        try {
            $user=Auth::user();
            $like = LikeQuestion::where('user_id','=',$user->id)->get();

            return response()->json(["status" => "success", "error" => false, "data" => $like], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

    public function search(Request $request){
        try {
            $question = Question::where('title','like','%'.$request->data.'%')
            ->orWhere('hashtag','like','%'.$request->data.'%')
            ->get();
            for( $i=0 ; $i < count($question); $i++){
                $user = User::where('id', $question[$i]->user_id)->get();
                $question[$i]->{'author_id'} = $user[$i]->id;
                $question[$i]->{'full_name'} = $user[$i]->full_name;
                $question[$i]->{'user_image'} = $user[$i]->image;
            }
            return response()->json(["status" => "success", "error" => false, "data" => $question], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }
}