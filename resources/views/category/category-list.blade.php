<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div>
       <div class="d-flex justify-content-between align-items-center mb-3">
   <h4 class="fw-bold">Category</h4>
   <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#create">Create</button>
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
                    <button class="btn btn-sm btn-outline-success">Edit</button>
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`

                tableList.append(row)
        })

        let table = new DataTable('#tableData');
    }
</script>