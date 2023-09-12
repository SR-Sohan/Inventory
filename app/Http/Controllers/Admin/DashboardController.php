<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function page(){
        return view("admin.pages.dashboard");
    }

    public function summary(Request $request){

        $userID = $request->header("userID");
        $today = now()->startOfDay(); 

        $todayProduct = Product::where("user_id","=",$userID)->whereDate('created_at', $today)->count();
        $todayCustomer = Customer::where("user_id","=",$userID)->whereDate('created_at', $today)->count();
        $todayInvoice = Invoice::where("user_id","=",$userID)->whereDate('created_at', $today)->count();
        $todaySale = Invoice::where("user_id","=",$userID)->whereDate('created_at', $today)->sum("payable");

        $totalProduct = Product::where("user_id","=",$userID)->count();
        $totalCategory = Category::where("user_id","=",$userID)->count();
        $totalCustomer = Customer::where("user_id","=",$userID)->count();
        $totalInvoice = Invoice::where("user_id","=",$userID)->count();
        $totalSale = Invoice::where("user_id","=",$userID)->sum("total");
        $totalVat = Invoice::where("user_id","=",$userID)->sum("vat");
        $totalPayable = Invoice::where("user_id","=",$userID)->sum("payable");

        return array(
            "todaySale" => $todaySale,
            "todayProduct" => $todayProduct,
            "todayInvoice" => $todayInvoice,
            "todayCustomer" => $todayCustomer,
            "totalProduct" => $totalProduct,
            "totalCategory" => $totalCategory,
            "totalCustomer" => $totalCustomer,
            "totalInvoice" => $totalInvoice,
            "totalSale" => round($totalSale,2),
            "totalVat" => round($totalVat,2),
            "totalPayable" => round($totalPayable,2)
        );

    }
}
