<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/profile.css') }}">

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


    <h2>  
        <span>Y</span>
        <span>o</span>
        <span>u</span>
        <span>r</span>
        &nbsp;&nbsp;
        <span>M</span>
        <span>o</span>
        <span>v</span>
        <span>i</span>
        <span>e</span>
        <span>s</span>
            </h2>

            <div class="container mt-2">
                <div class="row ">
                    @foreach ($movies as $movie)
                    <div class="col-md-3 tex  mt-2 ">
                        <div class="card">
    
                            <div class="  poster ">
    
                                <img class="mimg" src="{{ asset('images/'. $movie->img_url) }}" />
                            </div>
    
                            <div class="details ">
                                <div class="Name movieName">
                                    <h3>
                                        {{ $movie->name }}
                                    </h3>
                                </div>
                                <div class="category">
                                    @php
                                    $category = App\Models\category::find ($movie->category_id);
                                    @endphp
                                    {{$category->category}}
                                </div>


                                @if (Auth::user()->role== 0)
                                <form action="{{ route('movie.destroy',$movie->id) }}" method="Post">
                                    <a id="editbtn" type="button" class="btn btn-outline-info" href="{{ route('movie.show',$movie->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    @csrf
                                    @method('DELETE')
        
                                    <button id="deletebtn" class="btn btn-outline-danger"> <i type="submit" class="fa-solid fa-trash-can"></i></button>
                                </form>
                                @endif
  
                                <div class="info">
    
                                    {{ $movie->descrption}}
                                </div>

                            </div>
    
                        </div>
    
                    </div>
    
                    @endforeach
    
                </div>
    
            </div>
        </div>
    
    
    
    
    
      
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            var token = '{{ Session::token() }}'
            var url = `{{ route('like')}}`
            var url_dis = `{{ route('dislike')}}`
            var report = `{{ route('report')}}`
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script type="text/javascript" src="{{ url('js/like.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/movie.js') }}"></script>
    
    
        
  <div class="footer" >
    <div class="containars"  style="color:white;font-size: 20px; text-align: center;padding: 0;margin: 0; ">
        <h1 class="sweet-title">
        <span id="foot" data-text="Sweet">Star Movies</span>
        </h1>
        <a id="link" href="{{ route('movie.index') }}">Home</a>
        <a id="link" href="{{ route('about') }}">About</a>
        <a id="link" href="{{route('profile-user',auth()->id()) }}">My Movies</a>      
        <span class="copy" > &copy 2023 StarMovies. by hasibat students</span>      
    </div>     
   </div> 
    </div>
    
        </body>
    
    </html>