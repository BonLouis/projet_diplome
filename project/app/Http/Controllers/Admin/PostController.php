<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\{ Post, Category };
use App\Http\Requests\PostRequest;

class PostController extends Controller
{   
    protected $request;
    protected $post;

    // public function __construct() {
    //     $this->request = $request;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::all();
        $trash = Post::trash();
        return view('back.index', compact('posts', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        Post::create($request->all);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        return view('back.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post) {
        dd($post, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function trash(Post $post) {
        $newStatus = $post->status === 'trash' ? 'draft' : 'trash';
        $post->update(['status' => $newStatus]);
        $newCount = Post::trash()->count();
        return compact('newStatus', 'newCount');
    }

    public function loadOneAndEdit(Post $post) {
        // dd($post);
        return view('back.edit', compact('post'));
    }
}
