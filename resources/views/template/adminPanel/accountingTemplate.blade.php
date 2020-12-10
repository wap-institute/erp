<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield("title")</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="lang/css/adminPanel/adminPanelTemplate.css?cache=<?php  echo time();?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
      <link rel="stylesheet" href="lang/css/customFramework.css?cache=<?php  echo time();?>">
<!-- start custom css -->
  @yield("custom-css")
<!-- edn custom css -->

<!-- start custom js -->
  @yield("custom-js")
<!-- edn custom js -->

</head>
<body class="bg-light" token="{{csrf_token()}}">
<div class="container-fluid px-0">
	<div class="sidenav shadow-sm bg-white p-4">
		<center>
			<div class="admin-profile">
				<span class="material-icons text-white" style="font-size:60px">
				account_circle
				</span>
				<h5 class="quicksand-font text-white">Hi ! Admin</h5>
        <hr size="5" color="#f7839e">
			</div>
		</center>

		<div class="admin-menu my-4">
			<ul class="navbar-nav">
				<li class="d-flex align-items-center border p-2 mb-3">
					<span class="material-icons mr-2 text-white">
					people
					</span>
					<a href="/teamdesign" class="quicksand-font text-white" style="font-size: 14px">
						Team Design
					</a>
				</li>

        <li class="d-flex align-items-center border p-2 mb-3">
          <span class="material-icons mr-2 text-white">
          library_books
          </span>
          <a href="/newledger" class="quicksand-font text-white" style="font-size: 14px">
            Accounting
          </a>
        </li>
			</ul>
		</div>
	</div>
	<div class="page">
		<!-- start navbar -->

			<nav class="navbar navbar-expand-lg py-3 primary-navbar">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
		<!-- end navbar -->

		<div class="admin-area p-4">
			<nav class="navbar navbar-expand-lg navbar-light bg-light position-relative mx-n4 mt-n4 accounting-navbar">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown quicksand-font" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ledger
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/newledger">New Ledger</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown quicksand-font" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventry
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/stocks">Stocks</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown quicksand-font" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Voucher
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown quicksand-font" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
  <div class="card mt-2 border-0 rounded-0 shadow-sm">
    <div class="card-body">
      @yield("businessContent")
    </div>
  </div>
    
		</div>	
	</div>
</div>

<!-- start full page loader -->
  <div class="fullpage-loader d-none">
    <div class="lds-ripple">
      <div></div>
      <div></div>
    </div>
  </div>
<!-- end full page loader-->
</body>
</html>
