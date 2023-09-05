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
                    <button onclick="sendOTP()" type="button" id="subBtn" class="btn btn-outline-primary w-100">Send OTP</button>
                   
                </form>
            </div>
        </div>
    </div>
    <script>
        async function sendOTP(){
            let email = $("#email").val()

            if(email.length === 0){
                errorToast("Please enter email")
            }else{
                showLoader();
                let res = await axios.post("/send-otp",{
                    "email" : email
                })
                hideLoader();

                if(res.status === 200 && res.data['status'] === "success"){
                    successToast(res.data["message"])
                    sessionStorage.setItem('email', email);
                    setTimeout(() => {
                        window.location.href = "/otp"
                    }, 1000);
                }else{
                    errorToast(res.data["message"])
                }
            }
        }
    </script>
@endsection