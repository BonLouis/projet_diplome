<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{ Post };

class Picture extends Model
{
    // maybe optional ?
	public function post () {
		return $this->belongsTo(Post::class);
	}
}
