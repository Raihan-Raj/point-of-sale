<!-- Modal -->
  <div class="modal fade" id="create-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Customer</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form id="save-form">
             <div class="col-12 p-1">
             <label class="form-label mt-2">Customer Name *</label>
             <input type="text" class="form-control" id="customerName">
             <br>
             <label class="form-label mt-2">Customer Email *</label>
             <input type="text" class="form-control" id="customerEmail">
             <br>
             <label class="form-label mt-2">Customer Mobile *</label>
             <input type="text" class="form-control" id="customerMobile">
             </div>
        </form>                     
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button onclick="Save()" id="save-btn" class="btn btn-sm btn-success">Save</button>
        </div>
      </div>
      
    </div>
  </div>

<script>

      async function Save() { 

        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerMobile = document.getElementById('customerMobile').value;

        if(customerName.length === 0){
            errorToast("customerName Required !")
        }
        else if(customerEmail.length === 0){
           errorToast("customerEmail Required !")
        }
        else if(customerMobile.length === 0){
             errorToast("customerMobile Required !")
        }
         else{
            document.getElementById('modal-close').click();

            let res = await axios.post("/customer-create",{name:customerName,email:customerEmail,mobile:customerMobile})

            if(res.status===201){
                successToast('Request Completed');
                document.getElementById("save-form").reset();
               
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>