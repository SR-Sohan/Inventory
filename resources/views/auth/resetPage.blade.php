@extends('layouts.appLayout')
@section('appcontent')
    <div class="login_area">
        <div class="container">
            <div class="login_wrap w-50 mx-auto my-5 shadow-lg p-4 rounded">
                <form action="">
                    <h2 class="text-center my-4">Reset Password</h2>
                    <div class="mb-3">
                        <label for="password">New Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword">Confirm Password</label>
                        <input class="form-control" type="password" name="cpassword" id="cpassword">
                    </div>
                    <button id="subBtn" class="btn btn-outline-primary w-100">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection