<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">I&M</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('books.index')}}">Libri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('books.create')}}">Crea</a>
          </li>
          @auth
          
            <li class="nav-item">
              <a href="{{route('dashboard')}}" class="nav-link">
                Dashboard
              </a>
            </li>
          @endauth
        </ul>
        
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <ul  class="navbar-nav mb-2 mb-lg-0 me-2">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->name}}
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profilo</a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item">LogOut</button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
          @guest
            <li class="nav-item">
              <a href="{{route('login')}}" class="nav-link">Accedi</a>
            </li>
            <li class="nav-item">
              <a href="{{route('register')}}" class="nav-link">Registrati</a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>