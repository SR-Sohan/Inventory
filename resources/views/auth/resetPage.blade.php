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
                    <button onclick="resetPassword()" type="button" id="subBtn" class="btn btn-outline-primary w-100">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <script> 
        async function  resetPassword() {

            let password = $("#password").val();
            let cpassword = $("#cpassword").val();

            if(password.length < 5){
                errorToast("Password must be 6 character")
            }else if(cpassword.length < 5){
                errorToast("Confirm Password must be 6 character")
            }else if(password !== cpassword){
                errorToast("Password and Confirm Password is not match !")
            }else{
                showLoader();
                let res = await axios.post("/reset-password",{"password":password})
                hideLoader()
                console.log(res);
                if(res.status === 200 && res.data["status"] === 'success'){
                    successToast(res.data["message"])
                    setTimeout(() => {
                        window.location.href = "/login"
                    }, 1000);
                }else{
                    errorToast(res.data["message"])
                }
            }

        }
    </script>
@endsection