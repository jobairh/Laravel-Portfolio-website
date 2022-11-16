<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModelTable;

class ContactController extends Controller
{
    public function contactsIndex(){
        return view('contacts');
    }

    public function getContactsData(){
        $result=json_encode(ContactModelTable::orderBy('id','desc')->get());
        return $result;
    }

    public function getContactsDelete(Request $request){
        $id=$request->input('id');
        $result=ContactModelTable::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
