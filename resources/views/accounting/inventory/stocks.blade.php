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
<script src="lang/js/accounting/inventory/stocks.js?cache=<?php echo time();?>"></script>
@endsection

@section("businessContent")
 	<nav class="navbar navbar-expand p-0 mb-3 position-relative">
		<ul class="navbar-nav">
			<li class="nav-item"><a href="#" class="nav-link p-0 quicksand-font">Inventory</a></li>
			<li class="nav-item"><a href="#" class="nav-link py-0 px-1 quicksand-font">/</a></li>
			<li class="nav-item"><a href="#" class="nav-link p-0 quicksand-font active">Stocks</a></li>
		</ul>
	</nav>

	<div class="container-fluid mx-0 px-0">
		<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#new-stocks">New Stocks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="new-stocks" class="quicksand-font container-fluid px-0 tab-pane active">
      <select class="product-type my-4 form-control bg-dark text-white border-0 rounded-0" style="width:fit-content">
      	<option>Physical Product</option>
      	<option>Digital Product</option>
      	<option>Subscription Product</option>
      </select>

      <div class="physical-product">
      	<div class="row">
      		<div class="col-md-4">
      			<form class="p-4 border shadow-sm physical-stocks-product-form" method="post" enctype="multipart/form-data">
      				@csrf

      					
						<div class="form-group quicksand-font">
							<label>Product Name</label>
							<input type="text" name="product_name" class="form-control rounded-0" required>
						</div>



						<div class="form-group quicksand-font">
							<label>Product Description</label>
							<textarea type="text" name="product_description" class="form-control rounded-0" required>
							</textarea>
						</div>

						<div class="form-group quicksand-font">
							<label>Under Group</label>
							<select type="text" name="under_group" class="form-control rounded-0 physical-group">
								<option>Primary</option>
							</select>
						</div>

						<div class="form-group quicksand-font">
							<label>Unit Of Measure</label>
							<select type="text" name="unit_of_measure" class="form-control rounded-0">
								<option>Pc</option>
								<option>Kg</option>
								<option>Lt</option>
								<option>Gm</option>
							</select>
						</div>

						<div class="form-group quicksand-font">
							<label>Quantity</label>
							<input type="number" name="quantity" class="form-control rounded-0 physical-product-qnt" required>
						</div>

						<div class="form-group quicksand-font">
							<label>Rate</label>
							<input type="number" name="rate" class="form-control rounded-0 physical-product-rate" required>
						</div>

						<div class="form-group quicksand-font d-none">
							<label>Amount</label>
							<input type="number" name="amount" class="form-control rounded-0 physical-product-amount" required>
						</div>

							<div class="form-group quicksand-font">
							<label>Product Images</label>
							<input type="file" name="product_images[]" class="form-control rounded-0 product-images" accept="image/*" required multiple="multiple">
						</div>

						<div class="form-group quicksand-font product-images-preview">

						</div>

						<div class="form-group quicksand-font mt-4">
							<button class="btn erpbg-primary rounded-0 text-white" type="submit">
								Add To Stocks
							</button>
						</div>

						<div class="form-group quicksand-font physical-stocks-product-message">
							
						</div>
					</form>
      		</div>
      		<div class="col-md-1"></div>
      		<div class="col-md-4">
      			<form class="quicksand-font border p-4 shadow-sm physical-stocks-group-create" method="post">
      				@csrf
						<div class="form-group">
							<label>Create Groups</label>
							<input type="text" name="group_name" class="form-control rounded-0" placeholder="Enter Group Name Ex:- Mobile" required="required">
						</div>

						<div class="form-group">
							<select name="under_group" class="form-control rounded-0 physical-group">
								<option>Primary</option>
							</select>
						</div>

						<div class="form-group">
							<button class="btn erpbg-primary text-white rounded-0" type="submit">
								Add Group
							</button>
						</div>

						<div class="form-group physical-stocks-group-message">
						</div>
						
					</form>
      		</div>
      	</div>
      </div>

      <div class="digital-product d-none">
      	<div class="row">
      		<div class="col-md-4">
      			<form class="p-4 border shadow-sm digital-stocks-product-form" method="post" enctype="multipart/form-data">
      				@csrf
      					
						<div class="form-group quicksand-font">
							<label>Product Name</label>
							<input type="text" name="product_name" class="form-control rounded-0" required>
						</div>


						<div class="form-group quicksand-font">
							<label>Product Description</label>
							<textarea type="text" name="product_description" class="form-control rounded-0" required>
							</textarea>
						</div>

						<div class="form-group quicksand-font">
							<label>Under Group</label>
							<select type="text" name="under_group digital-group" class="form-control rounded-0">
								<option>Primary</option>
							</select>
						</div>						

						<div class="form-group quicksand-font">
							<label>Amount</label>
							<input type="number" name="amount" class="form-control rounded-0" required>
						</div>

						<div class="form-group quicksand-font">
							<label>Product Images</label>
							<input type="file" name="product_image" class="form-control rounded-0" accept="image/*" required>
						</div>

						<div class="form-group quicksand-font digital-product-images-preview">

						</div>

						<div class="form-group quicksand-font mt-4">
							<button class="btn erpbg-primary rounded-0 text-white" type="submit">
								Add To Stocks
							</button>
						</div>

						<div class="form-group quicksand-font digital-stocks-product-message">
							
						</div>
				</form>
      		</div>
      		<div class="col-md-1"></div>
      		<div class="col-md-4">
      			<form class="quicksand-font border p-4 shadow-sm digital-stocks-group-create">
      				@csrf
						<div class="form-group">
							<label>Create Groups</label>
							<input type="text" name="group_name" class="form-control rounded-0" placeholder="Enter Group Name Ex:- Coding" required="required">
						</div>

						<div class="form-group">
							<select name="under_group" class="form-control rounded-0 digital-group">
								<option>Primary</option>
							</select>
						</div>

						<div class="form-group">
							<button class="btn erpbg-primary text-white rounded-0" type="submit">
								Add Group
							</button>
						</div>

						<div class="form-group digital-stocks-group-message">
						</div>
						
					</form>
      		</div>
      	</div>
      </div>

      <div class="subscription-product d-none">
      	<div class="row">
      		<div class="col-md-4">
      			<form class="p-4 border shadow-sm subscription-stocks-product-form" method="post" enctype="multipart/form-data">
      				@csrf
      					
						<div class="form-group quicksand-font">
							<label>Product Name</label>
							<input type="text" name="product_name" class="form-control rounded-0" required>
						</div>


						<div class="form-group quicksand-font">
							<label>Product Description</label>
							<textarea type="text" name="product_description" class="form-control rounded-0" required>
							</textarea>
						</div>

						<div class="form-group quicksand-font">
							<label>Duration</label>
							<div class="d-flex">
							<input type="number" name="duration" class="form-control rounded-0 flex-grow-1 mr-1" required>
							<select class="form-control rounded-0" style="width:fit-content" name="duration_in">
								<option>Months</option>
								<option>Days</option>
								<option>Years</option>
							</select>
							</div>
						</div>

						<div class="form-group quicksand-font">
							<label>One Time Amount</label>
							<input type="number" name="one_time_payment" class="form-control rounded-0 ota" required>
						</div>

						<div class="form-group quicksand-font">
							<label>Installments Policy</label>
						</div>

						<div class="form-group quicksand-font installments-field">
							
						</div>

						<div class="form-group quicksand-font">
							<button class="btn erpbg-primary text-white d-flex align-items-center rounded-0 installments-btn" type="button">
								<span class="material-icons">
									add
								</span>
								<p class="p-0 m-0">Add Installments Policy</p>
							</button>
						</div>

						<div class="form-group quicksand-font">
							<input type="checkbox" class="autoincrement-checkbox">
							<label>Enable Autoincrement</label>
						</div>

						<div class="form-group quicksand-font mt-4">
							<button class="btn erpbg-primary rounded-0 text-white" type="submit">
								Add To Stocks
							</button>
						</div>

						<div class="form-group quicksand-font subscription-stocks-product-message">
							
						</div>
				</form>
      		</div>
      		<div class="col-md-1"></div>
      		<div class="col-md-4">
      			<form class="increment-policy-form quicksand-font border shadow-sm p-4">
				@csrf
      				<div class="form-group">
      					<label>Add Autoincrement Policy</label>
      					<input type="number" name="no_of_ins" placeholder="No Of Installments" class="form-control rounded-0" required>
      				</div>

      				<div class="form-group d-flex">
      					<input type="number" name="percentage" placeholder="How much increments in percentage of ota ?" class="form-control rounded-0" required>
      					<button class="form-control rounded-0" style="width:fit-content" type="button">%</button>
      				</div>

      				<div class="form-group">
      					<button class="rounded-0 btn erpbg-primary text-white">
      						Add
      					</button>
      				</div>

      				<div class="form-group autoincrement-policy-message"></div>
      			</form>
      		</div>
      	</div>
      </div>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
	</div>
@endsection
@endif