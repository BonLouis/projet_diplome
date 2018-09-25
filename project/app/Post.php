<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\{ Category, Picture, Registration };

class Post extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function boot() {
        
        parent::boot();

        static::deleting(function($post) {
             $post->picture()->delete();
             $post->categories()->detach();
             $post->registrations()->detach();
        });
    }

    public function categories () {
        return $this->belongsToMany(Category::class);
    }

    public function picture () {
        return $this->hasOne(Picture::class);
    }

    public function registrations () {
        return $this->belongsToMany(Registration::class);
    }

    public function hasCategory($key, $val) {
        foreach ($this->categories as $category) {
            dd($category->$key);
            if ($category->$key === $val)
                return true;
        }
        return false;
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
    
    public function scopeForthcoming($query) {
    	$now = Carbon::now();
    	return $query->where('begin_at', '>', $now)->orderBy('begin_at');
    }
    
    public function scopePast($query) {
        $now = Carbon::now();
        return $query->where('begin_at', '<', $now)->orderBy('begin_at');
    }
    
    public function scopeStages($query) {
        return $query->where('type', 'stage');
    }
    
    public function scopeFormations($query) {
        return $query->where('type', 'formation');
    }


    // Mutators

    public function getTitleAttribute($value) {
        return ucfirst($value);
    }
    public function dotPrice() {
        // dd('ypo');
        return preg_replace('/^(\d+)(\d{3})\.(\d+)$/', '$1.$2,$3', $this->price);
    }
    public function priceWithCurrency() {
        return $this->price . ' €';
    }


    // Custom methods

    /**
     * Shorten $post->description.
     * Slice to [0,$nbChar] if $nbChar > 0
     * Slice to [0, <first dot>] if not specified
     * 
     * @param  int|integer
     * @return string
     */
    public function shortDescription(int $nbChar = 0) {
        if ($nbChar) {
            $pattern = '/^(.{'.$nbChar.'}).*$/';
            // $pattern = '/^([\s\w.!,?;:\'"]{'.$nbChar.'}).*$/';
            $replacement = '$1 [...]';
        } else {
            $pattern = '/\.(.*$)/';
            $replacement = '[...]';
        }
        return preg_replace($pattern, $replacement, $this->description);
    }
    
    public function ucType() {
        return ucfirst($this->type);
    }

    public function remainingTimeString() {

        $aliasDays = $this->remainingDaysBeforeStart();

        if ($aliasDays > 2) {
            $timeString = $aliasDays . ' jours';
        } else if ($aliasDays !== 0) {
            $dayOrDays = $aliasDays + 1 === 2 ? 'jours' : 'jour';
            $timeString = $aliasDays + 1 . ' ' . $dayOrDays;
        } else {
            $timeString = $this->remainingHoursBeforeStart() . ' heures';
        }
        return $timeString;
    }
    
    public function remainingDaysBeforeStart() {
        $now = Carbon::now();
        $start = new Carbon($this->begin_at);
        return $now->diff($start)->days;
    }
    
    public function remainingHoursBeforeStart() {
        $now = Carbon::now();
        $start = new Carbon($this->begin_at);
        return $now->diff($start)->h;
    }
    
    public function humanBegin() {
        setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
        $date = new \DateTime($this->begin_at);
        $ts = $date->getTimestamp();
        return strftime('%e %B %Y', $ts) . ' à ' . strftime('%Hh%M', $ts);
    }
    public function humanEnd() {
        setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
        $date = new \DateTime($this->end_at);
        $ts = $date->getTimestamp();
        return strftime('%e %B %Y', $ts) . ' à ' . strftime('%Hh%M', $ts);
    }
    
    public function takenSeats() {
        return $this->registrations->count();
    }
    public function freeSeats() {
        return $this->max_seats - $this->takenSeats();
    }

    public function statusClass() {
        $css = '';
        switch ($this->status) {
            case 'Publié':
                $css = 'green';
                break;
            case 'Brouillon':
                $css = 'blue';
                break;
            case 'Corbeille':
                $css = 'red';
                break;
        }
        return $css;
    }
    // Getter for back-office
    public function getStatusAttribute($value) {
        // return \Route::current()->getName();
        if (preg_match('/^post/', \Route::current()->getName())) {
            switch($value) {
                case 'published':
                    return 'Publié';
                case 'draft':
                    return 'Brouillon';
                case 'trash':
                    return 'Corbeille';
            }
        }
        return $value;
        // dd(route()->current());
        // if (route()->current()) {

        // }
    }
    // public function
}


