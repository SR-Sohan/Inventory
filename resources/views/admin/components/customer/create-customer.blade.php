<div class="modal fade" id="contentModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Customer</h1>
          <button onclick="formReset()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form">
            <input type="hidden" name="customer_id" id="customer_id">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>            
            <div class="mb-3">
                <label for="mobile">Mobile</label>
                <input type="number" name="Mobile" id="Mobile" class="form-control">
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