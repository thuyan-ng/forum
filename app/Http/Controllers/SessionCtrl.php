<?php
namespace App\Http\Controllers;
use App\Model\Model;
use Illuminate\Http\Request;

class SessionCtrl extends Controller {

    public function login(Request $request) {

        if(\App\Chatuser::where("login", $request->login)->first() === null){
            return view('error', ['errmsg' => "Login inexistant"]);
        }

        session(['key' => $request->login]);

        return redirect('channels');
    }

    public function logout(Request $request){
        $request->session()->forget('key');

        return redirect('channels');
    }
}