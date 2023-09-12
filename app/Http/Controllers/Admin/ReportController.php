<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function reportPage(){
        return view("admin.pages.report");
    }

    public function reportCreate(Request $request){
        $userID = $request->header("userID");
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $total = Invoice::where("user_id","=",$userID)->whereDate("created_at",">=",$fromDate)->whereDate("created_at","<=",$toDate)->sum("total");

        $vat = Invoice::where("user_id","=",$userID)->whereDate("created_at",">=",$fromDate)->whereDate("created_at","<=",$toDate)->sum("vat");

        $discount = Invoice::where("user_id","=",$userID)->whereDate("created_at",">=",$fromDate)->whereDate("created_at","<=",$toDate)->sum("discount");

        $payable = Invoice::where("user_id","=",$userID)->whereDate("created_at",">=",$fromDate)->whereDate("created_at","<=",$toDate)->sum("payable");

        $list = Invoice::where("user_id","=",$userID)->whereDate("created_at",">=",$fromDate)->whereDate("created_at","<=",$toDate)->with("customer")->get();


        $data = array(
            "total" => $total,
            "vat" => $vat,
            "discount" => $discount,
            "payable" => $payable,
            "list" => $list,
            "fromDate" => $fromDate,
            "toDate" => $toDate
        );

        $pdf = Pdf::loadView("report.report",$data);

      return  $pdf->download("salesReport.pdf");


    }
}
