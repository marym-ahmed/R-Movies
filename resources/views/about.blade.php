<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/about.css') }}">

</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <i id="star" class="fa-solid fa-star"></i>
            <a class="navbar-brand" >StarMovies</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item"id ="home">
                        <a class="nav-link" href="{{ route('movie.index') }}">Home</a>
                    </li>
                   
                    @if(Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('allUsers') }}">users</a>
                    </li>
                    @endif
                    @endguest
                </ul>
            
                <ul class="navbar-nav ms-autdo mb-2 mb-lg-0">

                    <li class=" navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </a>
                        <ul class="dropdown-menu dropdown-menuu mr-5">
                            
                            
                            <li>
                                <a class="dropdown-item" href="{{route('edit-user',auth()->id()) }}">Edit Your Account</a>
                            </li>
                            @if (Auth::user()->role== 1)

                            <li>
                                <a class="dropdown-item" href="{{ route('reportedMovies') }}">Reported Movies </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('reportedCommentes') }}"> Reported Commentes </a>
                            </li>
                            @endif
                            <li> <a class="dropdown-item" href="{{ route('signout') }}">Logout</a></li>
                            <li><span class="dropdown-item w-100">
                                    <form action="{{ route('deleteAcount', auth()->id())}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger ms-1 w-100" type="submit" style=" background-color:black">Delete Your Account</button>
                                    </form>
                                </span></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <div class="wrapper">
        <div class="bg"> About </div>
        <div class="fg"> About </div>
      </div>
          
      <div class="container">
    <h1>About star Movie Website</h1>
    <p>Welcome to our movie website! We are passionate about movies and aim to provide you with the best movie recommendations and information.</p>
    <p>Our website offers a wide range of features, including:</p>
    <ul>
      <li>Search for movies by title</li>
      <li>Personalized recommendations based on your preferences</li>
      <li>User ratings and reviews</li>
      <li>And much more!</li>
    </ul>
    <p>Feel free to explore our website and discover new movies to watch. If you have any questions or feedback, please don't hesitate to contact us.</p>
  </div>


        <div class="footer" >
            <div class="containars"  style="color:white;font-size: 20px; text-align: center;background: ;padding: 0;margin: 0; ">
                <h1 class="sweet-title">
                <span id="foot" data-text="Sweet">Star Movies</span>
                </h1>
                <a id="link" href="{{ route('movie.index') }}">Home</a>
                <a id="link" href="{{ route('about') }}">About</a>
                <a id="link" href="{{route('profile-user',auth()->id()) }}">My Movies</a>      
                <span class="copy" > &copy 2023 StarMovies. by fcaih students</span>      
            </div>     
           </div> 
    </div>
    
        </body>
    
    </html>