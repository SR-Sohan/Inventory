<!-- Modal -->
<div class="modal fade " id="contentModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Product</h1>
          <button onclick="formReset()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form">
            <input class="d-none" type="number" name="product_id" id="product_id">
            <input class="d-none" type="text" name="file_path" id="file_path">
            <div class="mb-3">
              <label for="category">Category</label>
              <select class="form-select" name="category" id="category">
                <option value="-1">Select Category</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>            
            <div class="mb-3 d-flex align-items-center justify-content-between">
              <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control">
              </div>
                <div>
                  <label for="quantity">Quantity</label>
                  <input type="number" name="quantity" id="quantity" class="form-control">
              </div>
            </div>          
                       
            <div class="mb-3">
                <label for="unit">Unit</label>
                <input type="text" name="unit" id="unit" class="form-control">
            </div> 
            
            <div class="mb-3">
              <img class="w-25" src="{{asset('assets/img/default.jpg')}}" alt="" id="preview">
              <br>
              <br>
              <input oninput="preview.src=window.URL.createObjectURL(this.files[0])" type="file" name="image" id="image">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="closeBtn" onclick="formReset()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="submitBtn" onclick="handleSubmit()" type="button" class="btn btn-primary">Add Product</button>
        </div>
      </div>
    </div>
  </div>