<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Events\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function message(Request $request)
    {
        event(new Message($request->input('username'), $request->input('message')));
        // event(new Message($request->target_id, $request->message));
        // try {
        //     $message = Messages::create([
        //         'user_id' => Auth::user()->id,
        //         'target_id' => $request->target_id,
        //         'message' => $request->input("message"),
        //     ]);

        //     return response()->json(["status" => "success", "error" => false, "message" => "Success! Message sent.", "data"=>$message], 201);
        // }catch(Exception $exception){
        //     return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
        // }
        return [];
    }

    public function getMessage(Request $request){
        try{
            $listMessage = DB::table("messages")->where("user_id","=", Auth::user()->id)->where("target_id", "=",  $request->target_id)->
            orderBy('updated_at', 'asc')->get();
            
        
            for( $i=0 ; $i < count($listMessage); $i++){
                $target_user = User::where('id',$listMessage[$i]->target_id)->get();
                $listMessage[$i]->{'target_full_name'} = $target_user[0]->full_name;
                $listMessage[$i]->{'target_image'} = $target_user[0]->image;
            }
            return response()->json(["status" => "success", "error" => false, "message" => "Success! Get list message successfully!", "data"=>$listMessage], 201);
        }catch(Exception $exception){
            return response()->json(["status" => "failed", "error" => $exception->getMessage()], 404);
        }
    }

    public function fetchMessages(Request $req)
    {
        $sender_id = Auth::user()->id;
        $rec_id = $req->input('rec_id');
        $msg_list = DB::select('select * from messages where sender_id in ('.$sender_id.','.$rec_id.') and rec_id in ('.$sender_id.','.$rec_id.')');
        //$msg_list = Message::where('sender_id',$sender_id)->first();
        return json_encode($msg_list);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $m = new Message();
        $m->sender_id = $user->id;
        $m->rec_id = $request->input('rec_id');
        $m->message = $request->input('message');
        $m->save();
        
        // $message = $user->messages()->create([
        //   'rec_id' => $request->input('rec_id'),
        //   'message' => $request->input('message')
        // ]);

        broadcast(new MessageEvent($user->id,$request->input('rec_id'),$request->input('message')));

        return ['success'=>'msg sent'];
    }
}
