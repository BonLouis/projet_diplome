<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\{ Post };

class AjaxController extends Controller
{
	public function trash(Post $post) {
		$newStatus = $post->status === 'trash' ? 'draft' : 'trash';
		$post->update(['status' => $newStatus]);
		$newCount = Post::trash()->count();
		return compact('newStatus', 'newCount');
	}

	public function loadBlankForm() {
		$post = new Post;
		return view('back.edit', compact('post'));
	}

	public function loadOneAndEdit(Post $post) {
		return view('back.edit', compact('post'));
	}

	public function loadTrashes() {
		$posts = Post::trash()->get();
		return view('back.trash', compact('posts'));
	}

	public function untrash(Request $request) {
		$ids = $request->get('ids');
		if ($ids) {
			$posts = Post::whereIn('id', $ids);
		} else {
			$posts = Post::trash();
		}
		$posts->update(['status' => 'draft']);
		return 'ok';
	}

	public function destroyTrash(Request $request) {
		// if($request->input('some')) {
		// 	if($request->input('ids')) {
		// 		$posts = Post::trash()->find($request->input('ids'));
		// 	} else {
		// 		;
		// 	}
		// } else {
		// 	$posts = Post::trash()->get();
		// }
		// foreach($posts as $post) {
		// 	$post->delete();
		// }
		$data = json_encode(array(
			'viewTrash' => (String)view('back.trash', ['posts' => Post::trash()->get()]),
			'viewAll' => (String)view('back.index', ['posts' => Post::all(), 'trash' => Post::trash()->get()]),
			'successMsg' => 'Votre mail à bien été envoyé ! Nous vous répondrons dès que possible.'
		));
		return $data;
	}
}
