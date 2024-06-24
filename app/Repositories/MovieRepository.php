<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{
    public function getAll()
    {
        return Movie::all();
    }

    public function getById($id)
    {
        return Movie::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Movie::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($attributes);
        return $movie;
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
    }
}
