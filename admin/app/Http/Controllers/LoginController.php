<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModelTable;

class LoginController extends Controller
{
    public function loginIndex(){
        return view('login');
    }

    public function onLogout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }

    public function onLogin(Request $request){
        $user =$request->input('user');
        $pass =$request->input('pass');
        $countValue=AdminModelTable::where('user_name','=',$user)->where('password','=',$pass)->count();

        if ($countValue==1){
            $request->session()->put('user',$user);
            return 1;
        }
        else{
            return 0;
        }
    }
}
