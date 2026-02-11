@extends('layout.app')
@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            
            <!-- Card Header -->
            <div class="card-header bg-gradient-primary text-white text-center rounded-top-4 py-3">
                <h4 class="mb-0 text-black">
                    <i class="fas fa-chart-line me-2 text-black"></i> Sales Report
                </h4>
            </div>

            <!-- Card Body -->
            <div class="card-body p-4">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Date From</label>
                    <input id="FormDate" type="date" class="form-control form-control-lg rounded-3">
                </div>

                <div class="mb-4 mt-5">
                    <label class="form-label fw-semibold">Date To</label>
                    <input id="ToDate" type="date" class="form-control form-control-lg rounded-3">
                </div>

                <div class="d-grid mt-5">
                    <button onclick="SalesReport()" 
                        class="btn btn-primary btn-lg rounded-3 shadow-sm">
                        <i class="fas fa-download me-2"></i> Download Report
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<script>

    function SalesReport() {
        let FormDate = document.getElementById('FormDate').value;
        let ToDate = document.getElementById('ToDate').value;
        if(FormDate.length === 0 || ToDate.length === 0){
            errorToast("Date Range Required !")
        }else{
            window.open('/sales-report/' +FormDate+ '/' +ToDate);
        }
    }

</script>