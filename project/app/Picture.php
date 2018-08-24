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

	// Mutateurs
	public function getLinkAttribute($value) {
		return '/images/'.$value;
	}

	public function smallLink() {
		return preg_replace('/^(\/images\/)/', '$1s_', $this->link);
	}
}
