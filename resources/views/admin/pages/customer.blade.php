@extends('layouts.layout')
@section('admin_content')
    <div class="page_heading d-flex align-items-center justify-content-between w-100 mt-2 bg-secondary p-3">
        <h1 class="text-white">Customer</h1>
        <p class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contentModel">
            <i class="fa-solid fa-plus"></i>
        </p>
    </div>

    @include('admin.components.customer.create-customer')
    @include('admin.components.customer.list-customer')

@endsection