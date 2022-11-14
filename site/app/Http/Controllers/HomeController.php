<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModelTable;
use App\Models\ProjectsModelTable;

class HomeController extends Controller
{
    public function index(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate=date("Y-m-d h-i-sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $servicesData=json_decode(ServicesModel::all());
        $coursesData=json_decode(CourseModelTable::orderby('id','desc')->limit(6)->get());
        $projectsData=json_decode(ProjectsModelTable::orderby('id','desc')->limit(6)->get());


        return view('home',[
            'servicesData'=>$servicesData,
            'coursesData'=>$coursesData,
            'projectsData'=>$projectsData
        ]);
    }
}
