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

    // Scopes

    public function scopePublished($query) {
        return $query->where('status', 'published');
    }
    public function scopeDraft($query) {
        return $query->where('status', 'draft');
    }
    public function scopeTrash($query) {
        return $query->where('status', 'trash');
    }
    public function scopeLast($query) {
    	$now = Carbon::now();
    	return $query->where('start_date', '', $now);
    }
}
