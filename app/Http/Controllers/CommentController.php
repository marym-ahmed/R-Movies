<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\comment;
use App\Models\movie;
use App\Models\User;
use App\Models\Pan;
use App\Models\review;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{


    
    public function store(Request $request, $id){

        $request->validate([
            'comment'=> 'required|min:4',
        ]);

        $data = new comment;
        $data->user_id = $request->user()->id;
        $user_id=$data->user_id;

        $data->movie_id = $id;
        $movie_id=$data->movie_id;

        $data->comment = $request->comment;
        $allcomments=$data->comment;

        $response = Http::post('http://127.0.0.1:5000/ranking?movie_id='.$movie_id.'&user_id='.$user_id.'&comment='.$allcomments);


        $Positive = 0 ;
       $x = 0;
        $y =0 ;
     $Negative = 0 ;
    $allComment = 0;
   $rank= 0;
       $comments= comment::where('movie_id' ,'=',  $data->movie_id )->get();
       foreach ($comments as $comment){

           $allComment += 1  ;
        if ($comment->value > 0){
           $Positive += $comment->value ;

        }

        elseif ($comment->value < 0){
           $Negative += $comment->value ;
        }

          }

          if(  $allComment > 0){
        $x =  $Positive / $allComment;
        $y = $Negative / $allComment;
        $rank = $x + $y;
       }
    $movies =movie::where('id' , $data->movie_id)->first();
    $movies->ranking = $rank;
    $movies->save();

        return redirect()->back();

    }
    // public function remove($id)
    // {
    //     $comment = comment::find($id);
    //     $comment->delete();
    //     return redirect()->back();
    // }
    public function remove($id)
    {
        $comment = comment::find($id);
        $comment->delete();
        $Positive = 0 ;
       $x = 0;
        $y =0 ;
     $Negative = 0 ;
    $allComment = 0;
   $rank= 0;
       $comments= comment::where('movie_id' ,'=',  $comment->movie_id )->get();
       foreach ($comments as $comment){

           $allComment += 1  ;
        if ($comment->value > 0){
           $Positive += $comment->value ;

        }

        elseif ($comment->value < 0){
           $Negative += $comment->value ;
        }

          }

          if(  $allComment > 0){
        $x =  $Positive / $allComment;
        $y = $Negative / $allComment;
        $rank = $x + $y;
       }
    $movies =movie::where('id' , $comment->movie_id)->first();
    $movies->ranking = $rank;
    $movies->save();

        return redirect()->back();}


    public function like(Request $request)
    {
        $comment_id = $request->comment_id;
        $like_s = $request->like_s;
        $change_like = 0;
        $like = DB::table('reviews')
        ->where('comment_id',$comment_id)
        ->where('user_id', Auth::user()->id)
        ->first();
        if(!$like){

            $new_like = new review;

            $new_like->comment_id = $comment_id;
            $new_like->user_id = Auth::user()->id;
             $new_like->like = 1;
            $new_like->save();
            $is_like = 1;

        }
        elseif($like->like == 1){
         DB::table('reviews')->
         where('comment_id',$comment_id)
         ->where('user_id', Auth::user()->id)
         ->delete();
         $is_like = 0;
        }
        elseif($like->like == 0)
        {
            DB::table('reviews')->
            where('comment_id',$comment_id)
            ->where('user_id', Auth::user()->id)
            ->update(['like' => 1]);
            $is_like = 1;
            $change_like = 1;

}
$response = array(
    'is_like' =>  $is_like,
    'change_like' => $change_like,
);
return response()->json($response , 200);
}

///disLike

public function dislike(Request $request)
{
    $comment_id = $request->comment_id;
    $like_s = $request->like_s;
    $change_dislike= 0;
    $dislike = DB::table('reviews')
    ->where('comment_id',$comment_id)
    ->where('user_id', Auth::user()->id)
    ->first();
    if(!$dislike){

        $new_like = new review;
        $new_like->comment_id = $comment_id;
        $new_like->user_id = Auth::user()->id;
         $new_like->like = 0;
        $new_like->save();
        $is_dislike= 1;

    }
    elseif($dislike->like == 0){
     DB::table('reviews')->
     where('comment_id',$comment_id)
     ->where('user_id', Auth::user()->id)
     ->delete();
     $is_dislike = 0;
    }
    elseif($dislike->like == 1)
    {
        DB::table('reviews')->
        where('comment_id',$comment_id)
        ->where('user_id', Auth::user()->id)
        ->update(['like' => 0]);
        $is_dislike = 1;
        $change_dislike= 1;
}
$response = array(
'is_dislike' =>  $is_dislike,
'change_dislike' => $change_dislike,

);
return response()->json($response , 200);
}




public function report(Request $request)
{
    $comment_id = $request->comment_id;
    $like_s = $request->like_s;
    $report = DB::table('pans')
    ->where('comment_id',$comment_id)
    ->where('user_id', Auth::user()->id)
    ->first();
    if(!$report){

        $new_report = new Pan;

        $new_report->comment_id = $comment_id;
        $new_report->user_id = Auth::user()->id;
         $new_report->report = 1;
        $new_report->save();
        $is_report = 1;

    }
    elseif($report->report == 1){
     DB::table('pans')->
     where('comment_id',$comment_id)
     ->where('user_id', Auth::user()->id)
     ->delete();
     $is_report = 0;
    }
    elseif($report->report == 0)
    {
        DB::table('pans')
        -> where('comment_id',$comment_id)
        ->where('user_id', Auth::user()->id)
        ->update(['report' => 1]);
        $is_report = 1;

}
$response = array(
'is_report' =>  $is_report,
);
return response()->json($response , 200);
}
public function reportedCommentes()
{
    $comment = comment::get();
        return view('comments.reportedCommentes', compact('comment'));

}

public function destroy($id)
    { 
        $report = DB::table('pans')->where('comment_id', '=', $id)->delete();    
        return redirect()->back();}

}
