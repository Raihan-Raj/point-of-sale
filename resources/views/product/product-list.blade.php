<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div>
       <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold">Product</h4>
        <button
         type="button"
         class="float-end btn m-0 btn-sm bg-gradient-primary btn-primary"
         data-bs-toggle="modal"
         data-bs-target="#create-modal">
         Create
        </button>
      </div>
      <hr>
   <table id="tableData" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
   <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Unit</th>
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
        let res=await axios.get('/product-list');

        let tableList=$('#tableList');
        let tableData=$('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index) {
            let row=`<tr>
                <td>${index+1}</td>
                <td><img class="w-15 h-auto" alt="" src="${item['img_url']}"></td>
                <td>${item['name']}</td>
                <td>${item['price']}</td>
                <td>${item['unit']}</td>
                <td>
                    <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`

                tableList.append(row)
        })

      $('.editBtn').on('click', async function() {
         let id = $(this).data('id');
         let filePath=$(this).data('path');
         await FillUpUpdateForm(id,filePath)
         $("#update-modal").modal('show');
      })

       $('.deleteBtn').on('click',function() {
        let id = $(this).data('id');
        let path = $(this).data('path');
        $("#delete-modal").modal('show'); 
        $('#deleteID').val(id) ; 
        $('#deleteFilePath').val(path) ; 
      })

        /* let table = new DataTable('#tableData'); */
    new DataTable('#tableData',{
      order:[[0,'desc']],
      lengthMenu:[10,20,30,40,50]
    });
  }
</script>