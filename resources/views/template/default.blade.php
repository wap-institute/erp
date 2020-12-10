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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- start custom css -->
	 @yield("custom-css")
  <!-- end custom css -->

  <!-- start custom js -->
	 @yield("custom-js")
  <!-- end custom js -->

  <!-- start custom font -->
      <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">

  <!-- end custom font -->

  
</head>
<body token="{{csrf_token()}}">
	@yield("content")
</body>
</html>