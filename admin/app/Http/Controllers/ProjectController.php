<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsModelTable;

class ProjectController extends Controller
{
    public function projectsIndex(){
        return view('projects');
    }

    public function getProjectsData(){
        $result=json_encode(ProjectsModelTable::orderBy('id','desc')->get());
        return $result;
    }


    public function getProjectsDetails(Request $request){
        $id=$request->input('id');
        $result=json_encode(ProjectsModelTable::where('id','=',$id)->get());
        return $result;
    }


    public function getProjectsDelete(Request $request){
        $id=$request->input('id');
        $result=ProjectsModelTable::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function getProjectsUpdate(Request $request){
        $id=$request->input('id');

        $project_name=$request->input('project_name');
        $project_description=$request->input('project_description');
        $project_link=$request->input('project_link');
        $project_image=$request->input('project_image');

        $result=ProjectsModelTable::where('id','=',$id)->update([
            'project_name'=>$project_name,
            'project_description'=>$project_description,
            'project_link'=>$project_link,
            'project_image'=>$project_image
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function getProjectsAdd(Request $request){
        $project_name=$request->input('project_name');
        $project_description=$request->input('project_description');
        $project_link=$request->input('project_link');
        $project_image=$request->input('project_image');

        $result=ProjectsModelTable::insert([
            'project_name'=>$project_name,
            'project_description'=>$project_description,
            'project_link'=>$project_link,
            'project_image'=>$project_image
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
