<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts;
        return response()->json(["status" => "success", "error" => false, "count" => count($posts), "data" => $posts],200);
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
            "title" => "required|min:3|unique:posts,title",
            "hastag" => "required",
            "content" => "required"
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }

        try {
            $post = Post::create([
                "title" => $request->title,
                "hastag" => $request->hastag,
                "content" => $request->content,
                "user_id" => Auth::user()->id
            ]);
            return response()->json(["status" => "success", "error" => false, "message" => "Success! post created."], 201);
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
        $post = Auth::user()->posts->find($id);

        if($post) {
            return response()->json(["status" => "success", "error" => false, "data" => $post], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! no post found."], 404);
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
        $post = Auth::user()->posts->find($id);

        if($post) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'hastag' => 'required',
                'content' => 'required'
            ]);

            if($validator->fails()) {
                return $this->validationErrors($validator->errors());
            }

            $post['title'] = $request->title;
            $post['hastag'] = $request->hastag;
            $post['content'] = $request->content;

            // // if has active
            // if($request->active) {
            //     $post['active'] = $request->active;
            // }

            // // if has completed
            // if($request->completed) {
            //     $post['completed'] = $request->completed;
            // }

            $post->save();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! post updated."], 201);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no post found."], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Auth::user()->posts->find($id);
        if($post) {
            $post->delete();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! post deleted."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed no post found."], 404);
    }
}