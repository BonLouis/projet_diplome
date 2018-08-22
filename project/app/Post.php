<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{ Category, Picture, Registration };

class Post extends Model
{
    public function categories () {
    	return $this->belongsToMany(Category::class);
    }

    public function picture () {
    	return $this->hasOne(Picture::class);
    }

    public function registrations () {
    	return $this->belongsToMany(Registration::class);
    }
}
