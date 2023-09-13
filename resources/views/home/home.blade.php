@extends('layouts.appLayout')
@section('appcontent')
  <div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="w-100 shadow-lg border border-success p-5 rounded">
                <h1 class="text-center text-success mb-3">Inventory POS</h1>
               <div class="d-flex align-items-center justify-content-between my-4">
                <h3>Project Details : </h3>
                <div>
                    <a class="btn btn-success" href="{{url("/login")}}">Sign In</a>
                </div>
               </div>
                <ul style="list-style: none">
                    <li class="bg-danger p-3 shadow-lg text-white fs-5 my-3 rounded">In this project, users can sign up and sign in. If users forget their password, users can reset their password easily. Users have a profile page so their profile can be updated or seen.</li>
                    <li class="bg-secondary p-3 shadow-lg text-white fs-5 my-3 rounded">Users after logging into this project see a dashboard. Users can manage their businesses very easily using this dashboard.</li>
                    <li class="bg-primary p-3 shadow-lg text-white fs-5 my-3 rounded">Users can manage customers, products, and sales very easily using this project.  Users can generate sales reports in this project.</li>
                </ul>
            </div>
        </div>
    </div>
  </div>
@endsection