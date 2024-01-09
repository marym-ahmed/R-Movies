<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descrption',
        'img_url'
        ,'category_id',
        'users_id',
        'video'
    ];

    public function category()
    {
        return $this->hasOne(category::class,'category_id');
    }


    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function report()
    {
        return $this->hasMany(report::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class);
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

}
