<?php

namespace App\Http\Livewire;
use App\Models\Message;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Messages extends Component
{
	public $message;
	public $allmessages;
	public $sender;

    public function render()
    {
        
        $followingUsers = [];
        $list = DB::table('user_follows')->select('target_user_id')->where('user_id', auth()->id())->get();
        for($i=0;$i<count($list);$i++){
            $followingUsers[$i] = User::all()->find($list[$i]->target_user_id);
        }

        $followerUsers = [];
        $list = DB::table('user_follows')->select('user_id')->where('target_user_id', auth()->id())->get();
        for( $i = 0; $i < count($list); $i++){
            $followerUsers[$i] = User::all()->find($list[$i]->user_id);
        }

    	$sender = $this->sender;
    	$this->allmessages;
        return view('livewire.messages',compact('followingUsers','sender', 'followerUsers'));
    }

    public function mountdata()
    {
        if(isset($this->sender->id))
        {
              $this->allmessages = Message::where('user_id',auth()->id())->where('receiver_id',$this->sender->id)->orWhere('user_id',$this->sender->id)->where('receiver_id',auth()->id())->orderBy('id','desc')->get();

               $not_seen = Message::where('user_id',$this->sender->id)->where('receiver_id',auth()->id());
               $not_seen->update(['is_seen'=> true]);
        }

    }
    
    public function resetForm()
    {
    	$this->message='';
    }

    public function SendMessage()
    {
    	$data = new Message;
    	$data->message = $this->message;
    	$data->user_id = auth()->id();
    	$data->receiver_id = $this->sender->id;
    	$data->save();

    	$this->resetForm();


    }

    public function getUser($userId)
    {
       $user=User::find($userId);
       $this->sender=$user;
       $this->allmessages=Message::where('user_id',auth()->id())->where('receiver_id',$userId)->orWhere('user_id',$userId)->where('receiver_id',auth()->id())->orderBy('id','desc')->get();
    }

}
