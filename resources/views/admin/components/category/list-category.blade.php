<div class="container mt-4">
    <table id="tableData">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableList">

        </tbody>
    </table>
</div>

<script>

    // Data Get
    getData();
    async function getData(){

        let table = $("#tableData");
        let tableList = $("#tableList");

        showLoader();
        let res = await axios.get("/dashboard/category-list");
        hideLoader();
        if(res.status === 200 && res.data['status'] === 'success'){

            table.DataTable().destroy();
            tableList.empty()

            res.data['data'].forEach((element ,index)=> {

                let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${element.name}</td>
                        <td>
                            <button data-id="${element.id}" class="btn btn-sm btn-outline-success editData">Edit</button>
                            <button data-id="${element.id}" class="btn btn-sm btn-outline-danger deleteData">Delete</button>
                        </td>
                    </tr>`;

                    tableList.append(row)
                
            });

        }else{
            errorToast(res.data['message'])
        }

        new DataTable('#tableData', {
            responsive: true,

        });
    }


    //Edit Data 
    $("#tableList").on("click",".editData",async function(){
        let id = $(this).data("id")
        
        showLoader();
        let res = await axios.get(`/dashboard/category-by-id/${id}`)
        hideLoader();
        if( res.status === 200){
            $("#cat_id").val(res.data['id'])
            $("#name").val(res.data['name'])
            $("#submitBtn").html("Update Category")
            $('#contentModel').modal('show');
        }
        
    })

    // Delete Data
    $("#tableList").on("click",".deleteData", async function(){

        let id = $(this).data('id')

        if(confirm("Are you want Delete")){
            
            let res = await axios.post("/dashboard/category-delete",{catId: id})

            if(res.status === 200 && res.data["status"] === "success"){
                successToast(res.data["message"])
                await getData();
            }else{
                errorToast(res.data["message"])
            }
        }

    })

</script>