<?php

namespace App\Http\Controllers;

use App\Models\LikeQuestion;
use Illuminate\Http\Request;
use App\Models\Question;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'title' => 'required|min:3|unique:questions,title',
            'hastag' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try{
            $question = Question::create([
                'title' => $request->title,
                'hastag' => $request->hastag,
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
        $question = Auth::user()->questions->find($id);
        if($question){
            return response()->json([
                'status' => 'success',
                'error' => false,
                'data' => $_POST
            ], 200);
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
                'hastag' => 'required',
                'content' => 'required'
            ]);

            if($validator->fails()) {
                return $this->validationErrors($validator->errors());
            }

            $question['title'] = $request->title;
            $question['hastag'] = $request->hastag;
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
    public function getLike(){
        try {
            $user=Auth::user();
            $like = LikeQuestion::where('user_id','=',$user->id)->get();
            
            return response()->json(["status" => "success", "error" => false, "data" => $like], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }
}