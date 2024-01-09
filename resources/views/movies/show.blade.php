<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Movie Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('CSS/comments/commentadd.css') }}">
<style>
.navbar-brand{
    color :#A27B5C;
    font-size: larger;
    font-weight: bold;
    font-family: cursive;
    padding-top:15px;
    margin-left: 30px;
    
}

.navbar-brand:hover{
    color: #A27B5C;
}

#navbar
                {display: flex;
                    position: sticky;
                    top: 0;
                    background-color:#171717;
                    color: #fff;
                    justify-content: space-between;
                    padding: irem;
                    z-index: 1;
                    height: 70px;
                    margin-bottom: 40px;
                }
               #navbar ul{
                display: flex;
                list-style: none;
                align-items: center;
               }
                #navbar ul li a 
                {
                    font-weight: bold;
                    font-family: cursive;
                    color: #A27B5C;
                    border-radius: 10px;
                    font-size: 20px;
                    text-decoration: none;
                    padding-right: 20px;
                }
                #navbar ul li :hover{          
                    color: #DCD7C9;
                }
               .mains{
                
                    background-color:#205375;

                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: 100000px  150000px;
                
                    
                    
                }     
                #addcomment{ display: flex;


                }
                #addcomment:hover{
                    border-radius: 200px;
                    color: black;
                    background-color:#A27B5C;    
                
                }
                 #addcomment 
                {
                    font-weight: bold;
                    font-family: cursive;
                    color: white;
                    border-radius: 10px;
                    font-size: 20px;
                    margin :0 .25px;
                    margin-left: 190px;
                    text-decoration: none;
               
                }
                
#comment{
    margin-top: 50px;
}


body{
    background-color: #171717;
    overflow: auto;
    overflow-x: hidden;
}

.rating {
    text-indent: 220px ;
    margin-left: -220px;
    display: inline-block;
    color: #A27B5C;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
}

label{
    font-size: 3em;
}




h1{
    margin-left: 220px;
    color: #C5A880;
    margin-top: -250px;
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

h3 {
   font-size:larger;
    padding-left: 220px;
    padding-top: 10px;
    color: #d7c3b3;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
a{
    margin-left: 200px;
}


.name{
    color: #A27B5C;
    margin-left: 30px;
    font-family: 'Times New Roman', Times, serif;
    font-size: large;
    font-weight: bold;
}


p{
    margin-left: 30px;
}
svg {
    color: #A27B5C;
    margin-left: 230px;
   }

.rate {
 color: #A27B5C;
 font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
iframe{
 width: 670px;
 height: 300px;
 margin-left: 395px;
 margin-top:100px;
}
</style>
</head>

<body>


<nav id="navbar">

<a class="navbar-brand" >StarMovies</a>
                   
             <ul id="link" >
            
                <li><a href="{{ route('movie.index') }}">Home</a></li>
                
             </ul>
            </nav>
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div  >
                        <div class="card-body p-4">
            <br>
            <img src="{{ asset('images/'. $movies->img_url) }}" class=" w-40 mb-8 shadow-xl" width="200" height="250" style="border-radius: 10px" />
            <h1 > {{$movies->name}} </h1>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                    <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z"/>
                                  </svg>
                                  @if($movies->ranking < 0) 
                                  <span class="rate"> 0 %</span>
                                  @else
                                <span class="rate"> {{ $movies->ranking *100  }} %</span>
                                  @endif
            <h3 > {{$movies->descrption}} </h3>
            <br> <br><br>
            
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
                </div>
            </div>
                </div>
            </div>

            <iframe src="{{ asset('videos/'. $movies->video) }}"></iframe>
 
            

 <div class="main">
    

    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div  >
                <div class="card-body p-4">
                    <form action="{{route('comment',$movies->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Write A Comment..."></textarea>
                            </div>
                            @error('comment')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <button class="btn btn-outline-secondary" id="addcomment" type="submit">Add Comment</button>
                        </div>
                        <div class="mains">
                    </form>
                    @foreach($movies->comment as $comment)
                    <div class="card mb-4" id="co">
                    <div class="director mt-3">
                            @php
                            $users = App\Models\User::find ($comment->user_id );
                            @endphp
                          
                        <span class="name"> {{$users->name}} </span>
                        <span class="name"> {{$comment->created_at}} </span>
                        </div>
                        <div class="card-body">
                            <p>{{$comment->comment}}</p>
                            <div class="d-flex justify-content-between">
                                <!-- <div class="d-flex flex-row align-items-center">
              @php
              $users = App\Models\User::find ($comment->user_id );
              @endphp
              <p class="small mb-0 ms-2"> {{$users->name}}</p>
              </div> -->

                                <div class="d-flex flex-row align-items-center">

                                

                                    @php
                                    $like_count=0;
                                    $dislike_count=0;

                                    $like_satatus = "btn-secondry";
                                    // $report_count = 0;
                                    // $report_satatus = "btn-secondry";
                                    $dislike_satatus = "btn-secondry";
                                    @endphp
                                    @foreach ($comment->likes as $like)
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
                                    $like_satatus = "btn-success";


                                    }
                                    if($like->like == 0 && $like->user_id == Auth::user()->id)
                                    {
                                    $dislike_satatus = "btn-danger";
                                    }

                                    }



                                    @endphp
                                    @endforeach
                                    @php
                                    $report_satatus = "btn-secondry";
                                    $report_count=0;
                                    @endphp

                                    @foreach ($comment->report as $report)
                                    @php
                                    {if ($report->report == 1)
                                    $report_count++;
                                    }

                                    if (Auth::check())
                                    {

                                    if($report->report == 1 && $report->user_id == Auth::user()->id)
                                    {
                                    $report_satatus = "btn-danger";


                                    }
                                    if($report->report == 0 && $report->user_id == Auth::user()->id)
                                    {
                                    $report_satatus = "btn-secondry";
                                    $report_satatus = "btn-danger";
                                    }

                                    }
                                    @endphp
                                    @endforeach

                                    <td><button type="button" data-commentid="{{$comment->id}}_l" data-like="{{$like_satatus}}" class=" like btn {{$like_satatus}}">like
                                            <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="like_count"> {{$like_count}}</span></b></button></td>

                                    <td><button type="button" data-commentid="{{$comment->id}}_d" class=" dislike btn {{$dislike_satatus}}">Dislike
                                            <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="dislike_count">{{$dislike_count}}</span></b></button></td>

                                    <td><button type="button" data-commentid="{{$comment->id}}_r" data-report="{{$report_satatus}}" class=" report btn {{$report_satatus}}">report
                                            <span class="glyphicon glyphicon-thumbs-up "></span><b> <span class="report_count">{{$report_count}}</span></b></button></td>


                                    <tr>

                                </div>
                                    @if($comment->user_id == Auth::user()->id )
                                    <td>
                                        <a href="{{ route('deletecomment', $comment->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                    @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
                                </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('likeComment')}}';
        var url_dis = '{{ route('dislikeComment') }}';
        var report = '{{ route('reportComment') }}';
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('js/commentlike.js') }}"></script>

 </div>
</body>

</html>
