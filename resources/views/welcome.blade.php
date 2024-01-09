<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('CSS/Home/welcome.css')}}">

    <!-- Styles -->

</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed w-100 z-index-2">
        <div class="container-fluid">
            <a id="bar" class="navbar-brand" >StarMovies</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

           
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="pad">
                    <div class="container search-for-help mt-3">
                        <form action="{{ route('vsearch') }}" method="GET">
                            <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Movie..." name="search" />
                        </form>
                    </div>
                  </div>
                @if (Route::has('login'))
                <div class="navbar-nav  ms-auto">
                    
                    <a href="{{ route('login') }}" class="nav-link">Login</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endif
                    @endauth
                </div>
               

            </div>
            
        </div>
    </nav>
  

    <p class="cloud-text cloud-title">Star Movies</p>
   
 

</body>

</html>