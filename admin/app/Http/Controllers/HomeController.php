<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModelTable;
use App\Models\CourseModelTable;
use App\Models\ProjectsModelTable;
use App\Models\ReviewModelTable;
use App\Models\ServicesModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    public function index(){

        $TotalContact = ContactModelTable::count();
        $TotalCourse = CourseModelTable::count();
        $TotalProject = ProjectsModelTable::count();
        $TotalReview = ReviewModelTable::count();
        $TotalService = ServicesModel::count();
        $TotalVisitor = VisitorModel::count();

        return view('home', [

            'TotalContact'=>$TotalContact,
            'TotalCourse'=>$TotalCourse,
            'TotalProject'=>$TotalProject,
            'TotalReview'=>$TotalReview,
            'TotalService'=>$TotalService,
            'TotalVisitor'=>$TotalVisitor

        ]);
    }
}
