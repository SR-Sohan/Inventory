@extends('layouts.layout')
@section('admin_content')
<div class="report_page">
    <div class="report_wrap w-50 mx-auto mt-5 shadow-lg p-5 bg-white rounded">
        <form action="">
            <h1>Sales Report</h1>
            <div class="mb-3">
                <label for="fromDate">Date From</label>
                <input class="form-control" type="date" name="fromDate" id="fromDate">
            </div>
            <div class="mb-3">
                <label for="toDate">Date To</label>
                <input class="form-control" type="date" name="toDate" id="toDate">
            </div>
            <div class="mb-3">
                <button onclick="downloadReport()" type="button" class="btn btn-outline-danger w-100">Download</button>
            </div>
        </form>
    </div>
</div>

<script>

async function downloadReport() {

    let fromDate = $("#fromDate").val()
    let toDate = $("#toDate").val()

    if(!fromDate || !toDate){
        errorToast("Date is required")
    }else{
        window.open("sales-report/" + fromDate + "/" + toDate)
    }
}
</script>
@endsection