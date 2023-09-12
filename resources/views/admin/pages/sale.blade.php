@extends('layouts.layout')
@section('admin_content')
  

    <div class="row mt-3 mb-5">
        <div class="col-lg-4">
            <div id="invoice" class="single_item shadow-lg rounded p-2">

                <div class="invoice_header d-flex  justify-content-between">
                    <div class="user_info">
                        <h4>BILLED TO</h4>
                        <p>Name: <span id="customerName"></span></p>
                        <p>Mobile: <span id="customerMobile"></span></p>
                        <p>User ID: <span id="customerId"></span></p>
                    </div>
                    <div class="company_info">                        
                        <img  src="{{asset("assets/img/logo.png")}}" alt=""/>
                       <h5>Invoice</h5>
                        <p>Date: <span id="invoiceDate"></span></p>
                    </div>
                </div>

                <div class="invoice_body">
                    <table id="invoiceTable" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceList">
                           
                        </tbody>
                    </table>
                </div>

                <div class="invoice_footer">
                    <div class="invoice_bill">
                        <p><strong>Total: $</strong><span id="total"></span></p>
                        <p><strong>Payable: $</strong><span id="payAble"></span></p>
                        <p><strong>Vat(5%): $</strong><span id="vat"></span></p>
                        <p><strong>Discount: $</strong><span id="discount"></span></p>
                        <div>
                            <label for="discountP">Discount(%)</label>
                            <input onchange="discountChange()" class="form-control" type="number" name="discountP" id="discountP">
                        </div>
                        <button onclick="saveInvoice()" class="btn btn-sm btn-outline-success mt-2"> <i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div id="product" class="single_item shadow-lg rounded p-2">
               <table id="productTable">
                <thead>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>
                <tbody id="productBody">

                </tbody>
               </table>
            </div>
        </div>
        <div  class="col-lg-4">
            <div id="customer" class="single_item shadow-lg rounded p-2">
                 <table id="customerTable">
                <thead>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </thead>
                <tbody id="customerBody">
                    
                </tbody>
               </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contentModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="form">
                <input type="hidden" name="pId" id="pId">
                <div class="mb-3">
                    <label for="pName">Name</label>
                    <input readonly type="text" name="pName" id="pName" class="form-control">
                </div>            
                <div class="mb-3">
                    <label for="pPrice">Price</label>
                    <input readonly type="text" name="pPrice" id="pPrice" class="form-control">
                </div>            
                <div class="mb-3">
                    <label for="pQty">Qunatity</label>
                    <input type="number" name="pQty" id="pQty" class="form-control">
                </div>            
              </form>
            </div>
            <div class="modal-footer">
              <button id="closeBtn"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button id="submitBtn" onclick="addProduct()" type="button" class="btn btn-primary">Add </button>
            </div>
          </div>
        </div>
      </div>

    <script>

        let customerInfo = {};
        let products = [];
             
        // Invoke another method
        (async function() {
            showLoader();
            await getProducts();
            await getCustomers();
            $("#invoiceDate").text(getCurrentDateDMY())
            hideLoader();
        })();

        function getCurrentDateDMY() {
            const currentDate = new Date();

            const day = currentDate.getDate(); // Get the day (1-31)
            const month = currentDate.getMonth() + 1; // Get the month (0-11) and add 1 to it
            const year = currentDate.getFullYear(); // Get the full year (e.g., 2023)

            // Ensure that day and month have leading zeros if needed (e.g., "01" instead of "1")
            const formattedDay = (day < 10 ? '0' : '') + day;
            const formattedMonth = (month < 10 ? '0' : '') + month;

            // Create the d-m-y string
            const dmyString = `${formattedDay}-${formattedMonth}-${year}`;

            return dmyString;
        }

        

        // Calculate Total
        function totalCalculate(){
            let total = 0;
            let payable = 0;
            let vat = 0;
            let discount = 0;

            let discountParcent = parseFloat($("#discountP").val())

            products.forEach((item,index) =>{
              
                total = total + parseFloat(item["sale_price"])
            })

            if(!discountParcent){
                vat = ((total * 5)/100).toFixed(2)
            }else{
                discount = ((total * discountParcent)/100).toFixed(2)
                total = (total - (total * discountParcent)/100).toFixed(2)
                vat = ((total * 5)/100).toFixed(2)
            }

            payable = (parseFloat(total) + parseFloat(vat)).toFixed(2)

            $("#total").text(total)
            $("#payAble").text(payable)
            $("#vat").text(vat)
            $("#discount").text(discount)

        }

        // DiscountChange
        function discountChange(){
            totalCalculate()
        }

        // Show invoice product
        function showProduct(){
           let invoiceList = $("#invoiceList");

           invoiceList.empty();

           products.forEach((item,index) => {
               let row =` <tr>
                                <td>${item.name}</td>
                                <td>${item.qty}</td>
                                <td>${item.sale_price}</td>
                                <td><button data-index='${index}' class="shadow-lg btn btn-sm btn-secondary removeProduct">Remove</button></td>
                            </tr>`
                            invoiceList.append(row)
           });

           totalCalculate();
        }


        function addProduct(){
          let pid =  $("#pId").val()
          let pname =   $("#pName").val()
          let pprice =   $("#pPrice").val()
          let pqty =   $("#pQty").val()
          let ptotal = (parseFloat(pprice) * parseFloat(pqty)).toFixed(2)

          if(!pqty){
            errorToast("Quantity is required")
          }else{
            let item = {
                id: pid,
                name: pname,
                qty: pqty,
                sale_price: ptotal
            }
            products.push(item)
            document.getElementById("closeBtn").click();
            $("#form")[0].reset();
            showProduct();
          }
        }

        // Get Products
        async function getProducts() {
            
            let res = await axios.get("/dashboard/product-list")
           if(res.status === 200){
                let productTable = $("#productTable");
                let productBody = $("#productBody");
                productTable.DataTable().destroy();
                productBody.empty();
                res.data['data'].forEach(product => {
                    
                    let row = `<tr>
                                <td>${product.name}</td>
                                <td>$${product.price}</td>
                                <td><button data-id="${product.id}" data-name="${product.name}" data-price="${product.price}" class="btn btn-sm btn-secondary addProduct">Add</button></td>
                        </tr>`

                     productBody.append(row)   
                });
           }

           new DataTable('#productTable',{
            
            lengthChange : false,
            info: false
           });
        }

        // Get Customers
        async function getCustomers(){
     
            let res = await axios.get("/dashboard/customer-list")
           if(res.status === 200){
                let customerTable = $("#customerTable");
                let customerBody = $("#customerBody");
                customerTable.DataTable().destroy();
                customerBody.empty();

                res.data['data'].forEach(customer => {
                    
                    let row = `<tr>
                                <td>${customer.name}</td>
                                <td>${"+880"+customer.mobile}</td>
                                <td><button data-name="${customer.name}" data-mobile="${customer.mobile}" data-id="${customer.id}" class="btn btn-sm btn-secondary addCustomer">Add</button></td>
                        </tr>`

                        customerBody.append(row)   
                });
           }

           new DataTable('#customerTable',{
            
            lengthChange : false,
            info: false
           });
        }

        // Add Customer
        $("#customerBody").on("click",".addCustomer",function(){

            let CID = $(this).data("id")
            let CNAME = $(this).data("name")
            let CMOBILE = $(this).data("mobile")

            $("#customerName").text(CNAME)
            $("#customerMobile").text("+880"+CMOBILE)
            $("#customerId").text(CID)

            customerInfo = {
                "id": CID,
                "name" : CNAME,
                "mobile" : CMOBILE
            }
        })

        // show  Product add modal
        $("#productBody").on("click",".addProduct",function(){
            let PID = $(this).data("id")
            let PNAME = $(this).data("name")
            let PPRICE = $(this).data("price")
            
            $("#pId").val(PID)
            $("#pName").val(PNAME)
            $("#pPrice").val(PPRICE)
            $("#contentModel").modal("show")         
          
        })


        // Remove Product
        $("#invoiceList").on("click",".removeProduct",function(){
            let index = $(this).data("index");
            products.splice(index,1);
            showProduct();
        })

        // Save Invoice

        async function saveInvoice(){
            let total = $("#total").text()
            let vat = $("#vat").text()
            let payable = $("#payAble").text()
            let discount = $("#discount").text()
            let customerId = customerInfo.id
        
            let data = {
                "customer_id" : customerId,
                "total" : total,
                "vat" : vat,
                "discount" : discount,
                "payable" : payable,
                "products" : products
            }

            if(!customerId){
                errorToast("Please Add Customer")
            }else if(products.length === 0){
                errorToast("Please Add Product")
            }else{
                showLoader();
                let res = await axios.post("/dashboard/invoice-create",data)
                hideLoader();

                if(res.status === 200){
                    successToast("Invoice Create Successfully")

                    window.location.href = "/dashboard/invoice"
                }else{
                    errorToast("Something is wrong")
                }
            }
        }


    </script>

   

@endsection