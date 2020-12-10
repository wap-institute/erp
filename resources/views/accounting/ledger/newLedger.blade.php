<?php 
  session_start();
?>

@if(!isset($_SESSION['adminAuthentication']))
  <script>
    window.location = "/404";
  </script>
@else
  @extends("../../template.adminPanel.accountingTemplate")

@section("title")
  WES - new ledger
@endsection

@section("custom-css")
  <link rel="stylesheet" href="lang/css/adminPanel/teamDesign.css?cache=<?php echo time();?>">
@endsection

@section("custom-js")
<script src="lang/js/adminPanel/teamDesign.js?cache=<?php echo time();?>"></script>
@endsection

@section("businessContent")
 	<nav class="navbar navbar-expand p-0 mb-3 position-relative">
		<ul class="navbar-nav">
			<li class="nav-item"><a href="#" class="nav-link p-0 quicksand-font">Ledger</a></li>
			<li class="nav-item"><a href="#" class="nav-link py-0 px-1 quicksand-font">/</a></li>
			<li class="nav-item"><a href="#" class="nav-link p-0 quicksand-font active">New Ledger</a></li>
		</ul>
	</nav>

	<div class="container-fluid w-75 mx-0">
		<div class="row erpbg-info">
			<div class="col-md-9 d-flex align-items-center p-4">		<p class="p-0 m-0 quicksand-font">Ledger Name :</p>
				<input type="text" name="ledger_name" class="mx-3 py-1 px-2 flex-grow-1 border-0 bg-light">
			</div>
			<div class="col-md-3 p-4 border border-light border-right-0 border-top-0 border-bottom-0">
				<p class="p-0 m-0 quicksand-font mb-2">Total Opening Balance</p>

				<p class="p-0 m-0 quicksand-font">1000 Cr</p>
				<p class="p-0 m-0 quicksand-font">Difference</p>
				<div class="dropdown-divider border-light"></div>
				<p class="p-0 m-0 quicksand-font">1000 Cr</p>
			</div>
			<div class="col-md-6 p-4 border border-light border-bottom-0 border-left-0">
				<div class="d-flex align-items-center mb-4">
					<p class="p-0 m-0 quicksand-font">Under :</p>
				<select name="ledger_name" class="ml-3 p-1 flex-grow-1 border-0 bg-light quicksand-font">
					<option>Capital Account</option>
				</select>
				</div>

				<div class="d-flex align-items-center mb-5">
					<p class="p-0 m-0 quicksand-font">Processesed With :</p>
				<select name="ledger_name" class="ml-3 p-1 flex-grow-1 border-0 bg-light quicksand-font">
					<option>Without Documents</option>
					<option>Documents</option>
				</select>
				</div>

				<div class="d-flex align-items-center mb-4">
					<input type="checkbox">
					<p class="p-0 m-0 mx-3 quicksand-font">Disable Address Field</p>
				</div>

				<div class="d-flex flex-column">
					<input type="text" name="ledger_name" class="px-2 py-1 flex-grow-1 border-0 bg-light quicksand-font mb-4" placeholder="Area , Flat , Door Block No">

					<div class="d-flex">
					<input type="text" name="ledger_name" class="px-2 py-1 flex-grow-1 border-0 bg-light quicksand-font mb-4 mr-1" placeholder="City">

					<input type="text" name="ledger_name" class="px-2 py-1 flex-grow-1 border-0 bg-light quicksand-font mb-4" placeholder="Pincode">
					</div>

					<div class="d-flex">
					<input type="text" name="ledger_name" class="px-2 py-1 flex-grow-1 border-0 bg-light quicksand-font mb-4 mr-1" placeholder="State">

					<input type="text" name="ledger_name" class="px-2 py-1 flex-grow-1 border-0 bg-light quicksand-font mb-4" placeholder="Country">
					</div>


				</div>
			</div>
			<div class="col-md-6 p-4 border border-light border-bottom-0 border-left-0 border-right-0">
				<div class="without-documents">
					<div class="d-flex flex-column mb-4">
					<p class="p-0 m-0 quicksand-font">Primary Contact</p>
					<input type="text" name="ledger_name" class="py-1 px-2 flex-grow-1 border-0 bg-light">
					</div>

					<div class="d-flex flex-column mb-4">
					<p class="p-0 m-0 quicksand-font">Secondary Contact</p>
					<input type="text" name="ledger_name" class="py-1 px-2 flex-grow-1 border-0 bg-light">
					</div>

					<div class="d-flex flex-column mb-4">
					<p class="p-0 m-0 quicksand-font">Whats App</p>
					<input type="text" name="ledger_name" class="py-1 px-2 flex-grow-1 border-0 bg-light">
					</div>

					<div class="d-flex flex-column mb-4">
					<p class="p-0 m-0 quicksand-font">Email Id</p>
					<input type="text" name="ledger_name" class="py-1 px-2 flex-grow-1 border-0 bg-light">
					</div>

					<div class="d-flex flex-column">
					<p class="p-0 m-0 quicksand-font">Opening Date</p>
					<input type="date" name="ledger_name" class="py-1 px-2 flex-grow-1 border-0 bg-light">
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2 border border-light border-bottom-0 border-left-0 border-right-0 d-flex justify-content-center align-items-center">

				<p class="p-0 m-0 quicksand-font">Opening Balance :</p>
				<div class="btn-group ml-3">
					<input type="text" name="ledger_name" class="py-1 px-2 border-0 bg-light" style="width:100px">
					<input type="text" name="ledger_name" class="py-1 px-2 border border-dark border-top-0 border-right-0 border-bottom-0 bg-light text-center text-light" style="width:40px" placeholder="Cr">
				</div>
			</div>
			</div>
		</div>
	</div>
@endsection
@endif