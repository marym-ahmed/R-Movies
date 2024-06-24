<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait Actionable
{
    public function like($comment_id)
    {
        $like = DB::table('reviews')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$like) {
            DB::table('reviews')->insert([
                'comment_id' => $comment_id,
                'user_id' => Auth::user()->id,
                'like' => 1
            ]);
            return true;
        } elseif ($like->like == 0) {
            DB::table('reviews')
                ->where('comment_id', $comment_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 1]);
            return true;
        }

        DB::table('reviews')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->delete();
        return false;
    }

    public function dislike($comment_id)
    {
        $dislike = DB::table('reviews')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$dislike) {
            DB::table('reviews')->insert([
                'comment_id' => $comment_id,
                'user_id' => Auth::user()->id,
                'like' => 0
            ]);
            return true;
        } elseif ($dislike->like == 1) {
            DB::table('reviews')
                ->where('comment_id', $comment_id)
                ->where('user_id', Auth::user()->id)
                ->update(['like' => 0]);
            return true;
        }

        DB::table('reviews')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->delete();
        return false;
    }

    public function report($comment_id)
    {
        $report = DB::table('pans')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$report) {
            DB::table('pans')->insert([
                'comment_id' => $comment_id,
                'user_id' => Auth::user()->id,
                'report' => 1
            ]);
            return true;
        }

        DB::table('pans')
            ->where('comment_id', $comment_id)
            ->where('user_id', Auth::user()->id)
            ->delete();
        return false;
    }
}
