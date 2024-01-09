<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report Comment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/movieStyle/reportedMovies.css') }}">


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
                    <li class="nav-item"id ="cat">
                        <a class="nav-link" href="{{ route('categories.index') }}">category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movie.index') }}">Home</a>

                    </li>



                    @endguest
                </ul>


                @if(Auth::user()->role == 0)

                <div class="ms-1  tooltipParent">
                    <span class="tooltipText">Create New Movie</span>
                    <a class="btn btn-success addMovie" href="{{ route('movie.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>

                @endif
                <ul class="navbar-nav ms-autdo mb-2 mb-lg-0">

                    <li class=" navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                        <button class="btn btn-outline-danger ms-1 w-100" type="submit">Delete Your Account</button>
                                    </form>
                                </span></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <h2>  
        <span>R</span>
        <span>e</span>
        <span>p</span>
        <span>o</span>
        <span>r</span>
        <span>t</span>
        <span>s</span>
        <span>C</span>
        <span>o</span>
        <span>m</span>
        <span>m</span>
        <span>e</span>
        <span>n</span>
        <span>t</span>
            </h2>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered w-50 text-center m-auto mt-2" style="border-color:#c6a991;">
                    <thead >
                        <tr>
                            <th>Comments</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($comment as $comment)
                        <tr>
                            @php
                            $report_count = 0;
                            @endphp

                            @foreach ($comment->report as $report)
                            @php

                            {if ($report->report == 1)
                            $report_count++;
                            }



                            @endphp




                            @endforeach
                            @if($report_count >= 1)
                            <td>
                                {{$comment->comment}}

                            </td>

                            <td>
                            
                            
                                <a id="deletebtn" href="{{ route('deletecomment', $comment->id)}}" class="btn btn-outline-danger"><i type="submit" class="fa-solid fa-trash-can"></i></a>
                                <a id="cbtn" href="{{ route('destroycomment', $report->comment_id)}}" class="btn btn-outline-primary"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
