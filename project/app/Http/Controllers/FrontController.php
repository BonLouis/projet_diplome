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
    	$posts = Post::published();
        return view('front.index');
    }

}
