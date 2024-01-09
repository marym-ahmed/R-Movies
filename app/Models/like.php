<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{


    public function movie()
    {
        return $this->belongsTo(movie::class);

    }


    public function user()
    {
        return $this->hasOne(User::class);
    }

}
