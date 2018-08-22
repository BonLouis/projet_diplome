<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{ Post };

class Registration extends Model
{
    public function posts () {
    	return $this->belongsToMany(Post::class);
    }
}
