<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TaskList</title>
	<link rel="stylesheet" href="/css/app.css">
	<style>
		.container {
			margin-top: 50;
		}
		#footer {
			margin-top: 15px;
			font-family: "Raleway", sans-serif;
			color: #007bff;
			font-size: 18px;

		}
		
	</style>
</head>
<body>
	@include('inc.navbar')
	<br>
   <div class="container">
      @include('inc.messages')

   	  @yield('content')
   </div>

   <footer id="footer" class="text-center">
   	<p>Capfer Copyright &copy; 2018 TaskList</p>
   </footer>
</body>
</html>