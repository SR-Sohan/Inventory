@extends('layouts.layout')
@section('admin_content')
<div class="report_page mt-4">
    <div class="row">

        <div class="col-lg-6">
            <div class="report_wrap  shadow-lg p-5 bg-white rounded">
                <form action="">
                    <h1>Sales Invoice Report</h1>
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

        <div class="col-lg-6">
            <div class="report_wrap  shadow-lg p-5 bg-white rounded">
                <form>
                    <h1>Monthly Sales Report</h1>
                    <div class="mb-3">
                        <label for="month">Select Month</label>
                        <select class="form-select" name="month" id="month">
                            <option value="-1">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button onclick="downloadMonthReport()" type="button" class="btn btn-outline-danger w-100">Download</button>
                    </div>
                </form>
            </div>
        </div>

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