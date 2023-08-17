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
            <div class="mb-3">
                <img class="w-25" id="preview" src="{{asset("assets/img/default.jpg")}}" alt="">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input oninput="preview.src = window.URL.createObjectURL(this.files[0])" type="file" name="image" id="image" class="form-control">
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button onclick="formReset()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add Category</button>
        </div>
      </div>
    </div>
  </div>

  <script>

    function formReset(){
        $("#form")[0].reset();
        $("#preview").attr("src","{{asset("assets/img/default.jpg")}}")
    }

  </script>