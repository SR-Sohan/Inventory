@extends('layouts.appLayout')
@section('appcontent')
    <div class="login_area">
        <div class="container">
            <div class="login_wrap w-50 mx-auto my-5 shadow-lg p-4 rounded">
                <form action="">
                    <h2 class="text-center my-4">Matching OTP Form</h2>
                    <div class="mb-3">
                        <label for="otp">OTP</label>
                        <input class="form-control" type="number" name="otp" id="otp">
                    </div>
                    <button onclick="matchOTP()" type="button" id="subBtn" class="btn btn-outline-primary w-100">Submit</button>
                   
                </form>
            </div>
        </div>
    </div>

    <script>

        async function matchOTP(){
            let email = sessionStorage.getItem('email');
            let otp = $("#otp").val()
            if(otp.length !== 4){
                errorToast("Please Enter correct OTP")
            }else{
                showLoader()
                let res = await axios.post("/verify-otp",{
                    "email" : email,
                    "otp" : otp
                })
                hideLoader()

                if(res.status === 200 && res.data["status"] === "success"){
                    successToast(res.data['message'])
                    sessionStorage.clear();
                    setTimeout(() => {
                        window.location.href = "/reset-password"
                    }, 1000);
                }else{
                    errorToast(res.data["message"])
                }
            }
        }

    </script>
@endsection