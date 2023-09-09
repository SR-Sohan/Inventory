<!-- Modal -->
<div class="modal fade" id="contentModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Category</h1>
          <button onclick="formReset()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form">
            <input type="hidden" name="cat_id" id="cat_id">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>            
          </form>
        </div>
        <div class="modal-footer">
          <button id="closeBtn" onclick="formReset()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="submitBtn" onclick="handleSubmit()" type="button" class="btn btn-primary">Add Category</button>
        </div>
      </div>
    </div>
  </div>

  <script>

    function formReset(){
        $("#form")[0].reset();
        $("#submitBtn").html("Add Category")
    }

    async function handleSubmit(){

        let name = $("#name").val()
        let category_id = $("#cat_id").val()

        if(name === ""){
          errorToast("Please enter Category Name")
        }else{
          showLoader();
          let res = await axios.post("/dashboard/category-create-update",{name: name,category_id: category_id})
          hideLoader();

          if(res.status === 200 && res.data['status'] === "success"){
            document.getElementById("closeBtn").click()
            formReset()
            successToast(res.data['message'])
            await getData();

          }else{
            document.getElementById("closeBtn").click()
            formReset()
            errorToast(res.data['message'])
          }
        }


     
    } 
    



  </script>