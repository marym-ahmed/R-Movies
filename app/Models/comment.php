<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        'comment',
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function report()
    {
        return $this->hasMany(Pan::class);
    }

    public function likes()
    {
        return $this->hasMany(review::class);
    }

    public function movie()
    {
        return $this->hasOne(movie::class);
    }


}
