<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Serch Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/movieStyle/index.css') }}">

</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary "style="padding: 0%">
        <div class="container-fluid"id = "nav">
            <i id="star" class="fa-solid fa-star"style="padding: 0%"></i>
            <a class="navbar-brand">StarMovie</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                

               

                  <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 79%">
                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Welcome</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>


    

    <div class="container mt-2">
        <div class="row ">
            @if($movies->isNotEmpty())
            <h1 class="textm" id="textx">You Should Login First...</h1>
            @foreach ($movies as $movie)
          
            <div class="col-md-3 tex  mt-2 ">
                <div class="card">

                    <div class="  poster ">

                        <img class="mimg" src="{{ asset('images/'. $movie->img_url) }}" />
                    </div>

                    <div class="details ">
                        <div class="Name movieName">
                            <h2>
                                {{ $movie->name }}
                            </h2>
                            @if ($movie->ranking == 0 )
            <div class="rating">
                <label >☆☆☆☆☆</label>
              </div>
              @elseif (  $movie->ranking < 0.3 && $movie->ranking > 0)
   <div class="rating">
    <label >★☆☆☆☆</label>
  </div>
@elseif ( $movie->ranking < 0.5 && $movie->ranking > 0.2)
<div class="rating">
    <label >★★☆☆☆</label>
  </div>
  @elseif (  $movie->ranking == 0.5)
<div class="rating">
    <label >★★✭☆☆</label>
  </div>
  @elseif (  $movie->ranking > 0.5 && $movie->ranking < 0.8)
  <div class="rating">
      <label >★★★☆☆</label>
    </div>
    @elseif (  $movie->ranking > 0.7 && $movie->ranking < 1)
  <div class="rating">
      <label >★★★★☆</label>
    </div>
    @elseif (  $movie->ranking == 1)
  <div class="rating">
      <label >★★★★★</label>
    </div>
    @else
    <div class="rating">
        <label >☆☆☆☆☆</label>
      </div>
@endif
                        </div>
                        <div class="category">
                            @php
                            $category = App\Models\category::find ($movie->category_id);
                            @endphp
                            {{$category->category}}
                        </div>
                        <div class="director mt-3">
                            @php
                            $users = App\Models\User::find ($movie->users_id );
                            @endphp
                            <span>Directed by</span>
                            {{$users->name}}
                        </div>
                        <div class="info">

                            {{ $movie->descrption}}
                        </div>

                    </div>
                   
                </div>
                
            </div>
           
            @endforeach
            @else 
            <div>
                <h2 class="nom">No Movies Found</h2>
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
</body>

</html>