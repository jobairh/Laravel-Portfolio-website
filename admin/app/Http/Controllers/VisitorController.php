<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use PhpParser\JsonDecoder;

class VisitorController extends Controller
{
    public function visitorIndex(){

        $visitorData=json_decode(VisitorModel::orderby('id','desc')->take(500)->get());

        return view('visitor',['visitorData'=>$visitorData]);
    }
}
