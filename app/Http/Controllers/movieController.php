<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\movie;
use App\Models\like;
use App\Models\report;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class movieController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportedMovies()
    {

        $movie = movie::get();
        return view('movies.reportedMovies', compact('movie'));
    }

    public function index()
    {
        $movies = movie::orderBy('ranking', 'desc')->limit(50)->paginate(10);
        // return view('movies.index', compact('movies'))
        //     ->with('category', category::all());
        return view('movies.index', ['movies' => $movies])->with('category', category::all());
    }
    public function MovieType($MovieType)
    {
        $category = category::where('id', '=', $MovieType)->first();
        // $movies = movie::where('category_id', $category->id)->paginate(8);
        // $movies = $movies->orderBy('ranking', 'desc')->limit(50)->get();
         $movies = movie::where('category_id','=' , $category->id )->orderBy('ranking', 'desc')->limit(10)->get();
        return view('categories.show', compact('movies'))->with('category', category::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create')->with('category', category::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'descrption' => 'required',
            'img_url' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
            'video' => 'required|file|mimetypes:video/mp4',

        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->img_url->extension();
        $request->img_url->move(public_path('images'), $newImageName);

        $myvideo = $request->video->getClientOriginalName();
        $request->video->move(public_path('videos'), $myvideo);

        movie::create([
            'name' => $request->name,
            'img_url' => $newImageName,
            'video' => $myvideo,
            'descrption' => $request->descrption,
            'category_id' => $request->category_id,
            'users_id' => Auth::user()->id
        ]);


        return redirect()->route('movie.index')->with('success', 'movie has been created successfully.');}
    /**
     * Display the specified resource.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */

    // public function show($movie)
    // {
    //     $movies = movie::find($movie);
    //     return view('movies.show', [
    //         'movies' => $movies,
    //     ]);
    // }
    public function show($movie)
    {
        $movies = movie::find($movie);
        return view('movies.show', [
            'movies' => $movies,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */








    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(movie $movie)
    {
        $movie->delete();
        return redirect()->route('movie.index')->with('success', 'movie has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */


    public function search(Request $request)
    {
        $search = $request->input('search');
        $movies = movie::query()->where('name', 'LIKE', "%{$search}%")->get();
        return view('movies.search', compact('movies'));
    }


    public function like(Request $request)
    {
        $movie_id = $request->movie_id;
        $like_s = $request->like_s;
        $change_like = 0;
        $like = DB::table('likes')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!$like) {

            $new_like = new like;

            $new_like->movie_id = $movie_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 1;
            $new_like->save();
            $is_like = 1;
        } elseif ($like->like == 1) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            $is_like = 0;
        } elseif ($like->like == 0) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 1]);
            $is_like = 1;
            $change_like = 1;
        }
        $response = array(
            'is_like' =>  $is_like,
            'change_like' => $change_like,
        );
        return response()->json($response, 200);
    }



    ////////////////////
    public function userMovie()
    {
        $id =  Auth::user()->id;

        $movies = movie::where('users_id', '=', $id)->get();
        return view('movies.userMovie', compact('movies'));
    }
    public function dislike(Request $request)
    {
        $movie_id = $request->movie_id;
        $like_s = $request->like_s;
        $change_dislike = 0;
        $dislike = DB::table('likes')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!$dislike) {

            $new_like = new like;
            $new_like->movie_id = $movie_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 0;
            $new_like->save();
            $is_dislike = 1;
        } elseif ($dislike->like == 0) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            $is_dislike = 0;
        } elseif ($dislike->like == 1) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 0]);
            $is_dislike = 1;
            $change_dislike = 1;
        }
        $response = array(
            'is_dislike' =>  $is_dislike,
            'change_dislike' => $change_dislike,

        );
        return response()->json($response, 200);
    }




    public function report(Request $request)
    {
        $movie_id = $request->movie_id;
        $like_s = $request->like_s;
        $report = DB::table('reports')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!$report) {

            $new_report = new report;

            $new_report->movie_id = $movie_id;
            $new_report->user_id = Auth::user()->id;
            $new_report->report = 1;
            $new_report->save();
            $is_report = 1;
        } elseif ($report->report == 1) {
            DB::table('reports')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            $is_report = 0;
        } elseif ($report->report == 0) {
            DB::table('reports')
                ->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['report' => 1]);
            $is_report = 1;
        }
        $response = array(
            'is_report' =>  $is_report,
        );
        return response()->json($response, 200);
    }
    public function vsearch(Request $request)
    {
        $search = $request->input('search');
        $movies = movie::query()->where('name', 'LIKE', "%{$search}%")->get();
        return view('movies.vsearch', compact('movies'));}

        public function profile($id)
    {
        $movies = DB::table('movies')->where('users_id', '=', $id)->get(); 
        return view('auth.show', [
            'movies' => $movies,
        ]);
    }

    public function likemovies($id)
    {
         $likes = DB::table('likes')->where('user_id', '=', $id)->get(); 
        return view('auth.likemovies', [
            'likes' => $likes,
        ]);}
 public function delete($id)
    { 
        $report = DB::table('reports')->where('movie_id', '=', $id)->delete();    
        return redirect()->back();}
}

