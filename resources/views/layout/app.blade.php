<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <meta name="author" content="Kapol Brondon, B. Lionel" />
    <title>@lang('_.app_name') | @yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link href='{{asset('/css/boxicons.min.css')}}' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    @yield('css')

    {{-- <script src="{{asset('js/bootstrap.min.js')}}" ></script> --}}
    <script src="{{ asset('/js/jquery.js')}}"  ></script>
    <script src="{{asset('js/chart.js')}}"></script>


</head>

<body>

    <nav class="navbar navbar-dark sticky-top bg-theme flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{route('dashboard')}}"> @lang('_.app_name') </a>
        <div class="sidebar-button text-white px-3">
            <i class='bx bx-menu sidebarBtn h3 '></i>
        </div>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">

                <div class="dropdown navbar-nav col-2" style="position: relative;">
                    <button class="btn btn-sm  btn-warning dropdown-toggle" type="button" id="menu_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="bx bx-user-circle h4 p-0 m-0"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" style="position: absolute; " aria-labelledby="menu_dropdown">
                      <li><a class="dropdown-item active" href="#">My Profile</a></li>
                      <li><a class="dropdown-item" href="#">Settings</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/lang/en">English</a></li>
                      <li><a class="dropdown-item" href="/lang/fr">Francais</a></li>
                      <li><a class="dropdown-item" href="/lang/de">Allemand</a></li>
                    </ul>
                  </div>
    </nav>

    <div class="container-fluid pl-1">
        <div class="row p-0">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block text-white sidebar collapse" >
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "dashboard" ? "active" : "" }}" aria-current="page" href="{{route('dashboard')}}">

                                <i class='bx bx-grid-alt'></i>
                                <span class="links_name"> @lang('_.dashboard') </span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "course" ? "active" : "" }}" href="{{route('course')}}">
                                <i class='bx bx-box'></i>
                                <span class="links_name"> @lang('_.course') </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "students" ? "active" : "" }}" href="{{route('students')}}">
                                <i class='bx bx-list-ul'></i>
                                <span class="links_name">@lang('_.members')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "analytics" ? "active" : "" }}" href="{{route('analytics')}}">
                                <i class='bx bx-pie-chart-alt-2'></i>
                                <span class="links_name">@lang('_.analytics')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "trainers" ? "active" : "" }}" href="{{route('trainers')}}">
                                <i class='bx bx-coin-stack'></i>
                                <span class="links_name">@lang('_.trainer')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == "calendar" ? "active" : "" }}" href=" {{route('calendar')}} ">
                                <i class='bx bx-book-alt'></i>
                                <span class="links_name">@lang('_.calendar')</span>
                            </a>
                        </li>
                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span> ----- </span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class='bx bx-user'></i>
                                <span class="links_name">@lang('_.team')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class='bx bx-message'></i>
                                <span class="links_name">@lang('_.messages')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class='bx bx-heart'></i>
                                <span class="links_name">@lang('_.favrorites')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class='bx bx-log-out'></i>
                                <span class="links_name">@lang('_.signout')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">


                @yield('main')
            </main>
        </div>
    </div>




    <script src="{{asset('js/feather.min.js')}}">  </script>
    {{-- <script src="{{asset('js/dashboard.js')}}"></script> --}}



    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        let main = document.querySelector("main");
        sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
                main.classList.toggle("wide");

                if (sidebar.classList.contains("active")) {
                    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");

                } else
                    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");


        }


    </script>


<script src="{{ asset('/js/bootstrap.min.js') }}"  ></script>
<script src="{{ asset('/js/jquery.validate.js') }}"  ></script>
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"  ></script>
<script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"  ></script>

@yield('scripts')
</body>

</html>
