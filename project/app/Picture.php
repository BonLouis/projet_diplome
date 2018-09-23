<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\{ Post };

class Picture extends Model
{
	protected $fillable = ['link', 'post_id', 'title'];
    // maybe optional ?
	public function post () {
		return $this->belongsTo(Post::class);
	}
	// Mutateurs
	public function getLinkAttribute($value) {
		// dd(request()->getBaseUrl());
		return url('/images/posts').'/'.$value;
	}
}
