<div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">INVOICE</h1>
          <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
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
                </div>
            </div>

        </div>
        </div>
        <div class="modal-footer">
          <button id="closeBtn"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="submitBtn" onclick="printInvoice()" type="button" class="btn btn-primary">Print</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function printInvoice(){
      let printContents = document.getElementById("invoice").innerHTML;
      let originalContents = document.body.innerHTML

      document.body.innerHTML = printContents
      window.print();
      document.body.innerHTML = originalContents

      setTimeout(() => {
        window.location.reload()
      }, 500);
      


    }
  </script>