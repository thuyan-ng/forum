<?php
namespace App\Http\Controllers;
use App\Model\Model;
use App\Channel;
use Illuminate\Http\Request;

class ChannelsCtrl extends Controller {
    
    public function index(){
        return \App\Channel::all();
    }

    public function create(Request $request){
        $channel = new Channel;
        $channel->name = $request->title;
        $channel->topic = $request->topic;
        $channel->save();

        return redirect('channels');
    }

}