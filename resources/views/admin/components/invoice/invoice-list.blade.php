<div class="container mt-4">
    <table id="tableData">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Vat</th>
                <th>Discount</th>
                <th>PayAble</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableList">

        </tbody>
    </table>
</div>

<script>

    //Get Data
    getData();
    async function getData(){
        showLoader();
        let res = await axios.get("/dashboard/invoice-select")
        hideLoader();

      if(res.status === 200){
        let tableData = $("#tableData");
        let tableList = $("#tableList");

        tableData.DataTable().destroy();
        tableList.empty();
        res.data.forEach((item,index) => {
            let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.customer.name}</td>
                    <td>${item.customer.mobile}</td>
                    <td>${item.total}</td>
                    <td>${item.vat}</td>
                    <td>${item.discount}</td>
                    <td>${item.payable}</td>
                    <td class="d-flex">
                        <p data-id="${item.id}" data-cid="${item.customer.id}"  class="text-success fs-5 invoiceDetails"><i class="fa-solid fa-eye"></i></p>
                        <p data-id="${item.id}" class="text-danger ms-2 fs-5 invoiceDelete"><i class="fa-solid fa-trash-can"></i></p>
                    </td>
                </tr>`;

            tableList.append(row)
        });
        new DataTable("#tableData")
      }else{
        errorToast("Something is wrong")
      }
    }

    // Delete Invoice
    $("#tableList").on("click",".invoiceDelete", async function(){
        let id = $(this).data("id")

        if(confirm("Are you want delte invoice?")){
            let res = await axios.post("/dashboard/invoice-delete",{"invoiceId": id})

            if(res.status === 200){
                await getData();
                successToast("Invoice Delete Successfully")
            }else{
                errorToast("Invoice Can't Delete")
            }
        }      
      
    })

    // Invoice Details
    $("#tableList").on("click",".invoiceDetails",async function(){
        let invoiceId = $(this).data("id");
        let customerId = $(this).data("cid")

        showLoader();
        let res = await axios.post("/dashboard/invoice-details",{"invoiceId": invoiceId,"customerId" : customerId})
        hideLoader();

        if(res.status === 200){
            $("#customerName").text(res.data["customer"].name)
            $("#customerMobile").text(res.data["customer"].mobile)
            $("#customerId").text(res.data["customer"].id)
          
            $("#total").text(res.data["invoice"].total)
            $("#payAble").text(res.data["invoice"].payable)
            $("#vat").text(res.data["invoice"].vat)
            $("#discount").text(res.data["invoice"].discount)

            // date formate 
            const createdAt = new Date(res.data["invoice"].created_at);
            const day = createdAt.getDate().toString().padStart(2, '0');
            const month = (createdAt.getMonth() + 1).toString().padStart(2, '0');
            const year = createdAt.getFullYear().toString().slice(-2);
            $("#invoiceDate").text(`${day}-${month}-${year}`);
            
    
            let invoiceList = $("#invoiceList")
            invoiceList.empty();

            res.data["products"].forEach(item => {
                let row = `<tr>
                        <td>${item["product"].name}</td>
                        <td>$${item["product"].price}</td>
                        <td>${item.qty}</td>
                        <td>$${item.sale_price}</td>
                    </tr>`

                    invoiceList.append(row)
            })



            // Show Modal
            $("#invoiceModal").modal("show")

        }else{
            errorToast("Something is wrong!")
        }
    })

   
</script>