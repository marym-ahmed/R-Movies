<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/indexuser.css') }}">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movie.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">category</a>
                    </li>
                    @if(Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('allUsers') }}">users</a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        
                        <ul class="dropdown-menu">

                            @foreach ($category as $category)
                            <form action="{{ route('MovieType',$category->category) }}" method="Post">
                                @csrf
                                <li><a class="dropdown-item" href="{{ route('categorydetails',$category->id) }}">{{$category->category }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </form>
                            @endforeach

                        </ul>
                    </li>

                    @endif
                    @endguest
                </ul>
                 
                <div class="pad">
        <div class="container search-for-help mt-3" >
            <form action="{{ route('usersearch') }}" method="GET">
                <input id="search" class="form-control my-0 py-1 amber-border" type="text" placeholder="Search User..." name="search" />
            </form>
        </div>
      </div>
                @if(Auth::user()->role == 0)

                <div class="ms-1  tooltipParent">
                    <span class="tooltipText">Create New Movie</span>
                    <a class="btn btn-success addMovie" href="{{ route('movie.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>

                @endif
                <ul class="navbar-nav ms-autdo mb-2 mb-lg-0">

                    <li class=" navbar-nav nav-item dropdown">
                        <a id="setting" class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </a>
                        <ul class="dropdown-menu dropdown-menuu mr-5">
                            <li> <a class="dropdown-item" href="{{ route('signout') }}">Logout</a></li>
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
    <div class="container mt-2">
        <div class="row ">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if($users->isNotEmpty())
               
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>


                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($users as $user)
                    <tr>
                        @if ($user->role == 0)
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>

                    <td class="nav-item">
                        <form action="{{ route('deleteAcount', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button id="deletebtn" class="btn btn-outline-danger"> <i type="submit" class="fa-solid fa-trash-can"></i></button>
                          </form>
                        </td>


                    </tr>
                
                @endif
                    @endforeach
                    @else 
                    <div>
                        <h2 class="nom">user Not Found</h2>
                    </div>
                @endif
                </div>
    </div>
    
      
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
        </body> 
        </html>