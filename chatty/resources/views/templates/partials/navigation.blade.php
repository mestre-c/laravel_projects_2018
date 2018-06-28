<!-- Navbar starts here -->
    
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        
  <a class="navbar-brand" href="#"><i class="fas fa-home"></i> Capfermedia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">About <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
           <!-- @if (Auth::check()) -->
          <li class="nav-item">
            <a class="nav-link" href="#">Timeline</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Friends</a>
          </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
     <!-- @endif -->

      <ul class="navbar-nav navbar-right">
          <!-- @if (Auth::check()) -->
        <li class="nav-item">
          <a class="nav-link" href="#">Dayle<!-- {{ Auth::user()->getNameOrUsername() }} --></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Update profile</a>
        </li>
        <li class="nav-item">
              <a class="nav-link" href="#">Sign out</a>
        </li>
            <!-- @else -->
      <li class="nav-item">
        <a class="nav-link" href="#">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sign In</a>
      </li>
      <!-- @endif -->
    </ul>
  </div>
 </div>
</nav> 