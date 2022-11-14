<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CourseModelTable;

class CoursesController extends Controller
{
    public function coursesIndex(){
        return view('courses');
    }

    public function getCoursesData(){
        $result=json_encode(CourseModelTable::orderBy('id','desc')->get());
        return $result;
    }

    public function getCoursesDetails(Request $request){
        $id=$request->input('id');
        $result=json_encode(CourseModelTable::where('id','=',$id)->get());
        return $result;
    }

    public function getCoursesDelete(Request $request){
        $id=$request->input('id');
        $result=CourseModelTable::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getCoursesUpdate(Request $request){
        $id=$request->input('id');

        $course_name=$request->input('course_name');
        $course_description=$request->input('course_description');
        $course_fee=$request->input('course_fee');
        $course_total_enroll=$request->input('course_total_enroll');
        $course_total_class=$request->input('course_total_class');
        $course_link=$request->input('course_link');
        $course_image=$request->input('course_image');

        $result=CourseModelTable::where('id','=',$id)->update([
            'course_name'=>$course_name,
            'course_description'=>$course_description,
            'course_fee'=>$course_fee,
            'course_total_enroll'=>$course_total_enroll,
            'course_total_class'=>$course_total_class,
            'course_link'=>$course_link,
            'course_image'=>$course_image
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getCoursesAdd(Request $request){
        $course_name=$request->input('course_name');
        $course_description=$request->input('course_description');
        $course_fee=$request->input('course_fee');
        $course_total_enroll=$request->input('course_total_enroll');
        $course_total_class=$request->input('course_total_class');
        $course_link=$request->input('course_link');
        $course_image=$request->input('course_image');

        $result=CourseModelTable::insert([
            'course_name'=>$course_name,
            'course_description'=>$course_description,
            'course_fee'=>$course_fee,
            'course_total_enroll'=>$course_total_enroll,
            'course_total_class'=>$course_total_class,
            'course_link'=>$course_link,
            'course_image'=>$course_image,
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

}
