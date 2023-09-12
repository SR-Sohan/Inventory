<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function salePage(){
        return view("admin.pages.sale");
    }

    public function invoicePage(){
        return view("admin.pages.invoice");
    }
    

    public function invoiceCreate(Request $request){
        DB::beginTransaction();

        try {
            $userID = $request->header("userID");
            $customer_id = $request->input("customer_id");
            $total = $request->input("total");
            $discount = $request->input("discount");
            $vat = $request->input("vat");
            $payable = $request->input("payable");


            $invoice = Invoice::create([
                "total" => $total,
                "discount" => $discount,
                "vat" => $vat,
                "payable" => $payable,
                "user_id" => $userID,
                "customer_id" => $customer_id
            ]);


            $invoiceId = $invoice->id;

            $products = $request->input("products");

            foreach ($products as $product) {
                Invoice_product::create([
                    "invoice_id" => $invoiceId,
                    "user_id" => $userID,
                    "product_id" => $product["id"],
                    "qty" => $product["qty"],
                    "sale_price" => $product["sale_price"],    
                ]);
            }

            DB::commit();

            return 1;        


        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
        }
    }


    public function invoiceSelect(Request $request){
        $userID = $request->header("userID");

        return Invoice::where("user_id","=",$userID)->with("customer")->get();
    }

    public function invoiceDetails(Request $request){

        $userID = $request->header("userID");
        $invoiceId = $request->input("invoiceId");
        $customerId = $request->input("customerId");


        $customerDetails = Customer::where("id","=",$customerId)->where("user_id","=",$userID)->first();
        $invoiceTotal = Invoice::where("id","=",$invoiceId)->where("user_id","=",$userID)->first();
        $invoiceProducts = Invoice_product::where("id","=",$invoiceId)->where("user_id","=",$userID)->get();


        return array(
            "customer" => $customerDetails,
            "invoice" => $invoiceTotal,
            "products" => $invoiceProducts
        );

    }


    public function invoiceDelete(Request $request){
      
        DB::beginTransaction();

        try {
            $userID = $request->header("userID");
            $invoiceId = $request->input("invoiceId");

            Invoice_product::where("invoice_id","=",$invoiceId)->where("user_id","=",$userID)->delete();

            Invoice::where("id","=",$invoiceId)->where("user_id","=",$userID)->delete();

            DB::commit();
            return 1;
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
        }


    }


}
