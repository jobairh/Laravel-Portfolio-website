<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServiceController extends Controller
{
    public function serviceIndex(){
        return view('services');
    }

    public function getServiceData(){
        $result=json_encode(ServicesModel::all());
        return $result;
    }

    public function serviceDelete(Request $request){
        $id=$request->input('id');
        $result=ServicesModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
