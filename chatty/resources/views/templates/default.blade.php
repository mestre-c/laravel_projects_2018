<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
     <link href='https://fonts.googleapis.com/css?family=Raleway:400,80' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/chatty.css">
    <title>Chatty - Laravel 5.6</title>
</head>
<body>
	@include('templates.partials.navigation')
		
		<div class="container">
      @include('templates.partials.alerts')
			@yield('content')

			<div class="jumbotron">
            <!-- <h1><i class="fas fa-camera-retro"></i> The Image Galery</h1> -->
            <h1><i class="fas fa-chart-line"></i> Chatty</h1>
            <p class="lead">The best social network wesite! Just enjoy!</p>
        </div>
        <!-- <div class="row">
          <div class="col-lg-4 col-sm-6">
            <img id="img-1" src="http://i.imgur.com/qK42fUu.jpg"  class="img-thumbnail mt-4 img-1"> 
          </div>
          <div class="col-lg-4 col-sm-6">
            <img src="https://images.unsplash.com/photo-1493838952631-2bce5dad8e54?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=2c657455b24166fe47c308fc1d64866c&auto=format&fit=crop&w=500&q=60"  class="img-thumbnail mt-4 img-1"> 
          </div> 
          <div class="col-lg-4 col-sm-6">
            <img id="img-3" src="https://images.unsplash.com/photo-1520541868116-c0480187f063?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=7328f2be2de3db64263b0f2071e962e2&auto=format&fit=crop&w=500&q=60"  class="img-thumbnail mt-4 img-1"> 
          </div> 
          <div class="col-lg-4 col-sm-6">
            <img id="img-7" src="https://images.unsplash.com/photo-1515876879333-013aa5ea1472?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=51bf94a18f987f09dc76bb3dbbf4df3b&auto=format&fit=crop&w=500&q=60"  class="img-thumbnail mt-4 img-1"> 
          </div> 
          <div class="col-lg-4 col-sm-6">
            <img src="https://images.unsplash.com/photo-1495774539583-885e02cca8c2?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b4876c41d5e7585486007cab84b34512&auto=format&fit=crop&w=500&q=60"  class="img-thumbnail mt-4 img-1"> 
          </div>  
          <div class="col-lg-4 col-sm-6">
            <img src="https://images.unsplash.com/photo-1484861671664-4ebd42ced711?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=edaea47be38e4f018961ee62b214fe32&auto=format&fit=crop&w=750&q=80"  class="img-thumbnail mt-4 img-1"> 
          </div>
        </div> -->
		</div>



<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>