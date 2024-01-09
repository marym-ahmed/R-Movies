<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/movieStyle/index.css') }}">

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
                    @if(Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">category</a>
                    </li>
                  
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
                            <form action="{{ route('MovieType',$category->id) }}" method="Post">
                                @csrf
                                <li><a class="dropdown-item" href="{{ route('MovieType',$category->id) }}">{{$category->category }}</a></li>
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
        <div class="container search-for-help mt-3">
            <form action="{{ route('moviesearch') }}" method="GET">
                <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Movie..." name="search" />
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </a>
                        <ul class="dropdown-menu dropdown-menuu mr-5">
                            
                            @if (Auth::user()->role == 0)
                            <li>
                                <a class="dropdown-item" href="{{route('profile-user',auth()->id()) }}">Your Movies</a>
                            </li>
                            
                            @endif
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
    <!--  -->    
      
      

    <div class="allimg">
        <div class="carousel">
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
          <div class="carousel__face"></div>
        </div>
      </div>


<div class="allmovie"style="padding-left: 80px">
      <div class="conts">
        <div class="waviy">
            <span style="--i:1">A</span>
            <span style="--i:2">L</span>
            <span style="--i:3">L</span>
            <span style="--i:4">M</span>
            <span style="--i:5">O</span>
            <span style="--i:6">V</span>
            <span style="--i:7">I</span>
            <span style="--i:8">E</span>
            <span style="--i:9">S</span>
           </div>
      </div>
  </div>
  @php
  $mov = App\Models\movie::limit(50)->paginate(16);
  @endphp
        <div class="container mt-2">
            <div class="row ">
                @foreach ($mov as $movie)
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

                            @if(Auth::user()->role == 0)
                            <div class="d-flex feedbackBox">
                                @php
                                $like_count=0;
                                $dislike_count=0;
                                $like_satatus = "btn-secondary";
                                $dislike_satatus = "btn-secondary";
                                @endphp

                                @foreach ($movie->likes as $like)
                                @php
                                {if ($like->like == 1)
                                $like_count++;
                                }

                                {if ($like->like == 0)
                                $dislike_count++;

                                }
                                if (Auth::check())
                                {

                                if($like->like == 1 && $like->user_id == Auth::user()->id)
                                {
                                $like_satatus = "colorLike";


                                }
                                if($like->like == 0 && $like->user_id == Auth::user()->id)
                                {
                                $dislike_satatus = "colorDisLike";
                                }

                                }
                                @endphp
                                @endforeach
                                @php
                                $report_satatus = "btn-secondary";
                                $report_count=0;
                                @endphp

                                @foreach ($movie->report as $report)
                                @php
                                {if ($report->report == 1)
                                $report_count++;
                                }

                                if (Auth::check())
                                {

                                if($report->report == 1 && $report->user_id == Auth::user()->id)
                                {
                                $report_satatus = "colorReport";


                                }
                                if($report->report == 0 && $report->user_id == Auth::user()->id)
                                {
                                $report_satatus = "defaultColor";
                                $report_satatus = "colorReport";
                                }

                                }
                                @endphp
                                @endforeach
                                <div data-movieid="{{$movie->id}}_l" data-like="{{$like_satatus}}" class=" like  {{$like_satatus}}"><i class="fa-solid fa-thumbs-up likeBtn"></i>
                                    <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="like_count"> {{$like_count}}</span></b>
                                </div>
                                <div data-movieid="{{$movie->id}}_d" class="  dislike  {{$dislike_satatus}}"><i class="fa-solid fa-thumbs-down disLikeBtn"></i>
                                    <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="dislike_count">{{$dislike_count}}</span></b>
                                </div>
                                <div data-movieid="{{$movie->id}}_r" data-report="{{$report_satatus}}" class=" report flag  {{$report_satatus}}"><i class="fa-solid fa-flag"></i>
                                    <span class="glyphicon glyphicon-thumbs-up "></span><b> <span class="report_count">{{$report_count}}</span></b>
                                </div>
                                <div>
                                    @csrf
                                    <a href="{{ route('movie.show',$movie->id) }}"><i class="fa-solid fa-eye"></i></a>
                                </div>
                                @if (Auth::user()->role== 1)
                                <form action="{{ route('movie.destroy',$movie->id) }}" method="Post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endif

                            </div>


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


    <div >
    {{ $movies->links('pagination::bootstrap-4')}}
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



    @if($movies->currentPage() == 1 && $movies->perPage() == 10 )
                           
    <div class="top"style="padding-left: 80px">
      <div class="containars">
        <div class="waviy">
            <span style="--i:1">t</span>
            <span style="--i:2">o</span>
            <span style="--i:3">p</span>
            <span style="--i:4">10</span>
            &ensp; &ensp;
            <span style="--i:5">M</span>
            <span style="--i:6">O</span>
            <span style="--i:7">V</span>
            <span style="--i:8">I</span>
            <span style="--i:9">E</span>
            <span style="--i:10">S</span>
           </div>
      </div>

  </div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="home-demo">
  <div class="owl-carousel owl-theme">
  

    @foreach ($movies as $movie)
    <div class="item">
        <img id="img" src="{{ asset('images/'. $movie->img_url) }}" />
      <h2 id="mname">{{ $movie->name }}</h2>
      <h4 class="cat">
        @php
     $category = App\Models\category::find ($movie->category_id);
     @endphp
     {{$category->category}}
  </h4>
      <h6>
        @if ($movie->ranking == 0 )
        <div class="rating">
            <label id="st" >☆☆☆☆☆</label>
          </div>
          @elseif (  $movie->ranking < 0.3 && $movie->ranking > 0)
<div class="rating">
<label id="st">★☆☆☆☆</label>
</div>
@elseif ( $movie->ranking < 0.5 && $movie->ranking > 0.2)
<div class="rating">
<label id="st">★★☆☆☆</label>
</div>
@elseif (  $movie->ranking == 0.5)
<div class="rating">
<label id="st" >★★✭☆☆</label>
</div>
@elseif (  $movie->ranking > 0.5 && $movie->ranking < 0.8)
<div class="rating">
  <label id="st" >★★★☆☆</label>
</div>
@elseif (  $movie->ranking > 0.7 && $movie->ranking < 1)
<div class="rating">
  <label id="st" >★★★★☆</label>
</div>
@elseif (  $movie->ranking == 1)
<div class="rating">
  <label id="st">★★★★★</label>
</div>
@else
<div class="rating">
    <label id="st">☆☆☆☆☆</label>
  </div>
@endif
      </h6>
      
        <h4 class="name">
            @php
            $users = App\Models\User::find ($movie->users_id );
            @endphp
            <span>Directed by</span>
            {{$users->name}}
        </h4>
  
        <div id="eye">
            @csrf
            <a id="eye" href="{{ route('movie.show',$movie->id) }}"><i class="fa-solid fa-eye"></i></a>
        </div>
       
      <p class="des">{{ $movie->descrption}}</p>

    </div>
    @endforeach
@else

@endif
  </div>
</div>


<script>
   $(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items: 4,
    margin: 10,
    loop: false,
    nav: true
  });
});
</script>




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