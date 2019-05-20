<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Barthel Index</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Barthel Index
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                @if(Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('registerDoctor') }}">
                                        Register Doctor
                                    </a>
                                     <a class="dropdown-item" href="{{ route('registerPacient') }}">
                                        Register Pacient
                                    </a>
                                    <a class="dropdown-item" href="{{ route('registerAdministrator') }}">
                                        Register Administrator
                                    </a>
                                    <a class="dropdown-item" href="{{ route('findView') }}">
                                        Find User
                                    </a>        
                                @endif
                                @if(Auth::user()->hasRole('doctor'))
                                     <a class="dropdown-item" href="{{ route('registerPacient') }}">
                                        Register Pacient
                                    </a>
                                     <a class="dropdown-item" href="{{ route('makeTest') }}">
                                        Make Test
                                    </a>
                                    <a class="dropdown-item" href="">
                                        Appointments
                                    </a>
                                    <a class="dropdown-item" href="{{ route('find') }}">
                                        Search Pacient
                                    </a>
                                    <a class="dropdown-item" href="">
                                        View Results
                                    </a>                                                                          
                                @endif
                                @if(Auth::user()->hasRole('pacient'))
                                <a class="dropdown-item" href="">
                                        Appointments
                                </a>
                                <a class="dropdown-item" href="">
                                        View Result
                                </a> 
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <main class="py-4">
            @yield('main')
        </main>
    </div>
</body>
</html>
