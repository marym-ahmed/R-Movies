<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Repositories\CommentRepository;
use App\Traits\Actionable;
use App\Http\Requests\Comment\StoreCommentRequest;

class CommentController extends Controller
{
    use Actionable;

    protected $commentRepo;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function store(StoreCommentRequest $request, $id)
    {
        $data = [
            'user_id' => $request->user()->id,
            'movie_id' => $id,
            'comment' => $request->comment,
        ];

        $this->commentRepo->create($data);

        // Call the external API for ranking
        $response = Http::post('http://127.0.0.1:5000/ranking', [
            'movie_id' => $id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);

        $this->updateMovieRanking($id);

        return redirect()->back();
    }

    public function remove($id)
    {
        $comment = $this->commentRepo->find($id);
        $movie_id = $comment->movie_id;
        $this->commentRepo->delete($id);

        $this->updateMovieRanking($movie_id);

        return redirect()->back();
    }

    public function likeComment(Request $request)
    {
        $result = $this->like($request->comment_id);
        return response()->json(['success' => $result], 200);
    }

    public function dislikeComment(Request $request)
    {
        $result = $this->dislike($request->comment_id);
        return response()->json(['success' => $result], 200);
    }

    public function reportComment(Request $request)
    {
        $result = $this->report($request->comment_id);
        return response()->json(['success' => $result], 200);
    }

    protected function updateMovieRanking($movie_id)
    {
        $comments = $this->commentRepo->getCommentsByMovieId($movie_id);
        $positive = $comments->where('value', '>', 0)->sum('value');
        $negative = $comments->where('value', '<', 0)->sum('value');
        $allComment = $comments->count();

        $rank = 0;
        if ($allComment > 0) {
            $rank = ($positive / $allComment) + ($negative / $allComment);
        }

        $movie = Movie::find($movie_id);
        $movie->ranking = $rank;
        $movie->save();
    }

    public function reportedComments()
    {
        $comments = $this->commentRepo->all();
        return view('comments.reportedComments', compact('comments'));
    }

    public function destroy($id)
    {
        DB::table('pans')->where('comment_id', '=', $id)->delete();
        return redirect()->back();
    }
}
