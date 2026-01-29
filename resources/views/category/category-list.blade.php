<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div>
       <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold">Category</h4>
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
        <th>Category</th>
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
        let res=await axios.get('/category-list');

        let tableList=$('#tableList');
        let tableData=$('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index) {
            let row=`<tr>
                <td>${index+1}</td>
                <td>${item['name']}</td>
                <td>
                    <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`

                tableList.append(row)
        })

      $('.editBtn').on('click', async function() {
         let id = $(this).data('id');
        await FillUpUpdateForm(id);
         $("#update-modal").modal('show');      
      })

       $('.deleteBtn').on('click',function() {
        let id = $(this).data('id');
        $("#delete-modal").modal('show'); 
        $('#deleteID').val(id) ;  
      })

        /* let table = new DataTable('#tableData'); */
    new DataTable('#tableData',{
      order:[[0,'desc']],
      lengthMenu:[10,20,30,40,50]
    });
  }
</script>