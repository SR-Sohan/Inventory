@extends('layouts.layout')
@section('admin_content')
    <div class="row g-3 mt-3">
        <h2>Today Summary</h2>
        <div class="col-lg-3">
            <div class="bg-secondary text-center text-white p-4">
                <h4>Today Sales</h4>
                <h2>$<span id="todaySale">0</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-danger text-center text-white p-4">
                <h4>Today Invoice</h4>
                <h2><span id="todayInvoice">0</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-info text-center text-white p-4">
                <h4>New Products</h4>
                <h2><span id="todayProduct">0</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-warning text-center text-white p-4">
                <h4>New Customer</h4>
                <h2><span id="todayCustomer">0</span></h2>
            </div>
        </div>
    </div>

    <div  class="row g-3 mt-5 border-top  border-danger">
        <h2>Total Summary</h2>
        <div class="col-lg-3">
            <div class="bg-dark text-center text-white p-4">
                <h4>Total Products</h4>
                <h2><span id="totalProduct">423</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-warning text-center text-white p-4">
                <h4>Total Category</h4>
                <h2><span id="totalCategory">423</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-primary text-center text-white p-4">
                <h4>Total Customer</h4>
                <h2><span id="totalCustomer">423</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-info text-center text-white p-4">
                <h4>Total Invoice</h4>
                <h2><span id="totalInvoice">423</span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-success text-center text-white p-4">
                <h4>Total Sales</h4>
                <h2>$<span id="totalSale"></span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-secondary text-center text-white p-4">
                <h4>Total Vat</h4>
                <h2>$<span id="totalVat"></span></h2>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-danger text-center text-white p-4">
                <h4>Total Collection</h4>
                <h2>$<span id="totalPayable"></span></h2>
            </div>
        </div>
    </div>


    <script>
        getSummary()
        async function  getSummary() {
            showLoader();
            let res = await axios.get("/dashboard/summary")
            hideLoader();
            console.log(res.data);
            if(res.status === 200){                

                $("#todaySale").text(res.data['todaySale'])
                $("#todayInvoice").text(res.data['todayInvoice'])
                $("#todayProduct").text(res.data['todayProduct'])
                $("#todayCustomer").text(res.data['todayCustomer'])
                $("#totalProduct").text(res.data['totalProduct'])
                $("#totalProduct").text(res.data['totalProduct'])
                $("#totalCategory").text(res.data['totalCategory'])
                $("#totalCustomer").text(res.data['totalCustomer'])
                $("#totalInvoice").text(res.data['totalInvoice'])
                $("#totalSale").text(res.data['totalSale'])
                $("#totalVat").text(res.data['totalVat'])
                $("#totalPayable").text(res.data['totalPayable'])
            }else{
                errorToast("Something is worning")
            }
        }
    </script>
@endsection