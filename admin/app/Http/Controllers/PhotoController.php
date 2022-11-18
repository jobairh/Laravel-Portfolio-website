<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModelTable;

class PhotoController extends Controller
{
    public function photoIndex(){
        return view('photo');
    }

    public function photoJson(){
        return PhotoModelTable::all();
    }

    public function photoUpload(Request $request){

        $photoPath=$request->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];

        $host = $_SERVER['HTTP_HOST'];
        $location = "http://".$host."/storage/".$photoName;

        $result = PhotoModelTable::insert(['location'=>$location]);
        return $result;
    }
}
