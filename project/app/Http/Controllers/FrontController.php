<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ Post, Category };
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

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
    public function showContact() {
        return view('front.contact');
    }
    public function sendContactMail(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ]);
        Mail::to('blouis@alwaysdata.net')->send(new Contact($request->except('_token')));
        return redirect('/')->with('successMsg', 'Votre mail à bien été envoyé ! Nous vous répondrons dès que possible.');
    }
}
