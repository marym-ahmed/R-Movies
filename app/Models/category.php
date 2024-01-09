<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\movie;

class category extends Model
{
    use HasFactory;
    protected $fillable = [ 'category'];


    public function movie()
    {
        return $this->hasMany(movie::class);
    }
}
