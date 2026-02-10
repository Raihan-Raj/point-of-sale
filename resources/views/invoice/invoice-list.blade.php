<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div>
       <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold">Invoice</h4>
       <div class="align-item-center col">
        <a href="{{ url('/salePage') }}" class="float-end btn m-0 bg-primary">Create Sale</a>
       </div>
      </div>
      <hr>
   <table id="tableData" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
   <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Total</th>
        <th>Vat</th>
        <th>Discount</th>
        <th>Payable</th>
        <th>Action</th>
      </tr>
   </thead>
   <tbody id="tableList">
   <!-- Dynamic rows -->
   </tbody>
  </table>
     </div>
    </div>
   </div>
  </div>

<script>
    getList();
    async function getList(){
        let res=await axios.get('/invoice-list');

        let tableList=$('#tableList');
        let tableData=$('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index) {
            let row=`<tr>
                <td>${index+1}</td>
                <td>${item['customer']['name']}</td>
                <td>${item['customer']['mobile']}</td>
                <td>${item['total']}</td>
                <td>${item['vat']}</td>
                <td>${item['discount']}</td>
                <td>${item['payable']}</td>
                <td>
                    <button data-id="${item['id']}" data-cus="${item['customer']['id']}" class="btn viewbtn btn-sm btn-outline-dark btn-sm m-0"><i class="fa-solid fa-eye"></i></button>
                    <button data-id="${item['id']}" data-cus="${item['customer']['id']}" class="btn deleteBtn btn-sm btn-outline-danger btn-sm m-0"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>`

                tableList.append(row)
        })

      $('.viewbtn').on('click', async function() {
         let id = $(this).data('id');
         let cus = $(this).data('cus');
         await InvoiceDetails(cus,id)
      })

       $('.deleteBtn').on('click',function() {
        let id = $(this).data('id');
        document.getElementById('deleteID').value=id;
        $("#delete-modal").modal('show'); 
       
      })

        /* let table = new DataTable('#tableData'); */
    new DataTable('#tableData',{
      order:[[0,'desc']],
      lengthMenu:[5,10,15,20,30]
    });
  }
</script>