  <div class="modal fade" id="create-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form id="save-form">
             <div class="col-12 p-1">
             <label class="form-label mt-2">Category</label>
             <select type="text" class="form-control form-select" id="productCategory">
                <option value="">Select Category</option>
             </select>
             <br>
             <label class="form-label mt-2">Name *</label>
             <input type="text" class="form-control" id="productName">
             <br>
             <label class="form-label mt-2">Price *</label>
             <input type="text" class="form-control" id="productPrice">
             <br>
             <label class="form-label mt-2">Unit*</label>
             <input type="text" class="form-control" id="productUnit">
             <br>
             <br>
             <img class="w-15" id="newImg" src="{{ asset('images/Screenshot27.png') }}">
             <br>
             <label class="form-label mt-2">Image</label>
             <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">
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

  FillCategoryDropDown();

 async function FillCategoryDropDown(){
    let res = await axios.get("/category-list")
    res.data.forEach(function (item,i){
        let option=`<option value="${item['id']}">${item['name']}</option>`
        $("#productCategory").append(option);
    })
}

 async function Save() {
    let productCategory=document.getElementById('productCategory').value;
    let productName=document.getElementById('productName').value;
    let productPrice=document.getElementById('productPrice').value;
    let productUnit=document.getElementById('productUnit').value;
    let productImg=document.getElementById('productImg').files[0];

    if (productCategory.length === 0) {
        errorToast("Product Category Required !")
    }
    else if (productName.length===0){
        errorToast("Product Name Required !")
    }
    else if (productPrice.length===0){
        errorToast("Product Price Required !")
    }
    else if (productUnit.length===0){
        errorToast("Product Unit Required !")
    }
    else if (!productImg){
        errorToast("Product Image Required !")
    }

    else{
        document.getElementById('modal-close').click();

        let formData=new FormData();
        formData.append('img',productImg)
        formData.append('name',productName)
        formData.append('price',productPrice)
        formData.append('unit',productUnit)
        formData.append('category_id',productCategory)

        const config = {
            headers: {
                'content-type':'multipart/form-data'
            }
        }

        let res = await axios.post("/product-create",formData,config);

        if(res.status===201){
            successToast('Request Complete');
            document.getElementById("save-form").reset();
            await getList();
        }
        else{
            errorToast("Request Fail !")
        }
    }
} 
  </script>