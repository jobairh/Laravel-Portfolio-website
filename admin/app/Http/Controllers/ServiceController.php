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

    public function serviceDelete(){
        return "text";
    }
}
