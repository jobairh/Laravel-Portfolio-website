<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModelTable;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function photoIndex(){
        return view('photo');
    }

    public function photoDelete(Request $request){

        $oldPhotoUrl = $request->input('oldPhotoUrl');
        $oldPhotoId = $request->input('id');

        $oldPhotoUrlArray = explode('/', $oldPhotoUrl);
        $oldPhotoName = end($oldPhotoUrlArray);
        $deletePhotoFile = Storage::delete('public/'.$oldPhotoName);

        $deleteRow = PhotoModelTable::where('id', '=', $oldPhotoId)->delete();
        return $deleteRow;
    }

    public function photoJson(Request $request){
        return PhotoModelTable::take(100)->get();
    }

    public function photoJsonById(Request $request){

        $firstId = $request->id;
        $lastId = $firstId+3;
        return PhotoModelTable::where('id','>=',$firstId)->where('id','<',$lastId)->get();
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
