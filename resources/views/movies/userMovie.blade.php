
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add movie</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 9 CRUD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('movie.create') }}"> Create movie</a>
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                </div>
            </div>
        </div>
        <form  action="{{ route('moviesearch') }}" method="GET">
            <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Movie..." name="search" required/>
        </form>
    </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>

                    <th>Movies</th>
                    <th>des</th>
                    <th>Movies_imge</th>
                    <th>Category</th>
                    <th>report</th>
                    <th>like</th>
                    <th>dislike</th>
                    <th>report</th>

                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>

                        <td>{{ $movie->name }}</td>
                        <td>{{ $movie->descrption }}</td>
                        <td> <img
                            src="{{ asset('images/'. $movie->img_url) }}"
                            class="w-40 mb-8 shadow-xl" width="100" height="100"
                        /></td>
                        <td>   {{ $movie->created_at }}</td>

                        @php
                        $category = App\Models\category::find ($movie->category_id);
                        @endphp




    @php
        $like_count=0;
        $dislike_count=0;
        $like_satatus = "btn-secondry";

        $dislike_satatus = "btn-secondry";
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

    @foreach ($movie->report as $report)
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
  <td><button type="button" data-movieid="{{$movie->id}}_l" data-like="{{$like_satatus}}" class=" like btn {{$like_satatus}}">like
     <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="like_count"> {{$like_count}}</span></b></button></td>

  <td><button type="button" data-movieid="{{$movie->id}}_d"  class=" dislike btn {{$dislike_satatus}}">Dislike
 <span class="glyphicon glyphicon-thumbs-up "></span><b><span class="dislike_count">{{$dislike_count}}</span></b></button></td>

 <td><button type="button" data-movieid="{{$movie->id}}_r" data-report="{{$report_satatus}}" class=" report btn {{$report_satatus}}">report
    <span class="glyphicon glyphicon-thumbs-up "></span><b> <span class="report_count">{{$report_count}}</span></b></button></td>


                        <td>
                             <form action="{{ route('movie.destroy',$movie->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            <body>
        </table>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('like') }}';
      var url_dis = '{{ route('dislike') }}';
      var report = '{{ route('report') }}';
    </script>


<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script type="text/javascript" src="{{ url('js/like.js') }}"></script>
</body>
</html>
