@extends('layouts.appLayout')
@section('appcontent')
    <div class="login_area">
        <div class="container">
            <div class="login_wrap w-50 mx-auto my-5 shadow-lg p-4 rounded">
                <form action="">
                    <h2 class="text-center my-4">Register Form</h2>
                    <div class="mb-3">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="number" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <button id="subBtn" class="btn btn-outline-primary w-100">Register</button>
                    <div class="mt-3 text-center">
                        <p>Do you have account?<a href="{{url("/login")}}">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection