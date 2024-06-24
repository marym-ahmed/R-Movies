<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function create(array $data)
    {
        return $this->comment->create($data);
    }

    public function find($id)
    {
        return $this->comment->find($id);
    }

    public function delete($id)
    {
        $comment = $this->find($id);
        return $comment->delete();
    }

    public function getCommentsByMovieId($movie_id)
    {
        return $this->comment->where('movie_id', $movie_id)->get();
    }
}
