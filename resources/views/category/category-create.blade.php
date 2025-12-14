<!-- Modal -->
  <div class="modal fade" id="create-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         
        <div class="modal-body">
         <div class="col-12 p-1">
            <label class="form-label">Category Name *</label>
             <input type="text" class="form-control" id="categoryName">
         </div>
                       
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button id="save-btn" class="btn btn-sm btn-success">Save</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
    document.getElementById("save-btn").addEventListener('click',async function(){
        
        let categoryName = document.getElementById('categoryName').value;

        if(categoryName.length === 0){
            errorToast("Category Required !")
        } else{
            document.getElementById('modal-close').click();

            let res = await axios.post("/category-create",{name:categoryName})

            if(res.status===201){
                successToast('Request Completed');
                document.getElementById("save-form").reset();
               
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    })
</script>