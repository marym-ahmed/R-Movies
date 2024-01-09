<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('CSS/categoryStyle/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid ">
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
                   
                    
                    <li class="nav-item" id="home">
                        <a class="nav-link" href="{{ route('movie.index') }}">Home</a>

                    </li>

                    @endguest
                </ul>

                <form action="{{ route('categorysearch') }}" method="GET" class="d-flex" role="search">
                    <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Category..." name="search" required>

                    <!-- <button class="btn btn-outline-success ms-2" type="submit">Search</button> -->
                </form>
                @if (Auth::user()->role == 1)
                <div class="ms-1  tooltipParent">
                    <span class="tooltipText">Create New Category</span>
                    <a class="btn btn-success" href="{{ route('categories.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
                @endif
                <ul class="navbar-nav ms-autdo mb-2 mb-lg-0">

                    <li class=" navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </a>
                        <ul class="dropdown-menu  mr-5">
                            <li> <a class="dropdown-item" href="{{ route('signout') }}">Logout</a></li>
                            <li>
                                <a class="dropdown-item" href="{{route('edit-user',auth()->id()) }}">Edit Your Account</a>
                            </li>
                            <li><span class="dropdown-item w-100">
                                    <form action="{{ route('deleteAcount', auth()->id())}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger ms-1 w-100" type="submit">Delete Your Account</button>
                                    </form>
                                </span></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="containerCategory mt-2 text-center">
        <div class="row">
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>


                    <th width="500px">Category Name</th>
                    @if (Auth::user()->role == 1)

                    <th width="280px">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>


                    <td>{{ $category->category }}</td>
                    @if (Auth::user()->role == 1)
                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
                            <button id="editbtn" type="button" class="btn btn-outline-info" href="{{ route('categories.edit',$category->id) }}"><i class="fa-solid fa-pen-to-square"></i></button>
                            @csrf
                            @method('DELETE')

                            <button id="deletebtn" class="btn btn-outline-danger"> <i type="submit" class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

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
<!-- <form  action="{{ route('categorysearch') }}" method="GET">
                <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Category..." name="search" required/>
            </form> -->
