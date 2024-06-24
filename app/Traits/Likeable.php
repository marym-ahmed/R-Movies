<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait Likeable
{
    public function like($movie_id)
    {
        $like = DB::table('likes')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$like) {
            $new_like = new Like;
            $new_like->movie_id = $movie_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 1;
            $new_like->save();
            return 1;
        } elseif ($like->like == 1) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            return 0;
        } else {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 1]);
            return 1;
        }
    }

    public function dislike($movie_id)
    {
        $dislike = DB::table('likes')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$dislike) {
            $new_like = new Like;
            $new_like->movie_id = $movie_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 0;
            $new_like->save();
            return 1;
        } elseif ($dislike->like == 0) {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            return 0;
        } else {
            DB::table('likes')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 0]);
            return 1;
        }
    }
}
