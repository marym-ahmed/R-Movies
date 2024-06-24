<?php

namespace App\Traits;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait Reportable
{
    public function report($movie_id)
    {
        $report = DB::table('reports')
            ->where('movie_id', $movie_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$report) {
            $new_report = new Report;
            $new_report->movie_id = $movie_id;
            $new_report->user_id = Auth::user()->id;
            $new_report->report = 1;
            $new_report->save();
            return 1;
        } elseif ($report->report == 1) {
            DB::table('reports')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            return 0;
        } else {
            DB::table('reports')->where('movie_id', $movie_id)
                ->where('user_id', Auth::user()->id)
                ->update(['report' => 1]);
            return 1;
        }
    }
}
