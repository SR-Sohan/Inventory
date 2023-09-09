<div class="container mt-4">
    <table id="tableData">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Name</th>
                <th>Mobile</th>
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
        
        let table = $("#tableData");
        let tableList = $("#tableList");

        showLoader();
        let res = await axios.get("/dashboard/customer-list")
        hideLoader();
        if(res.status === 200){
            table.DataTable().destroy();
            tableList.empty()

            res.data['data'].forEach((element ,index)=> {

                let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${element.name}</td>
                    <td>${element.mobile}</td>
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

    //Update Data
    $("#tableList").on("click",".editData",async function(){
        let id = $(this).data("id")
        showLoader();
        let res = await axios.get(`/dashboard/customer-by-id/${id}`)
        hideLoader();
        if( res.status === 200){
            $("#customer_id").val(res.data['id'])
            $("#name").val(res.data['name'])
            $("#mobile").val(res.data['mobile'])
            $("#submitBtn").html("Update Category")
            $('#contentModel').modal('show');
        }else{
            errorToast("Can't Update that moment")
        }
    })

    // Delete Data
   $("#tableList").on("click",".deleteData",async function(){
        let id = $(this).data("id")

        if(confirm("Are you want delete customer")){
            let res = await axios.post("/dashboard/customer-delete",{"customer_Id": id})
            if(res.status === 200 && res.data["status"] === "success"){
                await getData()
                successToast(res.data['message'])            
            }else{
                errorToast(res.data["message"])
            }
        }    
   });


</script>