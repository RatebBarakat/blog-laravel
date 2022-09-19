<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('imgs/logo.ico')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="{{asset('js/dark.js')}}"></script>
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
    @livewireStyles

</head>
  <body onload="load()">
    <div id="app">
      <nav class="navbar navbar-expand-sm">
        @guest
        <button  
        type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
          Login
        </button>
        
          
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                  <button type="button" 
                  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('login')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">email<span style="color:red">*</span></label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">password<span style="color:red">*</span></label>                        
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">login</button>
                      </div>
                </form>
              </div>
            </div>
          </div>
          @else
          <span class="dropdown loged pull-dropdown-menu-right">
            <button style="color: var(--white)" class="btn dropdown-menu-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{auth()->user()->name}}
            </button>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              @auth
              @if (auth()->user()->admin == 1)
              <a class="dropdown-item" href="/admin">admin</a>
              @endif
              @endauth
              <a class="dropdown-item" href="{{route('logout')}}" id="logout" class="hiden">logout</a>
            </ul>
          </span>
        @endguest
          <a class="navbar-brand text-lg" href="#">kab<span class="text-sm">birni</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse"
           data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" 
           aria-label="Toggle navigation">
           <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" 
           class="bi bi-list fa-10x" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
              </li>
              <li class="nav-item dropdown link-dropdown">
                  <div style="color: var(--white);margin-top: 2px;font-size: 16px;" class="btn btn-transparent dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                  </div>
                  <div class="dropdown-menu nav-dropdown" aria-labelledby="dropdownMenuButton">
                    @forelse ($categories as $category)
                        <a href="{{route('category',[$category->slug])}}" class="dropdown-item">{{$category->name}}</a>
                    @empty
                        no category
                    @endforelse
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
            </ul>
  
          </div>
          <label class="switch">
    <input type="checkbox">
    <span class="slider round"></span>
  </label>
        </nav>
      @yield('content')
    </div>
    <div id="loader" style="position: absolute;
    top: 50%;left: 50%;transform: translate(-50%,-50%)">
      <div style="background: var(--white) !important" class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
      </div>
    </div>
    <script>
    function load()
    {
         document.getElementById("app").style.display = "block";
         document.getElementById("loader").style.display = "none";
    }
    </script>
        <script>
          window.addEventListener('alert', event => { 
      Swal.fire({
    icon: event.detail.type,
    text: event.detail.message,
  })
  });
      </script>
    @yield('javascript')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    @livewireScripts
  </body>
</html>