<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ Post, Category };

use Carbon\Carbon;

class FrontController extends Controller
{
    private $pagination = 6;

    public function index() {
    	$posts = Post::published()->forthcoming()->take(2)->get();
        return view('front.index', compact('posts'));
    }

    public function show(Post $post) {
    	return view('front.show', compact('post'));
    }

    public function showStages() {
    	$posts = Post::published()->stages()->orderBy('begin_at', 'asc')->paginate($this->pagination);
    	return view('front.index', compact('posts'));
    }

    public function showFormations() {
    	$posts = Post::published()->formations()->orderBy('begin_at', 'asc')->paginate($this->pagination);
    	// dd($posts);
    	return view('front.index', compact('posts'));
    }
}
