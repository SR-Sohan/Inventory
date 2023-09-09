<div class="modal fade" id="contentModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Customer</h1>
          <button onclick="formReset()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form">
            <input class="d-none" type="number" name="customer_id" id="customer_id">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>            
            <div class="mb-3">
                <label for="mobile">Mobile</label>
                <input type="number" name="mobile" id="mobile" class="form-control">
            </div>            
          </form>
        </div>
        <div class="modal-footer">
          <button id="closeBtn" onclick="formReset()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="submitBtn" onclick="handleSubmit()" type="button" class="btn btn-primary">Add Customer</button>
        </div>
      </div>
    </div>
  </div>

  <script>

    // Reset Form
    function formReset(){
        $("#form")[0].reset();
        $("#submitBtn").html("Add Customer")
    }

    // Create Customer
    async function handleSubmit(){
      let customer_id = $("#customer_id").val();
      let name = $("#name").val();
      let mobile = $("#mobile").val();

      if(name === ""){
        errorToast("Customer Name is required")
      }else if(mobile === ""){
        errorToast("Please Enter correct mobile Number")
      }else {

        showLoader();
        let res = await axios.post("/dashboard/customer-create-update",{
          "customer_id" : customer_id,
          "name" : name,
          "mobile" : mobile
        })
        hideLoader();

        if(res.status === 200 && res.data["status"] === "success"){
          document.getElementById("closeBtn").click();         
          successToast(res.data['message'])
          await getData();
          formReset();
        }else{
          errorToast(res.data["message"])
        }

      }

    }

  </script>