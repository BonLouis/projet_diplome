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
    public function index(Request $request) {
        $posts = Post::paginate(10);
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
        $post = Post::create($request->except(['picture_url', 'picture_down', 'categories']));
        $post->categories()->attach($request->categories);
        $link = str_random(12) . '.jpg';
        $file = file_get_contents($request->picture_url);
        Storage::disk('local')->put($link, $file);
        Picture::create([
            'link' => $link,
            'post_id' => $post->id,
            'title' => $post->title
        ]);
        $data = json_encode(array(
            'viewModal' => (String)view('back.trash', ['posts' => Post::trash()->get()]),
            'viewTable' => (String)view('back.table', ['posts' => Post::all()]),
            'newCount' => Post::trash()->count(),
            'msg' => [
                'level' => 'successMsg',
                'html' => 'Votre post a bien été enregistré'
            ]
        ));
        return $data;
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
        $post->update($request->except(['picture_url', 'categories']));
        $post->categories()->sync($request->categories);
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
        $data = json_encode(array(
            'viewModal' => (String)view('back.trash', ['posts' => Post::trash()->get()]),
            'viewTable' => (String)view('back.table', ['posts' => Post::all()]),
            'newCount' => Post::trash()->count(),
            'msg' => [
                'level' => 'successMsg',
                'html' => 'Le post n°'.$post->id.' a bien été mis à jour'
            ]
        ));
        return $data;
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

    public function toggleStatus(Post $post, Request $request) {
        if (!!preg_match('/\?page/', url()->previous())) {
            $page = preg_replace('/^.*(\?page=\d+)$/', '$1', url()->previous());
        } else {
            $page = false;
        }

        switch($post->status) {
            case 'published':
                $newStatus = 'draft';
                break;
            case 'draft':
                $newStatus = 'published';
                break;
            case 'trash':
                $newStatus = 'draft';
                break;
        }
        $post->update(['status' => $newStatus]);
        $infoMsg = 'Post n°'.$post->id.' : status passé à ' . $post->status;
        return redirect('admin/post'.$page)->with(compact('infoMsg'));
    }
    public function toggleOpen(Post $post, Request $request) {
        if (!!preg_match('/\?page/', url()->previous())) {
            $page = preg_replace('/^.*(\?page=\d+)$/', '$1', url()->previous());
        } else {
            $page = '';
        }
        $post->update(['open' => !$post->open]);
        $infoMsg = 'Post n°'.$post->id.' : inscriptions ' . ($post->open ? 'ouvertes' : 'fermées');
        return redirect('admin/post'.$page)->with(compact('infoMsg'));
    }
}
