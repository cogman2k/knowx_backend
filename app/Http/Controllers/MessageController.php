<?php

namespace App\Http\Controllers;

use App\Models\Messsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
{
  $this->middleware('auth');
}

/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
  return view('chat');
}

/**
 * Fetch all messages
 *
 * @return Message
 */
public function fetchMessages()
{
  return Messsage::with('user')->get();
}

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
{
  $user = Auth::user();
  var_dump($user->id);
  $message = DB::table('messsages')->where('user_id', '=', $user->id)->get();
  Messsage::create([
    'message' => $request->input('message')
  ]);
  broadcast(new MessageSent($user, $message))->toOthers();

  return response()->json(["status" => "success", "error" => false, "message" => "Message sent."], 201);
}
}
