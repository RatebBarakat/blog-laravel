<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    
    <title>@yield('title')</title>
    @yield('css')
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    input[type="search"]{
        margin-bottom: 10px;
    }
</style>
    @livewireStyles

  </head>
  <body id="app">
    <div class="wrapper">
        <!-- Sidebar  -->
            
            
        <nav id="sidebar" wire:ignore.self>
            <div class="sidebar-header">
                <h3>            
                    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">blog</a>
                </h3>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    {{-- <a href="#homeSubmenu" data-toggle="collapse"
                     aria-expanded="false" class="dropdown-toggle">Home</a> --}}
                    {{-- <ul class="collapse list-unstyled" id="homeSubmenu"> --}}
                        <li>
                            <a href="{{route('admin.categories')}}">categories [{{$category_count}}]</a>
                        </li>
                        <li>
                            <a href="{{route('admin.posts')}}">posts [{{$post_count}}]</a>
                        </li>
                        <li>
                            <a href="{{route('admin.comment.report')}}">comment-reports [{{$comment_report_count}}]</a>
                        </li>
                    {{-- </ul> --}}
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    {{-- <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul> --}}

            {{-- <ul class="list-unstyled CTAs"> --}}
                {{-- <li> --}}
                    {{-- <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                {{-- </li>
                <li> --}}
                    {{-- <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a> --}}
                {{-- </li> --}}
            {{-- </ul>  --}}
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-align-left"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" 
                        class="bi bi-list fa-10x" viewBox="0 0 16 16">
                           <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                         </svg>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" 
                    data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent"
                     aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                 
                </div>
            </nav>
    <div class="container-fluid">

               
        
            <!-- Page Content -->
            <div id="content" class="">
                @yield('content')
            </div>
        

        <div class="row">
            {{-- <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky" style="border-right: 1px solid #585858">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                      <i class="zmdi zmdi-widgets"></i>
                      Dashboard <span class="sr-only">(current)</span>
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-file-text"></i>
                      Orders
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-shopping-cart"></i>
                      Products
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-accounts"></i>
                      Customers
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-chart"></i>
                      Reports
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-layers"></i>
                      Integrations
                    </a>
                        </li>
                    </ul>
    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center pl-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <i class="zmdi zmdi-plus-circle-o"></i>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-file-text"></i>
                      Current month
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-file-text"></i>
                      Last quarter
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-file-text"></i>
                      Social engagement
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                      <i class="zmdi zmdi-file-text"></i>
                      Year-end sale
                    </a>
                        </li>
                    </ul>
                </div>
            </nav> --}}
        </div>
    </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('alert', event => { 
    Swal.fire({
  icon: event.detail.type,
  text: event.detail.message,
})
});
$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
