<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModelTable;

class ReviewController extends Controller
{
    public function reviewsIndex(){
        return view('reviews');
    }

    public function getReviewsData(){
        $result=json_encode(ReviewModelTable::orderBy('id','desc')->get());
        return $result;
    }


    public function getReviewsDetails(Request $request){
        $id=$request->input('id');
        $result=json_encode(ReviewModelTable::where('id','=',$id)->get());
        return $result;
    }


    public function getReviewsDelete(Request $request){
        $id=$request->input('id');
        $result=ReviewModelTable::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function getReviewsUpdate(Request $request){
        $id=$request->input('id');

        $review_name=$request->input('name');
        $review_description=$request->input('description');
        $review_image=$request->input('image');

        $result=ReviewModelTable::where('id','=',$id)->update([
            'name'=>$review_name,
            'description'=>$review_description,
            'image'=>$review_image
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function getReviewsAdd(Request $request){
        $review_name=$request->input('name');
        $review_description=$request->input('description');
        $review_image=$request->input('image');

        $result=ReviewModelTable::insert([
            'name'=>$review_name,
            'description'=>$review_description,
            'image'=>$review_image
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
