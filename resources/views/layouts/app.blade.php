<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="/images/logo2.jpeg" rel="icon">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-primary shadow-sm" style="background-color: #198754; color:white">
            
           
                {{-- <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> --}}
                    {{-- <a href="/" class="d-flex mb-3 mb-md-0 me-md-auto">
                        <img src="images/bulb.jpg" class="img" width="40" height="32">
                      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                      <span class="fs-4" style="color:white">Veritas IoT Cloud</span>
                    </a> --}}
                {{-- </header> --}}
                
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                    {{-- {{ config('app.name', 'Laravel') }} --}}<img src="images/veritasIoT.png" class="img" width="100" height="100"><span>Veritas IoT Cloud Platform</span></br>
                    {{-- <span style="font-size: 12px">Divine Ayambem IoT Project</span> --}}
                </a>

                <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                    {{-- {{ config('app.name', 'Laravel') }} --}}<span></span>
                    {{-- <span style="font-size: 12px">Divine Ayambem IoT Project</span> --}}
                </a>

                

                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('website')}}" style="color:white; font-weight:bolder">{{ __('Home') }}</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color:white; font-weight:bolder">{{ __('Login') }}</a>
                                </li>
                                
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color:white; font-weight:bolder">{{ __('Register') }}</a>
                                </li>
                                
                            @endif
                        @else
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}" style="color:white; font-weight:bolder">{{ __('Dashboard') }}</a>
                        </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/add_device" style="color:white; font-weight:bolder">{{ __('Add Device') }}</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:white; font-weight:bolder">{{ __('Analytics') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color:white; font-weight:bolder">
                                        {{ __('Logout') }}
                                    </a>
                            </li>

                            
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" 
                                aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="/home" style="color:#198754; font-weight:bolder">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> --}}

                                    

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
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    @include('/layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.3.js" 
    integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="{{ asset('jquery/jquery.js') }}"></script>
    @yield('page-script')
</body>
</html>



