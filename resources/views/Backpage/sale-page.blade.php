@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Billed to section start --}}
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <div class="row">
                    <div class="col-8">
                        <span class="text-bold text-dark">Billed TO</span>
                        <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                        <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span> </p>
                        <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>        
                    </div>
                    <div class="col-4">
                      <img class="w-40" src="{{"image/Screenshot27.png"}}">
                      <p class="text-bold mx-0 my-1 text-dark">Invoice</p>
                      <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary">
                <div class="row">
                    <div class="col-12">
                        <table class="table w-100" id="invoiceTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                    <td>Remove</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="invoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mx-0 my-2 bg-secondary">
                <div class="row">
                    <div class="col-12">
                        <p class="text-bold text-xs my-1 text-dark">Total: <i class="bi bi-currency-dollar"></i><span id="total"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Payable: <i class="bi bi-currency-dollar"></i><span id="payable"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Vat(5%): <i class="bi bi-currency-dollar"></i><span id="vat"></span></p>
                        <p class="text-bold text-xs my-1 text-dark">Discount: <i class="bi bi-currency-dollar"></i><span id="discount"></span></p>
                        <input onkeydown="return false" value="0" min="0" type="number" step="0.25" onchange="DiscountChange()" class="form-control w-40 form-control-sm" id="discountP">
                        <p>
                            <button onclick="InvoiceCreate()" class="btn btn-sm my-2 bg-primary w-40 mt-5">Confirm</button>
                        </p>
                    </div>
                    <div class="col-12 p-2">

                    </div>
                </div>
            </div>
        </div>
        {{-- Billed to section End --}}

        {{-- Product section start --}}
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table w-100" id="productTable">
                    <thead class="w-100">
                        <tr class="text-xs">
                            <td>Product</td>
                            <td>Pick</td>
                        </tr>
                    </thead>     
                    <tbody class="w-100" id="productList">

                    </tbody>
                </table>
            </div>

        </div>
        {{-- Product section end --}}

        {{-- Customer section start --}}
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table table-sm w-100" id="customerTable">
                    <thead class="w-100">
                        <tr class="text-xs">
                            <td>Customer</td>
                            <td>Pick</td>
                        </tr>
                    </thead>
                    <tbody class="w-100" id="customerList">


                    </tbody>
                </table>
            </div>
        </div>
        {{-- Customer section end --}}
    </div>
</div>

{{-- modal start --}}

  <div class="modal fade" id="create-modal" role="dialog" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         
        <div class="modal-body">
          <form id="add-form">
         <div class="col-12 p-1">
            <label class="form-label">Product ID*</label>
            <input type="text" class="form-control" id="PId">
             <label class="form-label">Product Name*</label>
            <input type="text" class="form-control" id="PName">
             <label class="form-label">Product Price*</label>
            <input type="text" class="form-control" id="PPrice">
             <label class="form-label">Product Qty*</label>
            <input type="text" class="form-control" id="PQty">
         </div>
         </form>          
        </div>
        <div class="modal-footer" style="padding:30px">
          <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="close">Close</button>
          <button onclick="add()" id="save-btn" class="btn btn-sm btn-success">Add</button>
        </div>
      </div>
    </div>
  </div>
{{-- modal end --}}

<script>
/* ================= INITIAL LOAD ================= */
(async () => {
    await CustomerList();
    await ProductList();
})();

let InvoiceItemList = [];

/* ================= SHOW INVOICE ITEMS ================= */
function ShowInvoiceItem() {
    let invoiceList = $('#invoiceList');
    invoiceList.empty();

    InvoiceItemList.forEach(function (item, index) {
        let row = `
        <tr class="text-xs">
            <td>${item.product_name}</td>
            <td>${item.qty}</td>
            <td>${item.sale_price}</td>
            <td>
                <a data-index="${index}" class="btn remove btn-sm text-danger">Remove</a>
            </td>
        </tr>`;
        invoiceList.append(row);
    });

    CalculateGrandTotal();

    $('.remove').on('click', function () {
        let index = $(this).data('index');
        removeItem(index);
    });
}

function removeItem(index) {
    InvoiceItemList.splice(index, 1);
    ShowInvoiceItem();
}

/* ================= DISCOUNT ================= */
function DiscountChange() {
    CalculateGrandTotal();
}

/* ================= CALCULATE TOTAL ================= */
function CalculateGrandTotal() {
    let Total = 0;
    let Vat = 0;
    let Payable = 0;
    let Discount = 0;

    let discountPercentage = parseFloat(
        document.getElementById('discountP').value
    ) || 0;

    InvoiceItemList.forEach(item => {
        Total += parseFloat(item.sale_price);
    });

    if (discountPercentage > 0) {
        Discount = (Total * discountPercentage) / 100;
        Total = Total - Discount;
    }

    Vat = (Total * 5) / 100;
    Payable = Total + Vat;

    document.getElementById('total').innerText = Total.toFixed(2);
    document.getElementById('vat').innerText = Vat.toFixed(2);
    document.getElementById('payable').innerText = Payable.toFixed(2);
    document.getElementById('discount').innerText = Discount.toFixed(2);
}

/* ================= ADD PRODUCT FROM MODAL ================= */
async function add() {
    let PId = document.getElementById('PId').value;
    let PName = document.getElementById('PName').value;
    let PPrice = document.getElementById('PPrice').value;
    let PQty = document.getElementById('PQty').value;

    if (!PId) return errorToast("Product ID Required");
    if (!PName) return errorToast("Product Name Required");
    if (!PPrice) return errorToast("Product Price Required");
    if (!PQty) return errorToast("Product Quantity Required");

    let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);

    let item = {
        product_id: PId,
        product_name: PName,
        qty: PQty,
        sale_price: PTotalPrice
    };

    InvoiceItemList.push(item);

    $('#create-modal').modal('hide');
    ShowInvoiceItem();
}

/* ================= OPEN MODAL ================= */
async function addModal(id, name, price) {
    document.getElementById('PId').value = id;
    document.getElementById('PName').value = name;
    document.getElementById('PPrice').value = price;
    document.getElementById('PQty').value = 1;

    $('#create-modal').modal('show');
}

/* ================= CUSTOMER LIST ================= */
async function CustomerList() {
    let res = await axios.get("/customer-list");

    let customerList = $("#customerList");
    let customerTable = $("#customerTable");

    if ($.fn.DataTable.isDataTable('#customerTable')) {
        customerTable.DataTable().destroy();
    }

    customerList.empty();

    res.data.forEach(item => {
        let row = `
        <tr class="text-xs">
            <td>${item.name}</td>
            <td>
                <a 
                  data-name="${item.name}"
                  data-email="${item.email}"
                  data-id="${item.id}"
                  class="btn btn-outline-dark addCustomer btn-sm">
                  Add
                </a>
            </td>
        </tr>`;
        customerList.append(row);
    });

    $('.addCustomer').on('click', function () {
        $("#CName").text($(this).data('name'));
        $("#CEmail").text($(this).data('email'));
        $("#CId").text($(this).data('id'));
    });

    new DataTable('#customerTable', {
        info: false,
        lengthChange: false
    });
}

/* ================= PRODUCT LIST ================= */
async function ProductList() {
    let res = await axios.get("/product-list");

    let productList = $("#productList");
    let productTable = $("#productTable");

    if ($.fn.DataTable.isDataTable('#productTable')) {
        productTable.DataTable().destroy();
    }

    productList.empty();

    res.data.forEach(item => {
        let row = `
        <tr class="text-xs">
            <td>${item.name}</td>
            <td>
                <a 
                  data-id="${item.id}"
                  data-name="${item.name}"
                  data-price="${item.price}"
                  class="btn btn-outline-dark addProduct btn-sm">
                  Add
                </a>
            </td>
        </tr>`;
        productList.append(row);
    });

    $('.addProduct').on('click', function () {
        addModal(
            $(this).data('id'),
            $(this).data('name'),
            $(this).data('price')
        );
    });

    new DataTable('#productTable', {
        info: false,
        lengthChange: false
    });
}



   async function InvoiceCreate(){

      let total=document.getElementById('total').innerText;
      let discount=document.getElementById('discount').innerText;
      let vat=document.getElementById('vat').innerText;
      let payable=document.getElementById('payable').innerText;
      let CId=document.getElementById('CId').innerText;


    let Data={
    "total":total,
    "discount":discount,
    "vat":vat,
    "payable":payable,
    "customer_id":CId,
    "products":InvoiceItemList
  }

 if(CId.length===0){
    errorToast("Customer Required !")
  }
 else if(InvoiceItemList.length===0){
    errorToast("Product Required !")
 }
 else{
 let res=await axios.post("/invoice-create", Data)
  if(res.data===1){
    window.location.href='/invoicePage'
    successToast("Invoice Created");
  }
  else{
    errorToast("Something Went Wrong")
  }
 }

}


</script>


@endsection


