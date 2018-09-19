<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\{ Post, Category, Picture };
use App\Http\Requests\PostRequest;
use App\Rules\ImageUrl;

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
    public function store(PostRequest $request) {
        $post = Post::create($request->except(['picture_url']));
        $link = str_random(12) . '.jpg';
        $file = file_get_contents($request->picture_url);
        Storage::disk('local')->put($link, $file);
        Picture::create([
            'link' => $link,
            'post_id' => $post->id,
            'title' => $post->title
        ]);
        return $post->id;
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
        $post->update($request->except(['picture_url']));
        if ($post->picture->link !== $request->picture_url) {
            $url = preg_replace('/(\/\/\w+):.+/', '$1', url('/'));
            $url = preg_replace('/\//', '\/', $url);
            $pattern = '/'.$url.'/';
            $pattern2 = '/https?:\/\/\w+:\d+/';
            if (!preg_match($pattern, $request->picture_url) && !preg_match($pattern2, $request->picture_url)) {

                // Here we can safely update the picture link !
                $picture = Picture::where('post_id', $post->id);
                $link = str_random(12) . '.jpg';
                $file = file_get_contents($request->picture_url);
                Storage::disk('local')->put($link, $file);
                $picture->update(['link' => $link]);
            } else {
                //  The url seems to point to our app, which is not possible.
                //  We ignore it.
            }
        } else {
            // No changes in url, we ignore it.
        }
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        dd($id);
    }

    public function trash(Post $post) {
        $newStatus = $post->status === 'trash' ? 'draft' : 'trash';
        $post->update(['status' => $newStatus]);
        $newCount = Post::trash()->count();
        return compact('newStatus', 'newCount');
    }
}
