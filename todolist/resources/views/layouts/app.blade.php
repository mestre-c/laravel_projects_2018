<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TodoList</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('inc.navbar')
         <div class="container mt-3">
           @include('inc.messages')
            @yield('content')
         </div>

         <footer id="footer" class="text-center mb-5">
           <p>Copyright &copy; 2018 TodoList</p>
         </footer>
  </body>
</html>
