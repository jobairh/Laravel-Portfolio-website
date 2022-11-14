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
        $result=json_encode(ServicesModel::orderBy('id','desc')->get());
        return $result;
    }

    public function getServiceDetails(Request $request){

        $id=$request->input('id');
        $result=json_encode(ServicesModel::where('id','=',$id)->get());
        return $result;
    }

    public function getServiceDelete(Request $request){
        $id=$request->input('id');
        $result=ServicesModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getServiceUpdate(Request $request){
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');
        $img=$request->input('img');

        $result=ServicesModel::where('id','=',$id)->update(['service_name'=>$name, 'service_description'=>$desc,'service_image'=>$img]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getServiceAdd(Request $request){
        $name=$request->input('name');
        $desc=$request->input('desc');
        $img=$request->input('img');

        $result=ServicesModel::insert(['service_name'=>$name, 'service_description'=>$desc,'service_image'=>$img]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
