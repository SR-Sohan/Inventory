<div class="container">
    <form class="shadow-lg p-4 mt-5">
        <h1>Your Profile</h1>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="first_name">First Name</label>
                <input class="form-control" type="text" name="first_name" id="first_name">
            </div>
            <div class="col-md-4">
                <label for="last_name">Last Name</label>
                <input class="form-control" type="text" name="last_name" id="last_name">
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
                <input readonly class="form-control" type="email" name="email" id="email">
            </div>
            <div class="col-md-4 mt-3">
                <label for="mobile">Mobile</label>
                <input class="form-control" type="number" name="mobile" id="mobile">
            </div>
            <div class="col-md-4 mt-3">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="col-md-6 mt-3">             
               <button onclick="updateProfile()" class="btn btn-primary mt-4" type="button">Update Profile</button>
            </div>
        </div>
    </form>
</div>

<script>

    getUser();
    async function getUser() {        
        showLoader();
        let res = await axios.get("/user-profile")
        hideLoader();
        if(res.status === 200 && res.data["status"] === 'success'){
            $("#first_name").val(res.data['data'].first_name)
            $("#last_name").val(res.data['data'].last_name)
            $("#email").val(res.data['data'].email)
            $("#mobile").val(res.data['data'].mobile)
            $("#password").val(res.data['data'].password)
        }else{
            errorToast(res.data['message'])
        }
    }

    async function updateProfile(){

        showLoader();
        let first_name = $("#first_name").val();
        let last_name = $("#last_name").val();
        let mobile = $("#mobile").val();
        let password = $("#password").val();
        let res = await axios.post("/update-profile",{
            "first_name": first_name,
            "last_name": last_name,
            "mobile" : mobile,
            "password" : password
        })
        hideLoader();

        if(res.status === 200 && res.data["status"] === "success"){
            successToast(res.data["message"]);
            await getUser();
        }else{
            errorToast(res.data["message"])
        }

    }
</script>