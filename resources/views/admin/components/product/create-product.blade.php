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

  <script>

    // Category List
    getCategory();
    async function getCategory() {
      
      let res = await axios.get("/dashboard/category-list")
      if(res.status === 200){
        res.data["data"].forEach(item => {
          let row = `<option value='${item.id}'>${item.name}</option>`

          $("#category").append(row)

        });
      }
    }

    // form reset
    function formReset(){
      $("#form")[0].reset();
      $("#submitBtn").html("Add Product")
      $("#preview").attr('src', '{{ asset('assets/img/default.jpg') }}');
    }

    // Submit Form
    async function handleSubmit(){
      let product_id = $("#product_id").val();
      let file_path = $("#file_path").val();
      let category = $("#category").val();
      let name = $("#name").val();
      let price = $("#price").val();
      let quantity = $("#quantity").val();
      let unit = $("#unit").val();
      let image = $('#image')[0].files[0]

      if(category === "-1"){
        errorToast("Category is required")
      }else if(name === ""){
        errorToast("Name is required")
      }else if(price === ""){
        errorToast("Price is required")
      }else if(quantity === ""){
        errorToast("Quantity is required")
      }else if(unit === ""){
        errorToast("Unit is required")
      }else if(!image){
        errorToast("Image is required")
      }else{

        let formData = new FormData();
        formData.append("product_id",product_id)
        formData.append("file_path",file_path)
        formData.append("category_id",category)
        formData.append("name",name)
        formData.append("price",price)
        formData.append("quantity",quantity)
        formData.append("unit",unit)
        formData.append("image",image)

        let config = {
                headers: {
                    "Content-Type": "multipart/form-data", 
                },
            }
          console.log(image);
        showLoader();
        let res = await axios.post("/dashboard/product-create-update",formData,config)
        hideLoader();

        if(res.status === 200 && res.data["status"] === "success"){
          document.getElementById("closeBtn").click();
          formReset();
          await getData();
          successToast(res.data["message"])
        }else{
          errorToast(res.data["message"])
        }

      }


    }

  </script>