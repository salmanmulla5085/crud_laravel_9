<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">User Management</a>
    <div class="ms-auto">
      @if(!session()->has('user'))
        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
        <a class="btn btn-outline-light" href="{{ route('register') }}">Register</a>
      @else
        <a class="btn btn-outline-light" href="{{ route('logout') }}">Logout</a>
      @endif
    </div>
  </div>
</nav>
