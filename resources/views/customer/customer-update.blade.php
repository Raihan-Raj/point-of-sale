<!-- Modal -->
  <div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Customer</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form id="save-form">
             <div class="col-12 p-1">
             <label class="form-label mt-2">Customer Name *</label>
             <input type="text" class="form-control" id="customerNameUpdate">
             <br>
             <label class="form-label mt-2">Customer Email *</label>
             <input type="text" class="form-control" id="customerEmailUpdate">
             <br>
             <label class="form-label mt-2">Customer Mobile *</label>
             <input type="text" class="form-control" id="customerMobileUpdate">
             <input type="hidden" id="updateID">
             </div>
        </form>                     
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button onclick="Update()" id="save-btn" class="btn btn-sm btn-success">Update</button>
        </div>
      </div>
      
    </div>
  </div>

   <script>

   async function FillUpUpdateForm(id){

    document.getElementById('updateID').value=id;
    let res=await axios.post("/customer-by-id", {id:id})
    document.getElementById('customerNameUpdate').value=res.data['name']; 
    document.getElementById('customerEmailUpdate').value=res.data['email'];
    document.getElementById('customerMobileUpdate').value=res.data['mobile'];  
    }

       async function Update() {
        
        let customerNameUpdate = document.getElementById('customerNameUpdate').value;
        let customerEmailUpdate = document.getElementById('customerEmailUpdate').value;
        let customerMobileUpdate = document.getElementById('customerMobileUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if(customerNameUpdate.length === 0){
            errorToast("Category Required !")
        }
        else if(customerEmailUpdate.length === 0){
          errorToast("Category Required !")
        }
        else if(customerMobileUpdate.length === 0){
          errorToast("Category Required !")
        }
         else{
            document.getElementById('update-modal-close').click();

            let res = await axios.post("/customer-update",{name:customerNameUpdate,email:customerEmailUpdate,mobile:customerMobileUpdate,id:updateID})

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