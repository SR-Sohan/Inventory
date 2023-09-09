<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function page(){
        return view("admin.pages.category");
    }

    public function categoryList(Request $request){

        $userID = $request->header("userID");
        $category = Category::where("user_id","=",$userID)->orderBy('id', 'DESC')->get();

        if($category){
            return response()->json([
                "status" => "success",
                "message" => "Category Get Successful",
                "data" => $category
            ]);
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Category Can't Get at this momments",
            ]);
        }

    }

    public function categoryByID($id){
       return  Category::where("id","=",$id)->first();
    }


    public function categoryCreateUpdate(Request $request){
        $userID = $request->header("userID");
        $categoryId = $request->input("category_id");
        $name = $request->input("name");

        if($categoryId){
            $categoryUpdate = Category::where("user_id","=",$userID)->where("id","=",$categoryId)->update(["name" => $name]);
            if($categoryUpdate){
                return response()->json([
                    "status" => "success",
                    "message" => "Category Update Successful",
                ]);
            }else{
                return response()->json([
                    "status" => "failed",
                    "message" => "Category Update Failed",
                ]);
            }
        }else{
            $categoryCreate = Category::create(["user_id" => $userID,"name" => $name]);

            if($categoryCreate){
                return response()->json([
                    "status" => "success",
                    "message" => "Category Create Successful",
                ]);
            }else{
                return response()->json([
                    "status" => "failed",
                    "message" => "Category Create Failed",
                ]);
            }
        }
    }

    public function categoryDelete(Request $request){

        $userID = $request->header("userID");
        $categoryId = $request->input("catId");
        $categoryDelete = Category::where("user_id","=",$userID)->where("id","=",$categoryId)->delete();

        if($categoryDelete){
            return response()->json([
                "status" => "success",
                "message" => "Category Delete Successful",
            ]);
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Category Delete Failed"
            ]);
        }
    }
}
