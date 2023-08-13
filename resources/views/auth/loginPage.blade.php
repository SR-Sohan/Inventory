@extends('layouts.appLayout')
@section('appcontent')
    <div class="login_area">
        <div class="container">
            <div class="login_wrap w-50 mx-auto my-5 shadow-lg p-4 rounded">
                <form action="">
                    <h2 class="text-center my-4">Login Form</h2>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <p class="text-end"><a href="{{url("/forgot-password")}}">Forgot Password</a></p>
                    <button id="subBtn" class="btn btn-outline-primary w-100">Login</button>
                    <div class="mt-3 text-center">
                        <p>Don't do you have account?<a href="{{url("/register")}}">Create Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection