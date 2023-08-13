@extends('layouts.appLayout')
@section('appcontent')
    <div class="login_area">
        <div class="container">
            <div class="login_wrap w-50 mx-auto my-5 shadow-lg p-4 rounded">
                <form action="">
                    <h2 class="text-center my-4">Send OTP Form</h2>
                    <div class="mb-3">
                        <label for="email">Email </label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <button id="subBtn" class="btn btn-outline-primary w-100">Send OTP</button>
                   
                </form>
            </div>
        </div>
    </div>
@endsection