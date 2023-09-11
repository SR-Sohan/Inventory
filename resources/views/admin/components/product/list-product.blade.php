<div class="container mt-4">
    <table id="tableData">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableList">

        </tbody>
    </table>
</div>

<script>
    // Get Data
    getData();
    async function getData(){

        let tableData = $("#tableData")
        let tableList = $("#tableList")

        showLoader()
        let res = await axios.get("/dashboard/product-list")
        hideLoader();
    
        if(res.status === 200 && res.data['status'] === "success"){

            tableData.DataTable().destroy();
            tableList.empty()


            res.data["data"].forEach(item => {
                let row = `<tr>
                        <td><img class="w-50" src="{{asset('storage/products/${item.image}')}}"/></td>
                        <td>${item.name}</td>
                        <td>${item.category.name}</td>
                        <td>${item.price}</td>
                        <td>${item.quantity}</td>
                        <td>${item.unit}</td>
                        <td>
                            <button data-id="${item.id}" data-path="${item.image}"  class="btn btn-sm btn-outline-success editBtn">Edit</button>
                            <button data-id="${item.id}" data-path="${item.image}" class="btn btn-sm btn-outline-danger deleteBtn">Delete</button>
                        </td>
                    </tr>`
                    tableList.append(row)
            })

        // Initial Data Table
        new DataTable('#tableData',{
            responsive: true,

        })

        }else{
            errorToast("Data Not Found")
        }
    }

    // Edit Item
    $("#tableList").on("click",".editBtn",async function(){
        let id = $(this).data("id")
        let path = $(this).data("path")

        showLoader();
        let res = await axios.get(`/dashboard/product-by-id/${id}`)
        hideLoader();
        if(res.status === 200){
            $("#product_id").val(res.data["id"])
            $("#file_path").val(res.data["image"])
            $("#category").val(res.data["category_id"])
            $("#name").val(res.data["name"])
            $("#price").val(res.data["price"])
            $("#quantity").val(res.data["quantity"])
            $("#unit").val(res.data["unit"])
            $("#preview").attr("src", '{{ asset("storage/products") }}' + '/' + res.data['image']);
            
            $("#submitBtn").html("Update Product")

            $("#contentModel").modal("show")
        }else{
            errorToast("Something is wrong")
        }
    })

    // Delete item
    $("#tableList").on("click",".deleteBtn",async function(){
        let id = $(this).data("id")
        let path = $(this).data("path")
        let tr = $(this).parent().parent();
      
        if(confirm("Are you want to Delete?")){
          
            let res = await axios.post("/dashboard/product-delete",{id: id,path: path})

            if(res.status === 200 && res.data['status'] === "success"){
                // tr.remove().draw();;
                await getData();
                successToast(res.data["message"])
            }else{
                errorToast(res.data["message"])
            }
        }
    })

   
</script>