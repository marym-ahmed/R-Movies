<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Search;
use App\Http\Requests\Movie\ActionMovieRequest;
use App\Repositories\MovieRepository;
use App\Traits\Likeable;
use App\Traits\Reportable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    use Likeable, Reportable;

    protected $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function reportedMovies()
    {
        $movies = $this->movieRepository->getAll();
        return view('movies.reportedMovies', compact('movies'));
    }

    public function index()
    {
        $movies = $this->movieRepository->getPaginated(50, 10);
        return view('movies.index', compact('movies'))->with('category', Category::all());
    }

    public function movieType($movieType)
    {
        $category = Category::find($movieType);
        $movies = $this->movieRepository->getByCategory($category->id, 10);
        return view('categories.show', compact('movies'))->with('category', Category::all());
    }

    public function create()
    {
        return view('movies.create')->with('category', Category::all());
    }

    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        $newImageName = time() . '-' . $validated['name'] . '.' . $request->img_url->extension();
        $request->img_url->move(public_path('images'), $newImageName);

        $myvideo = $request->video->getClientOriginalName();
        $request->video->move(public_path('videos'), $myvideo);

        $attributes = [
            'name' => $validated['name'],
            'img_url' => $newImageName,
            'video' => $myvideo,
            'descrption' => $validated['descrption'],
            'category_id' => $validated['category_id'],
            'users_id' => Auth::user()->id
        ];

        $this->movieRepository->create($attributes);

        return redirect()->route('movie.index')->with('success', 'Movie has been created successfully.');
    }

    public function show($movie)
    {
        $movie = $this->movieRepository->getById($movie);
        return view('movies.show', compact('movie'));
    }

    public function destroy(Movie $movie)
    {
        $this->movieRepository->delete($movie->id);
        return redirect()->route('movie.index')->with('success', 'Movie has been deleted successfully');
    }

    public function search( $request)
    {
        $validated = $request->validated();
        $search = $validated['search'];
        $movies = $this->movieRepository->searchByName($search);
        return view('movies.search', compact('movies'));
    }

    public function userMovie()
    {
        $movies = $this->movieRepository->getByUserId(Auth::user()->id);
        return view('movies.userMovie', compact('movies'));
    }

    public function like( ActionMovieRequest $request)
    {
        $movie_id = $request->movie_id;
        $is_like = $this->like($movie_id);

        return response()->json(['is_like' => $is_like], 200);
    }

    public function dislike(ActionMovieRequest $request)
    {
        $movie_id = $request->movie_id;
        $is_dislike = $this->dislike($movie_id);

        return response()->json(['is_dislike' => $is_dislike], 200);
    }

    public function report(ActionMovieRequest $request)
    {
        $movie_id = $request->movie_id;
        $is_report = $this->report($movie_id);

        return response()->json(['is_report' => $is_report], 200);
    }

    public function vsearch(Search $request)
    {
        $validated = $request->validated();
        $search = $validated['search'];
        $movies = $this->movieRepository->searchByName($search);
        return view('movies.vsearch', compact('movies'));
    }

    public function profile($movie)
    {
        $movies = $this->movieRepository->getByUserId($movie);
        return view('auth.show', compact('movies'));
    }

    public function likemovies($movie)
    {
        $likes = DB::table('likes')->where('user_id', $movie)->get();
        return view('auth.likemovies', compact('likes'));
    }

    public function delete($movie)
    {
        DB::table('reports')->where('movie_id', $movie)->delete();
        return redirect()->back();
    }
}
