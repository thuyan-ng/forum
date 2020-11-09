<?php
namespace App\Http\Controllers;
use App\Model\Model;
use App\Chatuser;
use Illuminate\Http\Request;
use Session;

class ChatusersCtrl extends Controller {

    public function index(){
        return \App\Chatuser::all();
    }
    
    public function create(Request $request){

        $login = $request->newLogin;
        $name = $request->name;

        if($login === null || $name === null){
            return view('error', ['errmsg' => "Vous devez remplir tous les champs"]);

        } else if(Chatuser::where("login", $login)->exists()){
            return view('error', ['errmsg' => "Ce login existe déjà"]);
        }

        $user = new Chatuser;
        $user->login = $login;
        $user->displayName = $name;
        $user->save();

        session(['key' => $login]); 

        return redirect('channels');
    }

}