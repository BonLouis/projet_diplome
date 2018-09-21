<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ Post, Category };

class SearchController extends Controller
{
    public function doQuery(Request $request) {
        $query = '%'.$request->query('search').'%';
    	if (preg_match('/^%#/', $query)) {
    		$query = preg_replace('/^%#/', '%', $query);
    		$posts = Post::join('category_post', 'posts.id', '=', 'category_post.post_id')
    		->join('categories', 'category_post.category_id', '=', 'categories.id')
    		->select('posts.*')->where('name', 'like', $query);
    	} else {
	    	$posts = Post::where('title', 'like', $query)
	    	->orWhere('description', 'like', $query);
    	}
    	$posts = $posts->paginate(10);
    	return view('partials.cards.post', compact('posts'));
    }
}
