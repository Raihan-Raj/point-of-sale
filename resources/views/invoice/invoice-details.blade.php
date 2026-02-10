{{-- modal start --}}

  <div class="modal fade" id="details-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Invoice</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         
        <div id="invoice" class="modal-body">
          <div class="container-fluid">
            <br>
            <div class="row">
                    <div class="col-8">
                        <span class="text-bold text-dark">Billed TO</span>
                        <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                        <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span> </p>
                        <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>        
                    </div>
                    <div class="col-4">
                      {{-- <img class="w-40" src="{{"image/Screenshot27.png"}}"> --}}
                      <p class="text-bold mx-0 my-1 text-dark">Invoice</p>
                      <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <hr>  
                    <div class="row">
                    <div class="col-12">
                        <table class="table w-100" id="invoiceTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="invoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="col-12">
                        <p class="text-bold text-xs my-1 text-dark">Total: <i class="bi bi-currency-dollar"></i><span id="total"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Payable: <i class="bi bi-currency-dollar"></i><span id="payable"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Vat(5%): <i class="bi bi-currency-dollar"></i><span id="vat"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Discount: <i class="bi bi-currency-dollar"></i><span id="discount"></span></p>
                    </div>
                </div>
         </div>          
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button onclick="PrintPage()" id="save-btn" class="btn btn-sm btn-success">Print</button>
        </div>
      </div>
    </div>
  </div>
{{-- modal end --}}

<script>
    async function InvoiceDetails(cus_id,inv_id){
        let res=await axios.post('/invoice-details',{cus_id:cus_id,inv_id:inv_id})
        document.getElementById('CName').innerText=res.data['customer']['name']
        document.getElementById('CId').innerText=res.data['customer']['user_id']
        document.getElementById('CEmail').innerText=res.data['customer']['email']
        document.getElementById('total').innerText=res.data['invoice']['total']
        document.getElementById('payable').innerText=res.data['invoice']['payable']
        document.getElementById('vat').innerText=res.data['invoice']['vat']
        document.getElementById('discount').innerText=res.data['invoice']['discount']

        let invoiceTable=$('#invoiceTable');
        let invoiceList=$('#invoiceList');
        invoiceList.empty();

        res.data['product'].forEach(function(item,index) {
        let row = `<tr class="text-xs">
            <td>${item['name']}</td>
            <td>${item['qty']}</td>
            <td>${item['sale_price']}</td>
        </tr>`;
        invoiceList.append(row);
    });

        $("#details-modal").modal('show')

    }

    function PrintPage() {
      let printContents = document.getElementById('invoice').innerHTML;
      let originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      setTimeout(function(){
        location.reload();
      }, 1000);
    }
</script>