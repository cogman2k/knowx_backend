<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\LikePost;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //get my posts
    public function index()
    {
        $posts = Auth::user()->posts;
        return response()->json(["status" => "success", "error" => false, "count" => count($posts), "data" => $posts], 200);
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
            "title" => "required",
            "hashtag" => "required",
            "content" => "required",
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()) {
            return $this->validationErrors($validator->errors());
        }
        else{
            try {
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/post', $filename);
                    
                    $post = Post::create([
                        "title" => $request->title,
                        "hashtag" => $request->hashtag,
                        "content" => $request->content,
                        "user_id" => Auth::user()->id,
                        "image" => 'uploads/post/'.$filename,
                    ]);
                }
    
                return response()->json(["status" => "success", "error" => false, "message" => "Success! post created."], 201);
            }
            catch(Exception $exception) {
                return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
            }

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
        $post = Post::find($id); 

        if($post) {
            return response()->json(["status" => "success", "error" => false, "data" => $post, "user"=>User::find($post->user_id)], 200);
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
                'hashtag' => 'required',
                'content' => 'required',
                
            ]);
            
            if($validator->fails()) {
                return $this->validationErrors($validator->errors());
            }

            $post['title'] = $request->title;
            $post['hashtag'] = $request->hashtag;
            $post['content'] = $request->content;
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

    //get newest post 
    public function getNewestPost(){
        $list = Post::orderBy('created_at','desc')->get();
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

    public function getPostByUserId(Request $request){
        $posts = DB::table('posts')->where('user_id', $request->user_id)->get();
        if(count($posts)>0){
            return response()->json(["status" => "success", "error" => false, "count"=> count($posts), "data" => $posts], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! no post found."], 200);
    }

    // add/remove bookmark
    public function bookmark(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            "post_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };
        $bookmark = DB::table('bookmarks')->where('user_id', '=', $user->id)->where('post_id', '=', $request->post_id)->get();
        if (count($bookmark)>0) {
            DB::table('bookmarks')->where('user_id', '=', $user->id)->where('post_id', '=', $request->post_id)->delete();
            return response()->json(["status" => "success", "type" => "unbookmark", "error" => false, "message" => "Successfully unbookmark."], 201);
        }
        Bookmark::create([
            'user_id'=>$user->id,
            'post_id' => $request->post_id,
        ]);
        return response()->json(["status" => "success", "type" => "bookmark", "error" => false, "message" => "Successfully bookmark."], 404);
    }

    //get list bookmark
    public function getBookmark(){
        try {
            $bookmark = Bookmark::where('user_id', Auth::user()->id)->get();
            for( $i=0 ; $i < count($bookmark); $i++){
                $post = Post::where('id', $bookmark[$i]->post_id)->get();
                $user = User::where('id', $post[0]->user_id)->get();
                $bookmark[$i]->{'author_id'} = $user[0]->id;
                $bookmark[$i]->{'full_name'} = $user[0]->full_name;
                $bookmark[$i]->{'user_image'} = $user[0]->image;
                $bookmark[$i]->{'title'} = $post[0]->title;
                $bookmark[$i]->{'image'} = $post[0]->image;
                $bookmark[$i]->{'content'} = $post[0]->content;
                $bookmark[$i]->{'hashtag'} = $post[0]->hashtag;
            }

            return response()->json(["status" => "success", "error" => false, "data" => $bookmark], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

    // check post bookmarking?
    public function checkBookmark(Request $request){
        $bookmark = Bookmark::where('user_id', Auth::user()->id)
                            ->where('post_id', $request->post_id)->get();
        if(count($bookmark)>0){
            return response()->json(["status" => "success", "error" => false, "result" => true], 200);
        }
        return response()->json(["status" => "success", "error" => false, "result" => false], 200);
    }

    public function checkLike(Request $request){
        $like = LikePost::where('user_id', Auth::user()->id)
                            ->where('post_id', $request->post_id)->get();
        if(count($like)>0){
            return response()->json(["status" => "success", "error" => false, "result" => true], 200);
        }
        return response()->json(["status" => "success", "error" => false, "result" => false], 200);
    }

    public function postLike(Request $request)
    {
        $user = Auth::user();  
        
        $validator = Validator::make($request->all(), [
            "post_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->validationErrors($validator->errors());
        };
        $like = DB::table('like_posts')->where('user_id', '=', $user->id)->where('post_id', '=', $request->post_id)->get();
        
        if (count($like)>0) {
            DB::table('like_posts')->where('user_id', '=', $user->id)->where('post_id', '=', $request->post_id)->delete();
            if($like){
            DB::table('posts')->decrement('like');
            }
            
            return response()->json(["status" => "success", "type" => "dislike", "error" => false, "message" => "Successfully dislike post."], 201);
        }
        LikePost::create([
            'user_id'=>$user->id,
            'post_id' => $request->post_id,
        ]);
        DB::table('posts')->increment('like');
        return response()->json(["status" => "success", "type" => "like", "error" => false, "message" => "Successfully like post."], 404);

    }

    public function masterPost(){
        $list = DB::table('posts')->orderBy('comment', 'desc')->orderBy('like', 'desc')->get();
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

    public function getRecommentPost(){
        $list = DB::table('posts')->orderBy('comment', 'desc')->orderBy('like', 'desc')->take(3)->get();
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
    
    public function getLike(){
        try {
            $user=Auth::user();
            $like = LikePost::where('user_id','=',$user->id)->get();
            
            return response()->json(["status" => "success", "error" => false, "data" => $like], 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }
}   