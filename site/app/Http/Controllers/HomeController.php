<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModelTable;
use App\Models\ProjectsModelTable;
use App\Models\ContactModelTable;
use App\Models\ReviewModelTable;

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
        $reviewsData=json_decode(ReviewModelTable::all());


        return view('home',[
            'servicesData'=>$servicesData,
            'coursesData'=>$coursesData,
            'projectsData'=>$projectsData,
            'reviewsData'=>$reviewsData
        ]);
    }

    public function contactSend(Request $request){

        $contact_name = $request->input('contact_name');
        $contact_mobile = $request->input('contact_mobile');
        $contact_email = $request->input('contact_email');
        $contact_msg = $request->input('contact_msg');

        $result = ContactModelTable::insert([
            'contact_name'=>$contact_name,
            'contact_mobile'=>$contact_mobile,
            'contact_email'=>$contact_email,
            'contact_msg'=>$contact_msg
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

}
