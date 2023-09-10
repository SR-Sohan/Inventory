<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function page(){
        return view("admin.pages.product");
    }

    public function productList(Request $request){
        $userID = $request->header("userID");
        $product = Product::with("category")->where("user_id","=",$userID)->orderBy('id', 'DESC')->get();

        if($product){
            return response()->json([
                "status" => "success",
                "message" => "Product Get Successful",
                "data" => $product
            ]);
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Product Can't Get at this momments",
            ]);
        }

    }

    public function productCreateUpdate(Request $request){
        $userID = $request->header("userID");
        $productID = $request->input("product_id");
        $filePath = $request->input('file_path');
        $category_id = $request->input("category_id");
        $name = $request->input("name");
        $price = $request->input("price");
        $quantity = $request->input("quantity");
        $unit = $request->input("unit");
        $image = $request->file("image");




        if($productID){

        }else{
       
            // Upload Image      
            $imageName = time()."_".$userID.'.'.$image->getClientOriginalExtension();            
            $image->storeAs('public/products', $imageName);

            $productCreate = Product::create([
                "user_id" => $userID,
                "category_id" => $category_id,
                "name" => $name,
                "price" => $price,
                "quantity" => $quantity,
                "unit" => $unit,
                "image" => $imageName
            ]);

            if($productCreate){
                return response()->json([
                    "status" => "success",
                    "message" => "Product Create Successful",
                ]);
            }else{
                return response()->json([
                    "status" => "failed",
                    "message" => "Product Create Failed",
                ]);
            }

            
        }


    }


    public function productDelete(Request $request){
        $userID = $request->header("userID");
        $id = $request->input("id");
        $path = $request->input("path");

        $productDelete = Product::where("user_id","=",$userID)->where("id","=",$id)->delete();

        if($productDelete){
            $imagePath = 'public/products/'.$path;        
            Storage::delete($imagePath);
            
            return response()->json([
                "status" => "success",
                "message" => "Product delete Successfully",
            ]);
            
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Product Can't delete",
            ]);
        }
    }

}
