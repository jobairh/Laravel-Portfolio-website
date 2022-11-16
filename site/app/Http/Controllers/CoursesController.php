<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModelTable;

class CoursesController extends Controller
{
    public function coursePage(){

        $coursesData=json_decode(CourseModelTable::orderby('id','desc')->get());
        return view('course', ['coursesData'=>$coursesData]);
    }
}
