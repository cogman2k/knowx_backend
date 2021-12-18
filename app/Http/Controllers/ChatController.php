<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function getUnseenMessages(){
        $messages = Message::where("receiver_id", Auth::user()->id)->where("is_seen", "0")->orderBy("created_at", "desc")->get();
        if(count($messages) > 0){
            for($i=0; $i <count($messages); $i++){
                $user = User::find($messages[$i]->user_id);
                $messages[$i]->{"user_image"} = $user->image;
                $messages[$i]->{"full_name"} = $user->full_name;
            }
        }
        return response()->json(["status" => "success", "error" => false, "data" => $messages, "count" => count($messages)], 200);
    }

    public function sendLinkMeeting(Request $request){
        // Message::create([
        //     "user_id" => Auth::user()->id,
        //     "receiver_id" => $request->receiver_id,
        //     "message" => $request->message
        // ]);
            $message = new Message;
            $message->user_id = Auth::user()->id;
            $message->receiver_id = $request->receiver_id;
            $message->message = $request->message;
            $message->save();

            return response()->json(["status" => "success", "error" => false, "message" => "Sent message!"], 200);
    }
}
