<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/movieStyle/create.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <i id="star" class="fa-solid fa-star"></i>
            <a class="navbar-brand"> StarMovies </a>
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
    <div class="box">

        <div class="borderLine"></div>
        

        <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
            <h2>Add New Movie</h2>
            @csrf
            <div class="inputBox">
                <input type="text" name="name" required="required" />
                <span>movie Name:</span>
                <i></i>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="inputBox">
                <input type="text" name="descrption" required="required">
                <span>movie descrption:</span>
                <i></i>
                @error('descrption')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="inputBox">

                <select name="category_id" id="category" placeholder="category">
                    <option disabled selected>select category of film</option>
                    @foreach($category as $category )
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>


                @error('category')
                <div class="error m-5">{{ $message }}</div>
                @enderror

            </div>
            <div class="photoBox position-relative ">
                <label for="photo" class="uploadBtn">
                    <i class="fa-solid fa-upload"></i>Upload Photo Of Movie
                </label>
                <input class="d-none" id="photo" type="file" name="img_url" value="Upload photo of film" />
                @error('img_url')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label>Select Video:</label>
                <input type="file" name="video" >
             </div>

            <div class="buttonBox mt-5">
                <a  href="{{ route('movie.index') }}"> Back</a>
                <button type="submit" class=" ml-3">Submit</button>
            </div>

        </form>
        
    </div>
    
</body>

</html>