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
                    <button onclick="onRegister()" type="button" id="subBtn" class="btn btn-outline-primary w-100">Register</button>
                    <div class="mt-3 text-center">
                        <p>Do you have account?<a href="{{url("/login")}}">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        async function  onRegister() {
            let first_name = $("#first_name").val()
            let last_name = $("#last_name").val()
            let email = $("#email").val()
            let phone = $("#phone").val()
            let password = $("#password").val()

            if(first_name.length === 0){
                errorToast("First Name is Required")
            }else if(last_name.length === 0){
                errorToast("Last Name is Required")
            }else if(email.length === 0){
                errorToast("Email is Required")
            }else if(phone.length === 0){
                errorToast("Phone is Required")
            }else if(password.length < 5){
                errorToast("Password must be  6 character")
            }else{
                showLoader();
                let res = await axios.post("/user-registration",{
                    "first_name" : first_name,
                    "last_name" : last_name,
                    "email" : email,
                    "mobile" : phone,
                    "password" : password
                })
                hideLoader();

                if(res.status === 200 && res.data["status"] === "success"){

                    successToast(res.data["message"]);

                    setTimeout(() => {
                        window.location.href = "/login"
                    }, 1000);

                }else{
                    errorToast(res.data['message']);
                }
            }
        }
    </script>
@endsection