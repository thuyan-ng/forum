<?php
namespace App\Http\Controllers;
use App\Model\Model;
use App\Message;
use App\Channel;
use App\Chatuser;
use Illuminate\Http\Request;

class MessagesCtrl extends Controller {
    
    public function show($channel){
        $chan_id = Channel::where("name", $channel)->first()->id;
        $messages = Message::where("chan_id", $chan_id)->get();

        foreach($messages as $msg){
            $author_id = $msg['author_id'];
            self::addAuthorName($msg, $author_id);
        }
        return $messages;
    }

    public function create(Request $request, $channel){
        if (session('key') == null){
            return redirect('connexion');
        }
        
        $msg = new Message;
        $msg->content = $request->content;
        $msg->author_id = Chatuser::where("login", session('key'))->first()->id;
        $msg->chan_id = Channel::where("name", $channel)->first()->id;

        $msg->save();

        $toReturn = Message::find($msg->id);
        self::addAuthorName($toReturn, $toReturn['author_id']);
        
        return $toReturn;
    }

    public function allMessages($channel){
        return view('messages', ['channel' => $channel]);
    }

    private function addAuthorName($msg, $author_id){
        $msg['author_name'] = Chatuser::find($author_id)->displayName;
    }

    public function destroy($channel, $msg_id){
        $msg = Message::find($msg_id);
        $author_login = Chatuser::find($msg->author_id)->login;
        
        if( session('key') == $author_login){
            $msg->delete();
        } else {
            return -1;
        }
    }
}