
@extends('layout.sidenav-layout')
@section('content')
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile  bx-lg'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="{{ url('/dashboard') }}">
					<i class='bx bxs-dashboard bx-sm' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/customerPage') }}">
					
                    <i class='bx bxs-group bx-sm' ></i>
					<span class="text">Customer</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/categoryPage') }}">
					<i class='bx bxs-doughnut-chart bx-sm' ></i>
					<span class="text">Category</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/productPage') }}">
					<i class='bx bxs-message-dots bx-sm' ></i>
					<span class="text">Product</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/salePage') }}">
					<i class='bx bxs-shopping-bag-alt bx-sm' ></i>
					<span class="text">Create Sale</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/invoicePage') }}">
                    <i class="bx bx-receipt bx-spin-hover"></i>
					<span class="text">Invoice</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class="bx bx-receipt bx-spin-hover"></i>
					<span class="text">Report</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bx-power-off bx-sm bx-burst-hover' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
<nav>
    <i class='bx bx-menu bx-sm' ></i>
    <a href="#" class="nav-link">Categories</a>
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
        </div>
    </form>
    <input type="checkbox" class="checkbox" id="switch-mode" hidden />
    <label class="swith-lm" for="switch-mode">
        <i class="bx bxs-moon"></i>
        <i class="bx bx-sun"></i>
        <div class="ball"></div>
    </label>

    <!-- Notification Bell -->
    <a href="#" class="notification" id="notificationIcon">
        <i class='bx bxs-bell bx-tada-hover' ></i>
        <span class="num">8</span>
    </a>
    <div class="notification-menu" id="notificationMenu">
        <ul>
            <li>New message from John</li>
            <li>Your order has been shipped</li>
            <li>New comment on your post</li>
            <li>Update available for your app</li>
            <li>Reminder: Meeting at 3PM</li>
        </ul>
    </div>

    <!-- Profile Menu -->
    <a href="#" class="profile" id="profileIcon">
        <img src="https://placehold.co/600x400/png" alt="Profile">
    </a>
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Log Out</a></li>
        </ul>
    </div>
</nav>
<!-- NAVBAR -->


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-message-dots' ></i>
					<span class="text">
						<h3><span id="product"></span></h3>
						<p>Product</p>
					</span>
				</li>
				<li>
					<i class=' bx bxs-doughnut-chart' ></i>
					<span class="text">
						<h3><span id="category"></span></h3>
						<p>Category</p>
					</span>
				</li>
                <li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><span id="customer"></span></h3>
						<p>Customer</p>
					</span>
				</li>
                <li>
					<i class='bx bx-receipt' ></i>
					<span class="text">
						<h3><span id="invoice"></span></h3>
						<p>Invoice</p>
					</span>
				</li>
				<li>
					<span class="text">
						<i class='bx bxs-dollar-circle'>
							<h3><span id="total"></span></h3>
						</i>
						<p>Total Sale</p>
					</span>
				</li>
                <li>	
					<span class="text">	
						<i class='bx bxs-dollar-circle' >
							<h3><span id="vat"></span></h3>
						</i>
						<p>Vat Collection</p>
					</span>
				</li>
                <li>
					<span class="text">	
						<i class='bx bxs-dollar-circle' >
						<h3><span id="payable"></span></h3>
					</i>
						<p>Total Collection</p>
					</span>
				</li>
			</ul>


			{{-- <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="https://placehold.co/600x400/png">
									<p>Micheal John</p>
								</td>
								<td>18-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>
								<td>
									<img src="https://placehold.co/600x400/png">
									<p>Ryan Doe</p>
								</td>
								<td>01-06-2022</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="https://placehold.co/600x400/png">
									<p>Tarry White</p>
								</td>
								<td>14-10-2021</td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>
								<td>
									<img src="https://placehold.co/600x400/png">
									<p>Selma</p>
								</td>
								<td>01-02-2023</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="https://placehold.co/600x400/png">
									<p>Andreas Doe</p>
								</td>
								<td>31-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus icon'></i>
						<i class='bx bx-filter' ></i>
	
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Check Inventory</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Manage Delivery Team</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Contact Selma: Confirm Delivery</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Update Shop Catalogue</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Count Profit Analytics</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div> --}}
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


<script>

	getList();

	async function getList() {

		let res=await axios.get('/summary');

		document.getElementById('product').innerText=res.data['product']
		document.getElementById('category').innerText=res.data['category']
		document.getElementById('customer').innerText=res.data['customer']
		document.getElementById('invoice').innerText=res.data['invoice']
		document.getElementById('total').innerText=res.data['total']
		document.getElementById('vat').innerText=res.data['vat']
		document.getElementById('payable').innerText=res.data['payable']

	

	}


</script>






@endsection