@extends('layouts.layout')
@section('admin_content')
    <div class="page_heading d-flex align-items-center justify-content-between w-100 mt-2 bg-secondary p-3">
        <h1 class="text-white">INVOICE</h1>
        <h4 class="btn btn-primary">
           <a class="text-white" href="{{url("/dashboard/sales")}}">Create Sale</a>
        </h4>
    </div>

    @include('admin.components.invoice.invoice-list')
    @include('admin.components.invoice.invoice-modal')

@endsection