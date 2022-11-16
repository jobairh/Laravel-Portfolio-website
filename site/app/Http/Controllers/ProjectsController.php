<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsModelTable;

class ProjectsController extends Controller
{
    public function projectsPage(){

        $projectsData=json_decode(ProjectsModelTable::orderby('id','desc')->get());
        return view('projects', ['projectsData'=>$projectsData]);
    }
}
