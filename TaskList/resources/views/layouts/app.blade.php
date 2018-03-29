<!DOCTYPE html>
<html>
<head>
	<title>TaskList</title>
	<link rel="stylesheet" href="/css/app.css">
	<style>
		.container {
			margin-top: 55;
		}
	</style>
</head>
<body>
	@include('inc.navbar')
   <div class="container">
      @include('inc.messages')

   	  @yield('content')
   </div>

   <footer id="footer" class="text-center">
   	<p>Capfer Copyright &copy; 2018 TaskList</p>
   </footer>
</body>
</html>