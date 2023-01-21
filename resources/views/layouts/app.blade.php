<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('invoices/lang.invoice_system') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    {{-- my additions --}}
    {{-- fontawsome --}}
    <link rel="stylesheet" href="{{asset("frontend/css/fontawsome/all.min.css")}}">
    @yield('css')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
    `

    @if (config('app.locale') == 'ar')
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-rtl.css')}}">
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div class="navbar-nav {{config('app.locale') == 'ar' ? 'me-auto' : "ms-auto"}}">
                        <!-- Authentication Links -->
                        <a class="nav-link" href="{{route('changelocale' , 'ar')}}" class="text-light" >
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-globe"></i>ar
                            </button>
                        </a>
                        <a class="nav-link" href="{{route('changelocale' , 'en')}}" class="text-light" >
                            <button class="btn btn-secondary btn-sm text-light">
                                en
                            </button>
                        </a>
                        
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mt-3">
            @yield('content')
        </main>
    </div>
     {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <scrip src="{{ asset('frontend/js/fontawesome/all.min.js') }}"></scrip>
    @yield('scripts')
</body>
</html>
