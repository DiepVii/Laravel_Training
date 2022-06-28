<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('view/css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('view/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('view/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('view/css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('view/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('view/css/style.css') }}" />
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="{{ route('employee.index') }}"><img src="{{ asset(Auth::user()->image) }}"
                        class="img logo rounded-circle mb-3" alt=""></a>
                <div class="mb-3 text-info text-center">{{ Auth::user()->name }}</div>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Information</a>
                            </li>
                            <li>
                                <a href="">Contact</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">Sign out</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('list_borrow_equipment', ['id' => Auth::user()->id]) }}">Borrow</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Equipment</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            @foreach ($type as $type_value)
                                <li>
                                    <a
                                        href="{{ route('show_equipment', ['id' => $type_value->type_id]) }}">{{ $type_value->type_name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>

                </ul>

                <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
                            </li>
                            <div class="input-group">
                                <div class="form-outline">
                                    <input id="search-focus" type="search" id="form1" class="form-control" />
                                    <label class="form-label" for="form1">Search</label>
                                </div>
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </ul>



                    </div>
                </div>
            </nav>
            @yield('content')

        </div>
    </div>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- <script src="{{ asset('view/js/jquery.min.js') }}"></script>
    <script src="{{ asset('view/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('view/js/slick.min.js') }}"></script>
    <script src="{{ asset('view/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('view/js/jquery.zoom.min.js') }}"></script>
    {{-- <script src="{{ asset('view/js/main.js') }}"></script> --}}
</body>

</html>
