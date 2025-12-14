<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Body -->
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Delete!</h3>
                <p class="mb-3">Once deleted, you can't get it back.</p>

                <!-- Hidden ID -->
                <input type="hidden" id="deleteID">
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-end">
                <button
                    id="delete-modal-close" 
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <button
                    onclick="itemDelete()"
                    type="button"
                    id="confirmDelete"
                    class="btn btn-danger shadow-sm">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete(){
      let id = document.getElementById('deleteID').value;
    document.getElementById('delete-modal-close').click();

    let res=await axios.post("/category-delete",{id:id})
    if(res.data===1){
        successToast("Request Completed")
        await getList();
    }
    else{
        errorToast("Request Failed!")
    }

    }
</script>
