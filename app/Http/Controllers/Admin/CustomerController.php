<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function page(){
        return view("admin.pages.customer");
    }

    public function customerList(Request $request){
        $userID = $request->header("userID");
        $customers = Customer::where("user_id","=",$userID)->orderBy("id","desc")->get();

        if($customers){
            return response()->json([
                "status" => "success",
                "message" => "Category Get Successful",
                "data" => $customers
            ]);
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Customers Can't Get at this momments",
            ]);
        }
    }

    public function customerByID(Request $request,$id){
        $userID = $request->header("userID");
        return  Customer::where("user_id","=",$userID)->where("id","=",$id)->first();
    }

    public function customerCreateUpdate(Request $request){
        $userID = $request->header("userID");
        $customerId = $request->input("customer_id");
        $name = $request->input("name");
        $mobile = $request->input("mobile");

        if($customerId){

            $customerUpdate = Customer::where("user_id","=",$userID)->where("id","=",$customerId)->update([
                "name" => $name,
                "mobile" => $mobile
            ]);

            if($customerUpdate){
                return response()->json([
                    "status" => "success",
                    "message" => "Customer Update Successful",
                ]);
            }else{
                return response()->json([
                    "status" => "failed",
                    "message" => "Customer Update Failed",
                ]);
            }

        }else{
            $customerCreate = Customer::create([
                "user_id" => $userID,
                "name" => $name,
                "mobile" => $mobile
            ]);
            if($customerCreate){
                return response()->json([
                    "status" => "success",
                    "message" => "Customer Create Successful",
                ]);
            }else{
                return response()->json([
                    "status" => "failed",
                    "message" => "Customer Create Failed",
                ]);
            }
        }
    }


    public function customerDelete(Request $request){
        $userID = $request->header("userID");
        $customerId = $request->input("customer_Id");
        $customerDelete = Customer::where("user_id","=",$userID)->where("id","=",$customerId)->delete();
        if($customerDelete){
            return response()->json([
                "status" => "success",
                "message" => "Customer Delete Successful",
            ]);
        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Customer Delete Failed"
            ]);
        }
    }

}
