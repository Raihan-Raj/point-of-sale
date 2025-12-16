 <div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         
        <div class="modal-body">
          <form id="save-form">
         <div class="col-12 p-1">
            <label class="form-label">Category Name *</label>
             <input type="text" class="form-control" id="categoryNameUpdate">
             <br>
             <!-- Hidden ID -->
                <input type="hidden" id="updateID">
         </div>
         </form>                 
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button onclick="Update()" id="update-btn" class="btn btn-sm btn-success">Update</button>
        </div>
      </div> 
    </div>
  </div>

  <script>

   async function FillUpUpdateForm(id){

    document.getElementById('updateID').value=id;
    let res=await axios.post("/category-by-id", {id:id})
    document.getElementById('categoryNameUpdate').value=res.data['name'];   
    }

       async function Update() {
        
        let categoryNameUpdate = document.getElementById('categoryNameUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if(categoryNameUpdate.length === 0){
            errorToast("Category Required !")
        } else{
            document.getElementById('update-modal-close').click();

            let res = await axios.post("/category-update",{name:categoryNameUpdate,id:updateID})

            if(res.status===200 && res.data===1){
                successToast('Request Completed !');
               await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
  </script>