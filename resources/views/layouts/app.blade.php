<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/fonts.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/main.min.css')}}" rel="stylesheet">

{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <!-- Custom styles for this template-->
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
    <!-- Custom fonts for this template-->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth()
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item nav-link"><a href="/admin">Admin</a></li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <!-- Nav Item - Notifications -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="btn nav-link dropdown-toggle " href="" id="alertsDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Notifications -->
                                    <span class="badge badge-danger badge-counter">{{auth()->user()->unReadNotifications->count()}}</span>
                                </a>
                                <!-- Dropdown - Notifications -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Notifications
                                    </h6>
                                    <hr>
                                    @if(auth()->user()->notifications->count() > 0)
                                        @foreach(auth()->user()->notifications()->paginate(4) as $notification)
                                        <a class="{{$notification->read_at === null ? 'bg-gray-200':''}} dropdown-item d-flex align-items-center" href="{{route('posts.show',$notification->data['post_slug'])}}">
                                            <div class="notification">
                                                <div class="small text-gray-500">{{$notification->created_at->toFormattedDateString()}}</div>
                                                <span class="font-weight-bold text-primary">{{$notification->data['name']}}</span>
                                                <span class="small text-gray-500">commented in your Post</span>
                                                <span class="font-weight-bold text-primary">{{$notification->data['post_title']}}</span>
                                            </div>
                                        </a>
                                            <hr>
                                        @endforeach
                                    @endif()
                                    <a class="dropdown-item text-center small text-gray-500" href="{{route('notifications')}}">Show All Notifications</a>
                                </div>
                            </li>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                                    <img class="img-profile rounded-circle" width="30px"
                                         src="{{asset('storage/'.auth()->user()->avatar)}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{route('users.profile',auth()->user()->username)}}" >
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    @if(request()->path() === '/')
                        <div class="col-md-3">
                            @yield('sidebar')
                        </div>
                    @endif
                    <div class=" {{request()->path() === '/' ? 'col-md-9' : 'col-md-12'}}">
                        @include('partials/alert')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="sticky-footer bg-gray-100" >
            <div class="container my-auto" >
                <div class="copyright text-center my-auto ">
                    <span>Copyright &copy;{{now()->year}}</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    @yield('scripts')
</body>
</html>
