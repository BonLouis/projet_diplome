<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ Post, Category };

use Carbon\Carbon;

class FrontController extends Controller
{
    private $paginate = 15;

    public function index()
    {
    	$posts = Post::published()->forthcoming()->take(2)->get();
        return view('front.index', compact('posts'));
    }
    public function show(Post $post) {
    	return view('front.show', compact('post'));
    }
}
