<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{ Post };

class Category extends Model
{
    public function post () {
    	return $this->belongsToMany(Post::class);
    }

    // Mutators

    public function getNameAttribute($value) {
    	return ucfirst($value);
    }
}
